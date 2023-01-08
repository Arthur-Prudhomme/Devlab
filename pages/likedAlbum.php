<?php
require_once '../utils/header.php';
require_once '../actions/checkLogin.php';
require_once '../controllers/album.php';
require_once '../controllers/api.php';

$connection = new Connection();
$album = new Album();
$api = new API();

?> 
  <main class="flex flex-col lg:mt-32 mt-20 w-11/12 mx-auto">
  <?php
    if(!isset($_GET['username'])){
        echo '<h2 class=" uppercase font-bold mt-8 lg:mt-0 text-2xl lg:text-3xl">The Albums you liked</h2>';
        $likedAlbums = $album->getAllLikedAlbumsFromUser($_SESSION['user']['id']);
    }else {
        if ($connection->getUserByUsername($_GET['username'], 0, '') == null) {
            $no_user = 1;
            echo '<h1 class=" uppercase font-bold mt-8 lg:mt-0 text-2xl lg:text-3xl">No user found with the name "' . $_GET['username'] . '"</h1>';
        } else {
            echo '<h2 class=" uppercase font-bold mt-8 lg:mt-0 text-2xl lg:text-3xl">The Albums that '.$_GET['username'].' liked</h2>';
            $userId = $connection->getUserIdByUsername($_GET['username']);
            $likedAlbums = $album->getAllLikedAlbumsFromUser($userId);
        }
    }

    $exploreUsernameHistoric = [];
    
    ?>
    <div class="grid lg:grid-cols-5 gap-4 grid-cols-2 mt-8">
      <?php

      if(!isset($no_user)) {
          foreach ($likedAlbums as $albums) {
              $movie_id = $album->getFirstMovieInAlbum($albums['album_id']);
              if (isset($movie_id)) {
                  $movie = $api->getMovie($movie_id);
                  $album_cover = $api->getImg($movie['poster_path'], 200);
              } else {
                  $album_cover = 'https://redellantasonline.com/assets/img-temp/200x300/img1.png';
              }

              echo '<div class="flex flex-col items-center">';
                echo '<div class="flex flex-col items-center text-center relative w-full" id="l' . $albums['album_id'] . '">';
                  echo '<a class="absolute w-[31vh] h-[47vh] z-10 bottom-0" href="likedAlbumContent.php?id=' . $albums['album_id'] . '"></a>';
                  $album_infos = $album->getAlbumInfosById($albums['album_id']);
                  $user_infos = $connection->getUserById($album_infos[1]);
                  echo '<p class="absolute text-white font-bold text-base z-10 w-11/12 bottom-5">'.$album_infos[2] . ' from ' . $user_infos[1] . '</p>';

                  array_push($exploreUsernameHistoric, $user_infos[0]);

                  echo '<a class="mt-4 lg:w-[31vh] lg:h-[47vh] ouaip" href="likedAlbumContent.php?id=' . $albums['album_id'] . '"><img class="rounded-lg w-[31vh] h-[47vh]" src=' . $album_cover . '></a>';
                  echo '<div class=" absolute gradient"></div>';
                echo '</div>';
                if(!isset($_GET['username'])) {
                    echo '<button class="btn bg-fond lg:text-base text-sm px-7 py-2 text-rouge font-bold uppercase rounded-lg hover:bg-black mt-4" onclick=likeAlbum(' . $albums['album_id'] . ',' . $_SESSION['user']['id'] . ')>Dislike</button>';
                }
              echo '</div>';
          }
          $_SESSION['exploreUsername'] = $exploreUsernameHistoric;
      }

    ?>
    </div>
  </main>
</body>
<?php
require_once '../utils/footer.php';
?>
</html>