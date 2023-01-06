<?php
require_once '../utils/header.php';
require_once '../actions/checkLogin.php';
require_once '../controllers/connection.php';
require_once '../controllers/album.php';
require_once '../controllers/api.php';

$album = new Album();
$convert = (int)$_GET['id'];
$check = array_search($convert, $_SESSION['hist']);

?>
  <main class="flex flex-col lg:mt-32 mt-20 w-11/12 mx-auto">
    <?php

      if (is_int($check)) {
        $allMovies = $album->getAllMoviesFromAlbumId($_GET['id']);
        $api = new API();
        $checkIfDeletable = $album->isWatchedOrWatchLater($_GET['id']);
        if($checkIfDeletable === false){
          echo '<form method="POST"><input class="btn bg-fond lg:text-base text-sm px-7 py-2 text-rouge font-bold uppercase rounded-lg hover:bg-black mt-4" type="submit" value="Delete Album"></form>';
        }
        ?> 
        
        <div class="grid lg:grid-cols-5 gap-4 grid-cols-2 mt-8">

          <?php
            foreach ($allMovies as $movies) {
              $movie = $api->getMovie($movies['movie_id']);
              echo '<div class="flex flex-col items-center" id="'.$movies['movie_id'].'">';
                echo '<div class="flex flex-col items-center text-center relative w-full">';
                  echo '<a class="absolute w-[31vh] h-[47vh] z-10 bottom-0" href="movie.php?id=' . $movies['movie_id'] . '"></a>';
                  echo '<p class="absolute text-white font-bold text-base z-10 w-11/12 bottom-5">'.$movie['title'].'</p>';
                  echo '<a class="mt-4 w-[31vh] h-[47vh]" href="movie.php?id='.$movies['movie_id'].'"><img class="rounded-lg w-[31vh] h-[47vh]" src='.$api->getImg($movie['poster_path'], 300).'></a>';
                  echo '<div class="w-[31vh] h-[47vh] absolute gradient"></div>';
                echo '</div>';
                echo '<button class="btn bg-fond lg:text-base text-sm px-7 py-2 text-rouge font-bold uppercase rounded-lg hover:bg-black mt-4" onclick=removeFromAlbum('.$movies['movie_id'].','.$_GET['id'].')>Remove From Album</button>';
              echo '</div>';
            }
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
              $album->deleteAlbum($_GET['id']);
            }
          ?>
        </div>
        <?php

      } else {
        header("Location: ./albums.php");
      }
    ?>
  </main> 
</body>
<?php
require_once '../utils/footer.php';
?>
</html>
