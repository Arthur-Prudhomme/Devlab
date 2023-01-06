<?php
require_once '../utils/header.php';
require_once '../actions/checkLogin.php';
require_once '../controllers/album.php';

$connection = new Connection();
$album = new Album();

if(!isset($_GET['username'])){
    echo '<h1>Hello ' . $_SESSION['user']['username'] . '</h1>';

    $invitations = $album->getAllPendingInvitationFromUserId($_SESSION['user']['id']);
    if(!empty($invitations)){
        foreach ($invitations as $invitation){
            echo '<div id="i' . $invitation['id'] . '">';
            echo $connection->getUserById($invitation['owner'])[1]
                . ' as invited you on ' .
                $album->getAlbumInfosById($invitation['album_id'])[2]
                . ' ' .
                '<button onclick=answerInvitation('.$invitation['id'].',1)>Accept</button>'
                . ' ' .
                '<button onclick=answerInvitation('.$invitation['id'].',0)>Deny</button>';
            echo '</div>';
        }
    }

    echo '<h2>Search User</h2>';
    echo '<input id="user_search_bar" name="input" oninput=instantResearch("../sources/dynamicUserSearch.php",1,0,0) />';
    echo '<ul id="user_search_results"></ul>';

    echo '<h2>Your Albums</h2>';
    echo '<a href="albums.php"><img src=https://redellantasonline.com/assets/img-temp/200x300/img1.png></a><br>';

    echo '<h2>Liked Albums</h2>';
    echo '<a href="likedAlbum.php"><img src=https://redellantasonline.com/assets/img-temp/200x300/img1.png></a><br>';

    echo '<h2>Shared With You</h2>';
    echo '<a href="sharedAlbum.php"><img src=https://redellantasonline.com/assets/img-temp/200x300/img1.png></a><br>';
}else{
    if($connection->getUserByUsername($_GET['username'],0,'') == null){
        echo '<h1>No user found with the name "'.$_GET['username'].'"</h1>';
    }else{
        echo '<h1>'.$_GET['username'].'\'s Profil</h1>';

        echo '<h2>'.$_GET['username'].'\'s Albums</h2>';
        echo '<a href="albums.php?username='.$_GET['username'].'"><img src=https://redellantasonline.com/assets/img-temp/200x300/img1.png></a><br>';

        echo '<h2>'.$_GET['username'].'\'s Liked Albums</h2>';
        echo '<a href="likedAlbum.php?username='.$_GET['username'].'"><img src=https://redellantasonline.com/assets/img-temp/200x300/img1.png></a><br>';
    }
}

?>
</body>
<?php
require_once '../utils/footer.php';
?>
</html>