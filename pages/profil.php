<?php
require_once '../utils/header.php';
require_once '../actions/checkLogin.php';
require_once '../controllers/album.php';
require_once '../controllers/api.php';

$connection = new Connection();
$album = new Album();
$api = new API();
?>

  <main class="flex flex-col lg:mt-32 mt-10">
    <div class="w-11/12 mx-auto flex flex-col ">
          <?php 
            if(!isset($_GET['username'])){
              ?> 
              <div class="w-full lg:mx-auto flex lg:flex-row flex-col items-center justify-between">
                <div class="lg:w-1/2 w-full flex flex-row relative items-center pb-6">
              <?php
                echo '<h1 class="uppercase font-bold mt-8 lg:mt-4 text-2xl lg:text-3xl lg:mb-8 mb-2">Hello ' . $_SESSION['user']['username'] . '</h1>';
                $invitations = $album->getAllPendingInvitationFromUserId($_SESSION['user']['id']);
                if(!empty($invitations)){
                    foreach ($invitations as $invitation){
                        echo '<div id="i' . $invitation['id'] . '">';
                        echo $connection->getUserById($invitation['owner'])[1]
                            . ' as invited you on ' .
                            $album->getAlbumInfosById($invitation['album_id'])[2]
                            . ' ' .
                            '<button class=" text-white z-40 appear px-4 py-1 rounded border-2 border-white cursor-pointer"  onclick=answerInvitation('.$invitation['id'].',1)>Accept</button>'
                            . ' ' .
                            '<button class=" text-white z-40 appear px-4 py-1 rounded border-2 border-rouge bg-rouge cursor-pointer" onclick=answerInvitation('.$invitation['id'].',0)>Deny</button>';
                        echo '</div>';
                    }
                }
                ?> 
          </div>
        <div class="lg:w-1/2 w-full flex flex-row relative">
            <?php

              echo '<input class="w-full mt-6 lg:mt-0 h-1/4 bg-transparent text-gris border border-gris p-1 px-2 rounded" placeholder="Search User"  id="user_search_bar" name="input" oninput=instantResearch("../sources/dynamicUserSearch.php",1,0,0) />';
              echo '<ul class=" absolute flex flex-col pt-8 p-3 rounded top-0 z-50" id="user_search_results"></ul>';

              $userAllAlbum = $album->getAllAlbumFromUserId($_SESSION['user']['id'],1,0);
              $imgs = [];
              for($i = 0; $i < 3; $i++){
                  $albumGroup = $album->getFirstMovieIdOfAllAlbums();
                  if(!empty($userAllAlbum)) {
                      if ($i < count($userAllAlbum)) {
                          $key = array_search($userAllAlbum[$i]['id'], array_column($albumGroup, 'album_id'));
                          $path = $api->getMovie($albumGroup[$key]['movie_id'])['poster_path'];
                          $img = $api->getImg($path, 500);
                      } else {
                          $key = array_search($userAllAlbum[0]['id'], array_column($albumGroup, 'album_id'));
                          $path = $api->getMovie($albumGroup[$key]['movie_id'])['poster_path'];
                          $img = $api->getImg($path, 500);
                      }
                  }else{
                      $img = 'https://redellantasonline.com/assets/img-temp/200x300/img1.png';
                  }
                  array_push($imgs,$img);
              }

              ?> 
            </div>
          </div>
          <div class="w-full h-[65vh] -ml-6 lg:-ml-0 grid grid-cols-1 lg:grid-cols-3 gap-4 mx-auto mt-6">
            <div class="flex flex-col items-center ">
              <?php
                echo '<div class="flex flex-col relative items-center w-10/12" >';
                  echo '<a class="absolute w-[40vh] h-[60vh] z-50" href="albums.php"></a>';
                  echo '<p class="uppercase font-bold text-lg lg:text-3xl absolute bottom-1/2 z-30">Your Albums</p>';
                  echo '<div class="flex flex-row lg:mt-4 mt-2 ">';
                    echo '<div class="absolute rounded-lg w-[40vh] h-[60vh] bg-black opacity-30 z-20"></div>';
                    echo '<a href="albums.php"><img class=" z-10 rounded-lg w-[40vh] h-[60vh]" src='.$imgs[0].'></a>';
                    echo '<div class="flex flex-row absolute w-[40vh] h-[60vh] -z-10 ml-[3vh]">';
                      echo '<div>';
                        echo '<div class="absolute rounded-lg w-[40vh] h-[60vh] bg-black opacity-50 z-20"></div>';
                        echo '<a href="albums.php"><img class=" -z-30 absolute rounded-lg w-[40vh] h-[60vh]" src='.$imgs[1].'></a>';
                      echo '</div>';
                      echo '<div >';
                        echo '<div class="absolute rounded-lg w-[40vh] h-[60vh] ml-[3vh] bg-black opacity-70 -z-40"></div>';
                        echo '<a href="albums.php"><img class="ml-[3vh]  -z-50 absolute rounded-lg w-[40vh] h-[60vh]" src='.$imgs[2].'></a>';
                      echo '</div>';
                    echo '</div>';
                  echo '</div>';
                echo '</div>';
              ?>
            </div>

              <?php
                $userAllAlbum = $album->getAllLikedAlbumsFromUser($_SESSION['user']['id']);
                $imgs = [];
                for($i = 0; $i < 3; $i++){
                    $albumGroup = $album->getFirstMovieIdOfAllAlbums();
                    if(!empty($userAllAlbum)) {
                        if ($i < count($userAllAlbum)) {
                            $key = array_search($userAllAlbum[$i]['album_id'], array_column($albumGroup, 'album_id'));
                            $path = $api->getMovie($albumGroup[$key]['movie_id'])['poster_path'];
                            $img = $api->getImg($path, 500);
                        } else {
                            $key = array_search($userAllAlbum[0]['album_id'], array_column($albumGroup, 'album_id'));
                            $path = $api->getMovie($albumGroup[$key]['movie_id'])['poster_path'];
                            $img = $api->getImg($path, 500);
                        }
                    }else{
                        $img = 'https://redellantasonline.com/assets/img-temp/200x300/img1.png';
                    }
                    array_push($imgs,$img);
                }
              ?>
            <div class="flex flex-col items-center ">   
              <?php
                echo '<div class="flex flex-col relative items-center w-10/12" >';
                  echo '<a class="absolute w-[40vh] h-[60vh] z-50" href="likedAlbum.php"></a>';
                  echo '<p class="uppercase font-bold text-lg lg:text-3xl absolute bottom-1/2 z-30">Liked Albums</p>';
                  echo '<div class="flex flex-row lg:mt-4 mt-2 ">';
                    echo '<div class="absolute rounded-lg w-[40vh] h-[60vh] bg-black opacity-30 z-20"></div>';
                    echo '<a href="likedAlbum.php"><img class=" z-10 rounded-lg w-[40vh] h-[60vh]" src='.$imgs[0].'></a>';
                    echo '<div class="flex flex-row absolute w-[40vh] h-[60vh] -z-10 ml-[3vh]">';
                      echo '<div>';
                        echo '<div class="absolute rounded-lg w-[40vh] h-[60vh] bg-black opacity-50 z-20"></div>';
                        echo '<a href="likedAlbum.php"><img class=" -z-30 absolute rounded-lg w-[40vh] h-[60vh]" src='.$imgs[1].'></a>';
                      echo '</div>';
                      echo '<div >';
                        echo '<div class="absolute rounded-lg w-[40vh] h-[60vh] ml-[3vh] bg-black opacity-70 -z-40"></div>';
                        echo '<a href="likedAlbum.php"><img class="ml-[3vh]  -z-50 absolute rounded-lg w-[40vh] h-[60vh]" src='.$imgs[2].'></a>';
                      echo '</div>';
                    echo '</div>';
                  echo '</div>';
                echo '</div>';
              ?>
            </div>

              <?php
                $userAllAlbum = $album->getAllSharedAlbumsFromUser($_SESSION['user']['id']);
                $imgs = [];
                for($i = 0; $i < 3; $i++){
                    $albumGroup = $album->getFirstMovieIdOfAllAlbums();
                    if(!empty($userAllAlbum)) {
                        if ($i < count($userAllAlbum)) {
                            $key = array_search($userAllAlbum[$i]['id'], array_column($albumGroup, 'album_id'));
                            $path = $api->getMovie($albumGroup[$key]['movie_id'])['poster_path'];
                            $img = $api->getImg($path, 500);
                        } else {
                            $key = array_search($userAllAlbum[0]['id'], array_column($albumGroup, 'album_id'));
                            $path = $api->getMovie($albumGroup[$key]['movie_id'])['poster_path'];
                            $img = $api->getImg($path, 500);
                        }
                    }else{
                        $img = 'https://redellantasonline.com/assets/img-temp/200x300/img1.png';
                    }
                    array_push($imgs,$img);
                }
              ?>

            <div class="flex flex-col items-center ">   
              <?php
                echo '<div class="flex flex-col relative items-center w-10/12" >';
                  echo '<a class="absolute w-[40vh] h-[60vh] z-50" href="sharedAlbum.php"></a>';
                  echo '<p class="uppercase font-bold text-lg lg:text-3xl absolute bottom-1/2 z-30">Shared With You</p>';
                  echo '<div class="flex flex-row lg:mt-4 mt-2 ">';
                    echo '<div class="absolute rounded-lg w-[40vh] h-[60vh] bg-black opacity-30 z-20"></div>';
                    echo '<a href="sharedAlbum.php"><img class=" z-10 rounded-lg w-[40vh] h-[60vh]" src='.$imgs[0].'></a>';
                    echo '<div class="flex flex-row absolute w-[40vh] h-[60vh] -z-10 ml-[3vh]">';
                      echo '<div>';
                        echo '<div class="absolute rounded-lg w-[40vh] h-[60vh] bg-black opacity-50 z-20"></div>';
                        echo '<a href="sharedAlbum.php"><img class=" -z-30 absolute rounded-lg w-[40vh] h-[60vh]" src='.$imgs[1].'></a>';
                      echo '</div>';
                      echo '<div >';
                        echo '<div class="absolute rounded-lg w-[40vh] h-[60vh] ml-[3vh] bg-black opacity-70 -z-40"></div>';
                        echo '<a href="sharedAlbum.php"><img class="ml-[3vh]  -z-50 absolute rounded-lg w-[40vh] h-[60vh]" src='.$imgs[2].'></a>';
                      echo '</div>';
                    echo '</div>';
                  echo '</div>';
                echo '</div>';
                ?>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
        <?php
          }else{
            if($connection->getUserByUsername($_GET['username'],0,'') == null){
              echo '<h1 class="uppercase font-bold mt-8 lg:mt-4 text-2xl lg:text-3xl lg:mb-8 mb-2">No user found with the name "'.$_GET['username'].'"</h1>';
            }else{
              echo '<h1 class="uppercase font-bold mt-8 lg:mt-4 text-2xl lg:text-3xl lg:mb-8 mb-2">'.$_GET['username'].'\'s Profil</h1>';
        ?> 
          <div class="w-full h-[65vh] -ml-6 lg:-ml-0 grid grid-cols-1 lg:grid-cols-3 gap-4 mx-auto mt-6">
            <?php
              $userAllAlbum = $album->getAllAlbumFromUserId($_SESSION['user']['id'],0,0);
              $imgs = [];
              for($i = 0; $i < 3; $i++){
                  $albumGroup = $album->getFirstMovieIdOfAllAlbums();
                  if(!empty($userAllAlbum)) {
                      if ($i < count($userAllAlbum)) {
                          $key = array_search($userAllAlbum[$i]['id'], array_column($albumGroup, 'album_id'));
                          $path = $api->getMovie($albumGroup[$key]['movie_id'])['poster_path'];
                          $img = $api->getImg($path, 500);
                      } else {
                          $key = array_search($userAllAlbum[0]['id'], array_column($albumGroup, 'album_id'));
                          $path = $api->getMovie($albumGroup[$key]['movie_id'])['poster_path'];
                          $img = $api->getImg($path, 500);
                      }
                  }else{
                      $img = 'https://redellantasonline.com/assets/img-temp/200x300/img1.png';
                  }
                  array_push($imgs,$img);
                }
            ?>
            <div class="flex flex-col items-center">
              <?php
                echo '<div class="flex flex-col relative items-center w-10/12" >';
                  echo '<a class="absolute w-[40vh] h-[60vh] z-50" href="albums.php?username='.$_GET['username'].'"></a>';
                  echo '<p class="uppercase font-bold text-lg lg:text-3xl absolute bottom-1/2 z-30">'.$_GET['username'].'\'s Albums</p>';
                  echo '<div class="flex flex-row lg:mt-4 mt-2 ">';
                    echo '<div class="absolute rounded-lg w-[40vh] h-[60vh] bg-black opacity-30 z-20"></div>';
                    echo '<a href="albums.php?username='.$_GET['username'].'"><img class=" z-10 rounded-lg w-[40vh] h-[60vh]" src='.$imgs[0].'></a>';
                    echo '<div class="flex flex-row absolute w-[40vh] h-[60vh] -z-10 ml-[3vh]">';
                      echo '<div>';
                        echo '<div class="absolute rounded-lg w-[40vh] h-[60vh] bg-black opacity-50 z-20"></div>';
                        echo '<a href="albums.php?username='.$_GET['username'].'"><img class=" -z-30 absolute rounded-lg w-[40vh] h-[60vh]" src='.$imgs[1].'></a>';
                      echo '</div>';
                      echo '<div >';
                        echo '<div class="absolute rounded-lg w-[40vh] h-[60vh] ml-[3vh] bg-black opacity-70 -z-40"></div>';
                        echo '<a href="albums.php?username='.$_GET['username'].'"><img class="ml-[3vh]  -z-50 absolute rounded-lg w-[40vh] h-[60vh]" src='.$imgs[2].'></a>';
                      echo '</div>';
                    echo '</div>';
                  echo '</div>';
                echo '</div>';
                ?>
            </div>
            <?php
                $userAllAlbum = $album->getAllLikedAlbumsFromUser($_SESSION['user']['id']);
                $imgs = [];
                for($i = 0; $i < 3; $i++){
                    $albumGroup = $album->getFirstMovieIdOfAllAlbums();
                    if(!empty($userAllAlbum)) {
                        if ($i < count($userAllAlbum)) {
                            $key = array_search($userAllAlbum[$i]['album_id'], array_column($albumGroup, 'album_id'));
                            $path = $api->getMovie($albumGroup[$key]['movie_id'])['poster_path'];
                            $img = $api->getImg($path, 500);
                        } else {
                            $key = array_search($userAllAlbum[0]['album_id'], array_column($albumGroup, 'album_id'));
                            $path = $api->getMovie($albumGroup[$key]['movie_id'])['poster_path'];
                            $img = $api->getImg($path, 500);
                        }
                    }else{
                        $img = 'https://redellantasonline.com/assets/img-temp/200x300/img1.png';
                    }
                    array_push($imgs,$img);
                }
              
            ?>
            <div class="flex flex-col items-center">
              <?php

                echo '<div class="flex flex-col relative items-center w-10/12" >';
                  echo '<a class="absolute w-[40vh] h-[60vh] z-50" href="likedAlbum.php?username='.$_GET['username'].'"></a>';
                  echo '<p class="uppercase font-bold text-lg lg:text-3xl absolute bottom-1/2 z-30">'.$_GET['username'].'\'s Liked Albums</p>';
                  echo '<div class="flex flex-row lg:mt-4 mt-2 ">';
                    echo '<div class="absolute rounded-lg w-[40vh] h-[60vh] bg-black opacity-30 z-20"></div>';
                    echo '<a href="likedAlbum.php?username='.$_GET['username'].'"><img class=" z-10 rounded-lg w-[40vh] h-[60vh]" src='.$imgs[0].'></a>';
                    echo '<div class="flex flex-row absolute w-[40vh] h-[60vh] -z-10 ml-[3vh]">';
                      echo '<div>';
                        echo '<div class="absolute rounded-lg w-[40vh] h-[60vh] bg-black opacity-50 z-20"></div>';
                        echo '<a href="likedAlbum.php?username='.$_GET['username'].'"><img class=" -z-30 absolute rounded-lg w-[40vh] h-[60vh]" src='.$imgs[1].'></a>';
                      echo '</div>';
                      echo '<div >';
                        echo '<div class="absolute rounded-lg w-[40vh] h-[60vh] ml-[3vh] bg-black opacity-70 -z-40"></div>';
                        echo '<a href="likedAlbum.php?username='.$_GET['username'].'"><img class="ml-[3vh]  -z-50 absolute rounded-lg w-[40vh] h-[60vh]" src='.$imgs[2].'></a>';
                      echo '</div>';
                    echo '</div>';
                  echo '</div>';
                echo '</div>';
                
              ?>
            </div>
          </div>
      <?php
        }
      }
    ?>
  </main>
</body>
<?php
require_once '../utils/footer.php';
?>
</html>
