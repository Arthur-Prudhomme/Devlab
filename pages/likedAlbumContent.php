<?php
  require_once '../utils/header.php';
  require_once '../actions/checkLogin.php';
  require_once '../controllers/album.php';
  require_once '../controllers/api.php';

  $album = new Album();
  $connection = new Connection();
  $api = new API();

  $album_id = $_GET['id'];
  $user_id = $connection->getUserIdByUsername($_SESSION['likedAlbum_userUsername']);
  $check = $album->checkIfAlbumIsLikedByUser($album_id, $user_id);
?>

  <main class="flex flex-col lg:mt-32 mt-20 w-11/12 mx-auto">
    <div class="grid lg:grid-cols-5 gap-4 grid-cols-2 mt-8">
      <?php

      if($check){
          $allMovies = $album->getAllMoviesFromAlbumId($_GET['id']);

          foreach ($allMovies as $movies) {
              $movie = $api->getMovie($movies['movie_id']);
              echo '<div class="flex flex-col items-center" id="'.$movies['movie_id'].'">';
                echo '<div class="flex flex-col items-center text-center relative w-full">';
                  echo '<a class="absolute w-[31vh] h-[47vh] z-10 bottom-0" href="movie.php?id=' . $movies['movie_id'] . '"></a>';
                  echo '<p class="absolute text-white font-bold text-base z-10 w-11/12 bottom-5">'.$movie['title'].'</p>';
                  echo '<a class="mt-4 lg:w-[31vh] lg:h-[47vh] ouaip" href="movie.php?id='.$movies['movie_id'].'"><img class="rounded-lg w-[31vh] h-[47vh]" src='.$api->getImg($movie['poster_path'], 500).'></a>';
                  echo '<div class=" absolute gradient"></div>';
                echo '</div>';
              echo '</div>';
          }
      } else {
          if($_SESSION['likedAlbum_userUsername'] === $_SESSION['user']['username']) {
              header("Location: ./likedAlbum.php");
          }else{
              header("Location: ./likedAlbum.php?username=".$_SESSION['likedAlbum_userUsername']);
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