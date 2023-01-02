<?php
require_once '../utils/header.php';
require_once '../actions/checkLogin.php';
require_once '../controllers/album.php';
require_once '../controllers/api.php';

echo '<h1>Hello ' . $_SESSION['user']['username'] . '</h1>';

$album = new Album();
$api = new API();
$first_album_id = $album->getFirstAlbumFrom($_SESSION['user']['id'],0);
$first_album_first_movie_id = $album->getFirstMovieInAlbum($first_album_id);
$movie = $api->getMovie($first_album_first_movie_id);

echo '<h2>Your Albums</h2>';
echo '<a href="albums.php"><img src=' . $api->getImg($movie['poster_path'], 200) . '></a><br>';

echo '<h2>Liked Albums</h2>';
echo '<a href="likedAlbum.php"><img src=https://redellantasonline.com/assets/img-temp/200x300/img1.png></a><br>';

?>
</body>
<?php
require_once '../utils/footer.php';
?>
</html>