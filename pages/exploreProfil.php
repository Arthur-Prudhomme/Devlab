<?php
require_once '../utils/header.php';
require_once '../actions/checkLogin.php';

$connection = new Connection();

if($connection->getUserByUsername($_GET['username'],0) == null){
    echo '<h1>No user found with the name "'.$_GET['username'].'"</h1>';
}else{
    echo '<h1>'.$_GET['username'].'\'s Profil</h1>';

    echo '<h2>'.$_GET['username'].'\'s Albums</h2>';
    echo '<a href="exploreAlbum.php?username='.$_GET['username'].'"><img src=https://redellantasonline.com/assets/img-temp/200x300/img1.png></a><br>';

    echo '<h2>'.$_GET['username'].'\'s Liked Albums</h2>';
    echo '<a href="exploreLikedAlbum.php?username='.$_GET['username'].'"><img src=https://redellantasonline.com/assets/img-temp/200x300/img1.png></a><br>';
}

?>
</body>
<?php
require_once '../utils/footer.php';
?>
</html>
