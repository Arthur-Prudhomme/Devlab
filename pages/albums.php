<?php
require_once '../utils/header.php';
require_once '../actions/checkLogin.php';
require_once '../controllers/album.php';
require_once '../controllers/api.php';

$connection = new Connection();
$album = new Album();
$api = new API();
?>
<main class="flex  flex-col lg:mt-32 mt-20 w-11/12 mx-auto"> 
  <?php
    if(!isset($_GET['username'])) {
        echo '<h2 class=" uppercase font-bold mt-8 lg:mt-0 text-2xl lg:text-3xl">Your Albums</h2>';
        $allAlbums = $album->getAllAlbumFromUserId($_SESSION['user']['id'],1,0);
        unset($_SESSION['exploreUsername']);
    }else{
        if($connection->getUserByUsername($_GET['username'],0,'') == null){
            $no_user = 1;
            echo '<h1 class=" uppercase font-bold mt-8 lg:mt-0 text-2xl lg:text-3xl">No user found with the name "'.$_GET['username'].'"</h1>';
        }else{
            echo '<h2 class=" uppercase font-bold mt-8 lg:mt-0 text-2xl lg:text-3xl">'.$_GET['username'].'\'s Albums</h2>';
            $userId = $connection->getUserIdByUsername($_GET['username']);
            $allAlbums = $album->getAllAlbumFromUserId($userId,0,0);
            $_SESSION['exploreUsername'] = $_GET['username'];
        }
    }
  ?> 
  <div class="grid lg:grid-cols-5 gap-4 grid-cols-2 mt-8">
    <?php

    if(!isset($no_user)){
      foreach ($allAlbums as $albums) {
        $movie_id = $album->getFirstMovieInAlbum($albums['id']);
        if (isset($movie_id)) {
          $movie = $api->getMovie($movie_id);
          $album_cover = $api->getImg($movie['poster_path'], 500);
        } else {
          $album_cover = 'https://redellantasonline.com/assets/img-temp/200x300/img1.png';
        }
        echo '<div class="flex flex-col items-center">';
            echo '<div class="flex flex-col items-center text-center relative w-full">';
              echo '<a class="absolute w-[31vh] h-[47vh] z-10 bottom-0" href="albumContent.php?id=' . $albums['id'] . '"></a>';
              echo '<p class="absolute text-white font-bold text-base z-10 w-11/12 bottom-5">'.$albums["name"].'</p>';
              echo '<a class="mt-4 lg:w-[31vh] lg:h-[47vh] ouaip" href="albumContent.php?id=' . $albums['id'] . '"><img class="rounded-lg w-[31vh] h-[47vh]" src='.$album_cover.'></a>';
              echo '<div class="lg:w-[31vh] lg:h-[50vh]  absolute gradient"></div>';
            echo '</div>';
            
            if(isset($_GET['username'])){
              if ($_GET['username'] !== $_SESSION['user']['username']) {
                echo '<button class="btn bg-fond lg:text-base text-sm px-7 py-2 text-rouge font-bold uppercase rounded-lg hover:bg-black mt-4" onclick=likeAlbum(' . $albums['id'] . ',' . $_SESSION['user']['id'] . ')>Like</button>';
              }
            }else{
              $likes = $album->getLikesOnAlbum($albums['id']);
              if($likes != 0){
                echo $likes.' likes';
              }
            }
        echo '</div>';
        
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