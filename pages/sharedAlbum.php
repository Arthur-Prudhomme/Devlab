<?php
require_once '../utils/header.php';
require_once '../actions/checkLogin.php';
require_once '../controllers/album.php';
require_once '../controllers/api.php';

$connection = new Connection();
$album = new Album();
$api = new API();

$allSharedAlbums = $album->getAllSharedAlbumsFromUser($_SESSION['user']['id']);
?>

<main class="flex  flex-col lg:mt-32 mt-20 w-11/12 mx-auto"> 
  <h2 class=" uppercase font-bold mt-8 lg:mt-0 text-2xl lg:text-3xl">Album(s) shared with you</h2>
  <div class="grid lg:grid-cols-5 gap-4 grid-cols-2 mt-8">
    <?php
      foreach ($allSharedAlbums as $albums) {
        $movie_id = $album->getFirstMovieInAlbum($albums['album_id']);
        if (isset($movie_id)) {
          $movie = $api->getMovie($movie_id);
          $album_cover = $api->getImg($movie['poster_path'], 500);
        } else {
          $album_cover = 'https://redellantasonline.com/assets/img-temp/200x300/img1.png';
        }
        echo '<div class="flex flex-col items-center" id="' . $albums['album_id'] . '">';
          echo '<div class="flex flex-col items-center text-center relative w-full">';
            echo '<a class="absolute w-[31vh] h-[47vh] z-10 bottom-0" href="sharedAlbumContent.php?id=' . $albums['album_id'] . '"></a>';
            echo '<p class="absolute uppercase text-white font-bold text-base z-10 w-11/12 bottom-5">'.$albums['name'] . ' from ' . $connection->getUserById($albums['user_id'])[1] . '</p>';
            echo '<a class="mt-4 lg:w-[31vh] lg:h-[47vh]" href="albumContent.php?id='.$albums['id'].'"><img class="rounded-lg lg:w-[31vh] lg:h-[47vh]" src=' . $album_cover . '></a>';
            echo '<div class="w-[31vh] h-[47vh] absolute gradient"></div>';
          echo '</div>';
          $likes = $album->getLikesOnAlbum($albums['album_id']);
          if($likes != 0){
            echo '<p class="btn bg-fond lg:text-base text-sm px-7 py-2 text-rouge font-bold uppercase rounded-lg hover:bg-black mt-4">'.$likes.' likes' . '</p>';
          }
        echo '</div>';
      }

    ?>
  </div>
</main>


</body>
<?php
require_once '../utils/footer.php';
?>
</html>