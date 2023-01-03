<?php
  require_once '../utils/header.php';
  require_once '../actions/checkLogin.php';
  require_once '../controllers/connection.php';
  require_once '../controllers/album.php';
  require_once '../controllers/api.php';

  $album = new Album();
  $api = new API();
  $allAlbums = $album->getAllAlbumFromUserId($_SESSION['user']['id']);
  $histAlbum = [];

  $_SESSION['hist'] = $histAlbum;
  ?>

  <main class="flex flex-col lg:mt-32 mt-20 w-11/12 mx-auto">
    <?php 
      echo '<h2 class=" uppercase font-bold mt-8 lg:mt-0 text-2xl lg:text-3xl">Your Albums</h2>'; 
    ?>
    <div class="grid lg:grid-cols-5 gap-4 grid-cols-2 mt-8">
      <?php 
        foreach ($allAlbums as $albums) {
            array_push($histAlbum, $albums['id']);
            $movie_id = $album->getFirstMovieInAlbum($albums['id']);
            if (isset($movie_id)) {
                $movie = $api->getMovie($movie_id);
                $album_cover = $api->getImg($movie['poster_path'], 500);
            } else {
                $album_cover = 'https://redellantasonline.com/assets/img-temp/200x300/img1.png';
            }
            echo '<div id="'.$albums['id'].'">';
            echo '<p class="uppercase tracking-widest font-semi-bold text-lg lg:text-xl">'. $albums['name'] . '</p>';
            echo '<a href="albumContent.php?id='.$albums['id'].'"><img class="lg:mt-4 mt-2 rounded-lg w-full" src=' . $album_cover . '></a>';
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