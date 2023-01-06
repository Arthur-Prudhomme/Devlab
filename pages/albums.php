<?php
require_once '../utils/header.php';
require_once '../actions/checkLogin.php';
require_once '../controllers/album.php';
require_once '../controllers/api.php';

$connection = new Connection();
$album = new Album();
$api = new API();

if(!isset($_GET['username'])) {
    echo '<h2>Your Albums</h2>';
    $allAlbums = $album->getAllAlbumFromUserId($_SESSION['user']['id'],1);
    unset($_SESSION['exploreUsername']);
}else{
    if($connection->getUserByUsername($_GET['username'],0) == null){
        $no_user = 1;
        echo '<h1>No user found with the name "'.$_GET['username'].'"</h1>';
    }else{
        echo '<h2>'.$_GET['username'].'\'s Albums</h2>';
        $userId = $connection->getUserIdByUsername($_GET['username']);
        $allAlbums = $album->getAllAlbumFromUserId($userId,0);
        $_SESSION['exploreUsername'] = $_GET['username'];
    }
}
if(!isset($no_user)){
    foreach ($allAlbums as $albums) {
        $movie_id = $album->getFirstMovieInAlbum($albums['id']);
        if (isset($movie_id)) {
            $movie = $api->getMovie($movie_id);
            $album_cover = $api->getImg($movie['poster_path'], 200);
        } else {
            $album_cover = 'https://redellantasonline.com/assets/img-temp/200x300/img1.png';
        }
        echo '<div id="' . $albums['id'] . '">';
        echo $albums['name'] . '<br />';
        echo '<a href="albumContent.php?id=' . $albums['id'] . '"><img src=' . $album_cover . '></a><br>';
        echo '</div>';
        if(isset($_GET['username'])){
            if ($_GET['username'] !== $_SESSION['user']['username']) {
                echo '<button onclick=likeAlbum(' . $albums['id'] . ',' . $_SESSION['user']['id'] . ')>👍</button>';
            }
        }else{
            $likes = $album->getLikesOnAlbum($albums['id']);
            if($likes != 0){
                echo $likes.' likes';
            }
        }
    }
}

?>
</body>
<?php
require_once '../utils/footer.php';
?>
</html>