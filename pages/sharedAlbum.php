<?php
require_once '../utils/header.php';
require_once '../actions/checkLogin.php';
require_once '../controllers/album.php';
require_once '../controllers/api.php';

$connection = new Connection();
$album = new Album();
$api = new API();

$allSharedAlbums = $album->getAllSharedAlbumsFromUser($_SESSION['user']['id']);

foreach ($allSharedAlbums as $albums) {
    $movie_id = $album->getFirstMovieInAlbum($albums['album_id']);
    if (isset($movie_id)) {
        $movie = $api->getMovie($movie_id);
        $album_cover = $api->getImg($movie['poster_path'], 200);
    } else {
        $album_cover = 'https://redellantasonline.com/assets/img-temp/200x300/img1.png';
    }
    echo '<div id="' . $albums['album_id'] . '">';
    echo $albums['name'] . ' from ' . $connection->getUserById($albums['user_id'])[1] . '<br />';
    echo '<a href="sharedAlbumContent.php?id=' . $albums['album_id'] . '"><img src=' . $album_cover . '></a><br>';
    echo '</div>';
    $likes = $album->getLikesOnAlbum($albums['album_id']);
    if($likes != 0){
        echo $likes.' likes';
    }
}
?>
</body>
<?php
require_once '../utils/footer.php';
?>
</html>