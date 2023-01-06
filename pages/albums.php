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

  ?>

  <main class="flex  flex-col lg:mt-32 mt-20 w-11/12 mx-auto">
    <?php 
      echo '<h2 class=" uppercase font-bold mt-8 lg:mt-0 text-2xl lg:text-3xl">Your Albums</h2>'; 
    ?>
    <div class="grid  lg:grid-cols-4 gap-4 grid-cols-1< mt-8">
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
            echo '<div class="flex flex-col relative items-center w-10/12" id="'.$albums['id'].'">';
              echo '<a class="absolute w-[32vh] h-[48vh] z-50" href="albumContent.php?id='.$albums['id'].'"></a>';
              echo '<p class="uppercase font-bold text-lg lg:text-3xl absolute bottom-1/2 z-30">'. $albums['name'] . '</p>';
              echo '<div class="flex flex-row lg:mt-4 mt-2 ">';
                echo '<div class="absolute rounded-lg w-[32vh] h-[48vh] bg-black opacity-30 z-20"></div>';
                echo '<a href="albumContent.php?id='.$albums['id'].'"><img class=" z-10 rounded-lg w-[32vh] h-[48vh]" src=' . $album_cover . '></a>';
                echo '<div class="flex flex-row absolute w-[40vh] h-[60vh] -z-10 ml-[3vh]">';
                  echo '<div>';
                    echo '<div class="absolute rounded-lg w-[32vh] h-[48vh] bg-black opacity-50 z-20"></div>';
                    echo '<a href="albumContent.php?id='.$albums['id'].'"><img class=" -z-30 absolute rounded-lg w-[32vh] h-[48vh]" src=' . $album_cover . '></a>';
                  echo '</div>';
                  echo '<div >';
                    echo '<div class="absolute rounded-lg w-[32vh] h-[48vh] ml-[3vh] bg-black opacity-70 -z-40"></div>';
                    echo '<a href="albumContent.php?id='.$albums['id'].'"><img class="ml-[3vh]  -z-50 absolute rounded-lg w-[32vh] h-[48vh]" src=' . $album_cover . '></a>';
                  echo '</div>';
                echo '</div>';
              echo '</div>';
            echo '</div>';
        }
        $_SESSION['hist'] = $histAlbum;
      ?>
    </div>
    
  </main>

</body>
<?php
require_once '../utils/footer.php';
?>
</html>
