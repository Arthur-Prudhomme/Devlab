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

  <main class="flex flex-col lg:mt-32 mt-20">
    <div class="w-11/12 mx-auto">
      <?php 
        if (is_int($check)) {
            $allMovies = $album->getAllMoviesFromAlbumId($_GET['id']);
            $api = new API();
            $checkIfDeletable = $album->isWatchedOrWatchLater($_GET['id']);
            if($checkIfDeletable === false){
                echo '<br><form method="POST"><input type="submit" value="Delete Album"></form><br><br>';
            }

            foreach ($allMovies as $movies) {
                $movie = $api->getMovie($movies['movie_id']);
                echo '<div id="'.$movies['movie_id'].'">';
                echo $movie['title'] . '<br />';
                echo '<a href="movie.php?id=' . $movies['movie_id'] . '"><img src=' . $api->getImg($movie['poster_path'], 200) . '></a><br>';
                echo '<button onclick=removeFromAlbum('.$movies['movie_id'].','.$_GET['id'].')>Remove From Album</button>';
                echo '<br></div>';
            }
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $album->deleteAlbum($_GET['id']);
            }
        } else {
            header("Location: ./albums.php");
        }
      ?>
    </div>
      
  </main>

</body>
<?php
require_once '../utils/footer.php';
?>
</html>