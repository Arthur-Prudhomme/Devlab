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
          echo '<br><form method="POST"><input type="submit" value="Delete Album"></form><br><br>';
        }
        ?> 
        
        <div class="grid lg:grid-cols-5 gap-4 grid-cols-2 mt-8">

        <?php
          foreach ($allMovies as $movies) {
            $movie = $api->getMovie($movies['movie_id']);
            echo '<div class="flex flex-col items-center w-full" id="'.$movies['movie_id'].'">';
              echo '<p class="uppercase h-[8vh] items-center flex font-semi-bold mt-8 lg:mt-0 text-md text-gris lg:text-xl">'.$movie['title'].'</p>';
              echo '<a class="mt-4" href="movie.php?id=' . $movies['movie_id'] . '"><img class="rounded-lg  w-full" src=' . $api->getImg($movie['poster_path'], 300) . '></a><br>';
              echo '<button class="btn bg-fond lg:text-base text-sm px-7 py-2 text-rouge font-bold uppercase rounded-lg hover:bg-black" onclick=removeFromAlbum('.$movies['movie_id'].','.$_GET['id'].')>Remove From Album</button>';
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