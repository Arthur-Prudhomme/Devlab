<?php
require_once '../utils/header.php';
require_once '../actions/checkLogin.php';
require_once '../controllers/album.php';
require_once '../controllers/api.php';

$album = new Album();
$connection = new Connection();
$api = new API();
?>

<main class="flex flex-col lg:mt-32 mt-20 w-11/12 mx-auto">
  <?php

  if(!isset($_SESSION['exploreUsername'])) {
      $user_id = $_SESSION['user']['id'];
  }else{
      function checkIfBelongs()
      {
          foreach ($_SESSION['exploreUsername'] as $value) {
              $album = new Album();
              $connection = new Connection();
              $check = $album->checkIfAlbumBelongsToUser($_GET['id'], $value);
              if ($check === true) {
                  $username = $connection->getUserById($value);
                  $_SESSION['exploreUsername'] = $username[1];
                  return true;
              }
          }
          return false;
      }
  }

  if(checkIfBelongs()){
      $allMovies = $album->getAllMoviesFromAlbumId($_GET['id']);
      if(!isset($_SESSION['exploreUsername'])) {
          $checkIfDeletable = $album->isWatchedOrWatchLater($_GET['id']);
          if ($checkIfDeletable === false) {
              echo '<br><form method="POST"><input type="submit" value="Delete Album"></form><br><br>';
          }
      }

      foreach ($allMovies as $movies) {
          $movie = $api->getMovie($movies['movie_id']);
          echo '<div id="'.$movies['movie_id'].'">';
          echo $movie['title'] . '<br />';
          echo '<a href="movie.php?id=' . $movies['movie_id'] . '"><img src=' . $api->getImg($movie['poster_path'], 200) . '></a><br>';
          if(!isset($_SESSION['exploreUsername'])) {
              echo '<button onclick=removeFromAlbum(' . $movies['movie_id'] . ',' . $_GET['id'] . ')>Remove From Album</button>';
          }
          echo '<br></div>';
      }
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
</main>
</body>
<?php
require_once '../utils/footer.php';
?>
</html>