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
    <div class="grid lg:grid-cols-5 gap-4 grid-cols-2 mt-8">
      <?php
              
        if($album->checkIfAlbumBelongsToUser($_GET['id'],$_SESSION['user']['id'])){
          $allMovies = $album->getAllMoviesFromAlbumId($_GET['id']);

          foreach ($allMovies as $movies) {
              $movie = $api->getMovie($movies['movie_id']);
              echo '<div class="flex flex-col items-center" id="'.$movies['movie_id'].'">';
                  echo '<div class="flex flex-col items-center text-center relative w-full">';
                    echo '<a class="absolute w-[31vh] h-[47vh] z-10 bottom-0" href="movie.php?id=' . $movies['movie_id'] . '"></a>';
                    echo '<p class="absolute text-white font-bold text-base z-10 w-11/12 bottom-5">'.$movie['title'].'</p>';
                    echo '<a class="mt-4 lg:w-[31vh] lg:h-[47vh] ouaip" href="movie.php?id='.$movies['movie_id'].'"><img class="rounded-lg w-[31vh] h-[47vh]" src='.$api->getImg($movie['poster_path'], 500).'></a>';
                    echo '<div class="lg:w-[31vh] lg:h-[50vh]  absolute gradient"></div>';
                  echo '</div>';
    
                  echo '<button class="btn bg-fond lg:text-base text-sm px-7 py-2 text-rouge font-bold uppercase rounded-lg hover:bg-black mt-4" onclick=removeFromAlbum(' . $movies['movie_id'] . ',' . $_GET['id'] . ')>Remove From Album</button>';
                
              echo '</div>';
          }
        } else {
          header("Location: ./sharedAlbum.php");
        }
      ?>
    </div>
  </main>  


</body>
<?php
require_once '../utils/footer.php';
?>
</html>