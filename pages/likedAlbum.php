<?php
require_once '../utils/header.php';
require_once '../actions/checkLogin.php';
require_once '../controllers/album.php';
require_once '../controllers/api.php';

$connection = new Connection();
$album = new Album();
$api = new API();

$_SESSION['likedAlbum_userUsername'] = null;

if(!isset($_GET['username'])){
    $_SESSION['likedAlbum_userUsername'] = $_SESSION['user']['username'];
}else{
    if ($connection->getUserByUsername($_GET['username'], 0, '') == null) {
        $no_user = 1;
        echo '<h1>No user found with the name "' . $_GET['username'] . '"</h1>';
    }else{
        $_SESSION['likedAlbum_userUsername'] = $_GET['username'];
    }
}

if(!isset($no_user)) {

    $likedAlbums = $album->getAllLikedAlbumsFromUser($connection->getUserIdByUsername($_SESSION['likedAlbum_userUsername']));

    if(!isset($_GET['username'])){
        echo '<h2>The Albums you liked</h2>';
    }else{
        echo '<h2>The Albums that '.$_GET['username'].' liked</h2>';
    }

    foreach ($likedAlbums as $albums) {
        $movie_id = $album->getFirstMovieInAlbum($albums['album_id']);
        if (isset($movie_id)) {
            $movie = $api->getMovie($movie_id);
            $album_cover = $api->getImg($movie['poster_path'], 200);
        } else {
            $album_cover = 'https://redellantasonline.com/assets/img-temp/200x300/img1.png';
        }
        echo '<div id="l' . $albums['album_id'] . '">';
        $album_infos = $album->getAlbumInfosById($albums['album_id']);
        $user_infos = $connection->getUserById($album_infos[1]);
        echo $album_infos[2] . ' from ' . $user_infos[1] . '<br />';

        echo '<a href="likedAlbumContent.php?id=' . $albums['album_id'] . '"><img src=' . $album_cover . '></a><br>';
        if(!isset($_GET['username'])) {
            echo '<button onclick=likeAlbum(' . $albums['album_id'] . ',' . $_SESSION['user']['id'] . ')>👍</button>';
        }
        echo '</div>';
    }
}

?>
</body>
<?php
require_once '../utils/footer.php';
?>
</html>