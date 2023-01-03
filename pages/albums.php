<?php
require_once '../utils/header.php';
require_once '../actions/checkLogin.php';
require_once '../controllers/connection.php';
require_once '../controllers/album.php';
require_once '../controllers/api.php';

echo '<h2>Your Albums</h2>';
$album = new Album();
$api = new API();
$allAlbums = $album->getAllAlbumFromUserId($_SESSION['user']['id']);
$histAlbum = [];

foreach ($allAlbums as $albums) {
    array_push($histAlbum, $albums['id']);
    $movie_id = $album->getFirstMovieInAlbum($albums['id']);
    if (isset($movie_id)) {
        $movie = $api->getMovie($movie_id);
        $album_cover = $api->getImg($movie['poster_path'], 200);
    } else {
        $album_cover = 'https://redellantasonline.com/assets/img-temp/200x300/img1.png';
    }
    echo '<div id="'.$albums['id'].'">';
    echo $albums['name'] . '<br />';
    echo '<a href="albumContent.php?id='.$albums['id'].'"><img src=' . $album_cover . '></a><br>';
    echo '</div>';
}
$_SESSION['hist'] = $histAlbum;
?>

</body>
<?php
require_once '../utils/footer.php';
?>
</html>