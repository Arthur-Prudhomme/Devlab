<?php
  require_once '../utils/header.php';
  require_once '../actions/checkLogin.php';
  require_once '../controllers/album.php';
  require_once '../controllers/api.php';

  $album = new Album();
  $api = new API();
  $first_album_id = $album->getFirstAlbumFrom($_SESSION['user']['id'],0);
  $first_album_first_movie_id = $album->getFirstMovieInAlbum($first_album_id);
  $movie = $api->getMovie($first_album_first_movie_id);

?>

  <main class="flex flex-col lg:mt-32 mt-10">
    <div class="w-11/12 mx-auto flex flex-col">
      <?php 
        echo '<h1 class="uppercase font-bold mt-8 lg:mt-4 text-2xl lg:text-3xl lg:mb-8 mb-2">Hello ' . $_SESSION['user']['username'] . '</h1>';
      ?>
      <div class="flex lg:flex-row flex-col">
        <div class="flex flex-col lg:w-1/2 w-11/12 mx-auto">
          <?php 
            echo '<h2 class="uppercase font-semi-bold mt-2 text-lg lg:text-xl">Your Albums</h2>';
            echo '<a class="mt-4" href="albums.php"><img class="rounded-lg lg:w-1/2 w-full" src=' . $api->getImg($movie['poster_path'], 500) . '></a><br>';
          ?>
        </div>
        <div class="flex flex-col lg:w-1/2 w-11/12 mx-auto">
          <?php
            echo '<h2 class="uppercase font-semi-bold mt-2 text-lg lg:text-xl">Liked Albums</h2>';
            echo '<a class="mt-4" href="likedAlbum.php"><img class="rounded-lg lg:w-1/2 w-full" src=https://redellantasonline.com/assets/img-temp/200x300/img1.png></a><br>';
          ?>
        </div>
      </div>
    </div>
  </main>

</body>
<?php
require_once '../utils/footer.php';
?>
</html>