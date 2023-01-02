<?php
require_once '../utils/header.php';
require_once '../actions/checkLogin.php';
require_once '../controllers/connection.php';
require_once '../controllers/album.php';
require_once '../controllers/api.php';

$album = new Album();
$convert = (int)$_GET['id'];
$check = array_search($convert, $_SESSION['hist']);
if (is_int($check)) {
    $allMovies = $album->getAllMoviesFromAlbumId($_GET['id']);
    $api = new API();
    $checkIfDeletable = $album->isWatchedOrWatchLater($_GET['id']);
    if($checkIfDeletable === false){
        echo '<button onclick=""><h3>Delete Album</h3></button><br><br><br>';
    }

    foreach ($allMovies as $movies) {
        $movie = $api->getMovie($movies['movie_id']);
        echo '<div id="'.$movies['movie_id'].'">';
        echo $movie['title'] . '<br />';
        echo '<a href="movie.php?id=' . $movies['movie_id'] . '"><img src=' . $api->getImg($movie['poster_path'], 200) . '></a><br>';
        echo '<button onclick=removeFromAlbum('.$movies['movie_id'].','.$_GET['id'].')>Remove From Album</button>';
        echo '</div><br>';
    }
} else {
    header("Location: ./albums.php");
}
?>
</body>
<?php
require_once '../utils/footer.php';
?>
</html>