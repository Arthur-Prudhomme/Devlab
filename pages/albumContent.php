<?php
require_once '../utils/header.php';
require_once '../actions/checkLogin.php';
require_once '../controllers/album.php';
require_once '../controllers/api.php';

$album = new Album();
$connection = new Connection();
$api = new API();

if(!isset($_SESSION['exploreUsername'])) {
    $user_id = $_SESSION['user']['id'];
}else{
    $user_id = $connection->getUserIdByUsername($_SESSION['exploreUsername']);
}
?>

  <main class="flex flex-col lg:mt-32 mt-20 w-11/12 mx-auto">
    <div class="flex flex-row items-center justify-between w-full">
      <div class="flex flex-col">
        <?php

          if($album->checkIfAlbumBelongsToUser($_GET['id'],$user_id)){
            $allMovies = $album->getAllMoviesFromAlbumId($_GET['id']);
            if(!isset($_SESSION['exploreUsername'])) {
              $checkIfDeletable = $album->isWatchedOrWatchLater($_GET['id']);
              if ($checkIfDeletable === false) {
                echo '<form method="POST"><input class="btn bg-fond lg:text-base text-sm px-7 py-2 text-rouge font-bold uppercase rounded-lg hover:bg-black" type="submit" value="Delete Album"></form>';
              }
            }
        ?>
      </div>
      <?php

      if(!isset($_SESSION['exploreUsername'])) {
        ?> 
        <div class="flex flex-col w-1/2">
          <?php
              echo '<input placeholder="Invite User" class="w-full mt-6 lg:mt-0 h-1/4 z-40 bg-transparent text-gris border border-gris p-1 px-2 rounded" id="user_search_bar" name="input" oninput=instantResearch("../sources/dynamicUserSearch.php",1,'.$_SESSION['user']['id'].',1,'.$_GET['id'].','.$_SESSION['user']['id'].') />';
              echo '<ul class="absolute text-white bg-bg flex flex-col z-30 mt-6 py-4 pl-6 rounded w-4/12 justify-between" id="user_invitation_list"></ul>';
            }
          ?> 
        </div>
    </div>
          
    <div class="grid lg:grid-cols-5 gap-4 grid-cols-2 mt-8">

      <?php

        foreach ($allMovies as $movies) {
          $movie = $api->getMovie($movies['movie_id']);
          echo '<div class="flex flex-col items-center" id="'.$movies['movie_id'].'">';
              echo '<div class="flex flex-col items-center text-center relative w-full">';
                echo '<a class="absolute w-[31vh] h-[47vh] z-10 bottom-0" href="movie.php?id=' . $movies['movie_id'] . '"></a>';
                echo '<p class="absolute text-white font-bold text-base z-10 w-11/12 bottom-5">'.$movie['title'].'</p>';
                echo '<a class="mt-4 lg:w-[31vh] lg:h-[47vh] ouaip" href="movie.php?id='.$movies['movie_id'].'"><img class="rounded-lg w-[31vh] h-[47vh]" src='.$api->getImg($movie['poster_path'], 300).'></a>';
                echo '<div class=" absolute gradient"></div>';
              echo '</div>';

              if(!isset($_SESSION['exploreUsername'])) {
                echo '<button class="btn bg-fond lg:text-base text-sm px-7 py-2 text-rouge font-bold uppercase rounded-lg hover:bg-black mt-4" onclick=removeFromAlbum(' . $movies['movie_id'] . ',' . $_GET['id'] . ')>Remove From Album</button>';
            }
          echo '</div>';
        }
            echo '</div>';
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $album->deleteAlbum($_GET['id']);
        }
        } else {
        if(!isset($_SESSION['exploreUsername'])) {
            header("Location: ./albums.php");
        }else{
            header("Location: ./albums.php?username=".$_SESSION['exploreUsername']);
        }
    }
      ?>
    </div>
  </main>  

</body>
<?php
require_once '../utils/footer.php';
?>
</html>