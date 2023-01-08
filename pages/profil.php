<?php
  require_once '../utils/header.php';
  require_once '../actions/checkLogin.php';
  require_once '../controllers/album.php';

  $connection = new Connection();
  $album = new Album();

?>

<main class="flex flex-col lg:mt-32 mt-10">
    <div class="w-11/12 mx-auto flex flex-col items-center">
      <div class="w-full lg:mx-auto flex lg:flex-row flex-col items-center justify-between">
        <div class="lg:w-1/2 w-full flex flex-row relative items-center pb-6">
          <?php 
      
            if(!isset($_GET['username'])){
            echo '<h1 class="uppercase font-bold mt-8 lg:mt-4 text-2xl lg:text-3xl lg:mb-8 mb-2">Hello ' . $_SESSION['user']['username'] . '</h1>';

            $invitations = $album->getAllPendingInvitationFromUserId($_SESSION['user']['id']);
            if(!empty($invitations)){
              foreach ($invitations as $invitation){
                echo '<div class="flex flex-row lg:w-7/12 w-full items-center text-sm lg:text-base bottom-0 absolute justify-between" id="i' . $invitation['id'] . '">';
                  echo $connection->getUserById($invitation['owner'])[1]
                    . ' as invited you on ' .
                    $album->getAlbumInfosById($invitation['album_id'])[2]
                    . ' ' .
                    '<button class=" text-white z-40 appear px-4 py-1 rounded border-2 border-white cursor-pointer" onclick=answerInvitation('.$invitation['id'].',1)>Accept</button>'
                    . ' ' .
                    '<button class=" text-white z-40 appear px-4 py-1 rounded border-2 border-rouge bg-rouge cursor-pointer" onclick=answerInvitation('.$invitation['id'].',0)>Deny</button>';
                echo '</div>';
              }
            }
          ?> 
        </div>
        <div class="lg:w-1/2 w-full flex flex-row relative">
          <?php
            echo '<input class="w-full mt-6 lg:mt-0 h-1/4 bg-transparent text-gris border border-gris p-1 px-2 rounded" id="user_search_bar" placeholder="Search User" name="input" oninput=instantResearch("../sources/dynamicUserSearch.php",1,0,0) />';
            echo '<ul class=" absolute flex flex-col pt-8 p-3 rounded top-0 z-50" id="user_search_results"></ul>';
          ?> 
        </div>
      </div>
      <div class="w-full h-[65vh] grid grid-cols-2 lg:grid-cols-3 gap-4 mx-auto mt-6">
        <?php
        ?> 
        <div class="flex flex-col items-center ">
          <?php
              echo '<div class="flex flex-col items-center">';
                echo '<div class="flex flex-col items-center text-center relative w-full">';
                  echo '<a class="absolute w-[31vh] h-[47vh] z-10 bottom-0" href="albums.php"></a>';
                  echo '<h2 class="absolute text-white font-bold text-base z-10 w-11/12 bottom-5">Your Albums</h2>';
                  echo '<a class="mt-4 w-[31vh] h-[47vh] ouaip" href="albums.php"><img class="rounded-lg lg:w-[40vh] " src=https://redellantasonline.com/assets/img-temp/200x300/img1.png></a>';
                  echo '<div class=" absolute gradient"></div>';
                echo '</div>';
              echo '</div>';
          ?>
        </div>
        <div class="flex flex-col items-center "> 
          <?php
              echo '<div class="flex flex-col items-center">';
                echo '<div class="flex flex-col items-center text-center relative w-full">';
                  echo '<a class="absolute w-[31vh] h-[47vh] z-10 bottom-0" href="likedAlbum.php"></a>';
                  echo '<h2 class="absolute text-white font-bold text-base z-10 w-11/12 bottom-5">Liked Albums</h2>';
                  echo '<a class="mt-4 w-[31vh] h-[47vh] ouaip" href="likedAlbum.php"><img class="rounded-lg lg:w-[40vh] " src=https://redellantasonline.com/assets/img-temp/200x300/img1.png></a>';
                  echo '<div class="w-[31vh] h-[47vh] absolute gradient"></div>';
                echo '</div>';
              echo '</div>';
          ?>
        </div>
        <div class="flex flex-col items-center "> 
          <?php
              echo '<div class="flex flex-col items-center">';
                echo '<div class="flex flex-col items-center text-center relative w-full">';
                  echo '<a class="absolute w-[31vh] h-[47vh] z-10 bottom-0" href="sharedAlbum.php"></a>';
                  echo '<h2 class="absolute text-white font-bold text-base z-10 w-11/12 bottom-5">Shared With You</h2>';
                  echo '<a class="mt-4 w-[31vh] h-[47vh] ouaip" href="sharedAlbum.php"><img class="rounded-lg lg:w-[40vh] " src=https://redellantasonline.com/assets/img-temp/200x300/img1.png></a>';
                  echo '<div class="w-[31vh] h-[47vh] absolute gradient"></div>';
                echo '</div>';
              echo '</div>';
          ?>
        </div>
      </div>
    <?php
    }else{
      ?>
      <div class="w-full h-[65vh] mx-auto mt-6">
        <?php
            if($connection->getUserByUsername($_GET['username'],0,'') == null){
                echo '<h1 class="uppercase font-bold mt-8 lg:mt-4 text-2xl lg:text-3xl lg:mb-8 mb-2">No user found with the name "'.$_GET['username'].'"</h1>';
            }else{
              echo '<h1 class="uppercase font-bold mt-8 lg:mt-4 text-2xl lg:text-3xl lg:mb-8 mb-2">'.$_GET['username'].'\'s Profil</h1>';
              ?>
              <div class="w-full h-[75vh] grid grid-cols-2 gap-4 mx-auto mt-6">
                <div class="flex flex-col items-center ">
                  <?php
                    echo '<div class="flex flex-col items-center">';
                      echo '<div class="flex flex-col items-center text-center relative w-full">';
                        echo '<a class="absolute w-[31vh] h-[47vh] z-10 bottom-0" href="albums.php?username='.$_GET['username'].'"></a>';
                        echo '<p class="absolute text-white font-bold text-base z-10 w-11/12 bottom-5">'.$_GET['username'].'\'s Albums</p>';
                        echo '<a class="mt-4 w-[31vh] h-[47vh] ouaip" href="albums.php?username='.$_GET['username'].'"><img class="rounded-lg lg:w-[31vh] lg:h-[47vh] " src=https://redellantasonline.com/assets/img-temp/200x300/img1.png></a>';
                        echo '<div class="w-[31vh] h-[47vh] absolute gradient"></div>';
                      echo '</div>';
                    echo '</div>';
                  ?> 
                </div>
                <div class="flex flex-col items-center ">
                  <?php
                    echo '<div class="flex flex-col items-center">';
                      echo '<div class="flex flex-col items-center text-center relative w-full">';
                        echo '<a class="absolute w-[31vh] h-[47vh] z-10 bottom-0" href="likedAlbum.php?username='.$_GET['username'].'"></a>';
                        echo '<p class="absolute text-white font-bold text-base z-10 w-11/12 bottom-5">'.$_GET['username'].'\'s Liked Albums</p>';
                        echo '<a class="mt-4 w-[31vh] h-[47vh] ouaip" href="likedAlbum.php?username='.$_GET['username'].'"><img class="rounded-lg lg:w-[31vh] lg:h-[47vh] " src=https://redellantasonline.com/assets/img-temp/200x300/img1.png></a>';
                        echo '<div class="w-[31vh] h-[47vh] absolute gradient"></div>';
                      echo '</div>';
                    echo '</div>';
                      }
                    }
                  ?>
                </div>
              </div>
          </div>
        </div>
      </div>
    </div>
  </main>


</body>
<?php
require_once '../utils/footer.php';
?>
</html>
