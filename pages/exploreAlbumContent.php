<?php
require_once '../utils/header.php';
require_once '../actions/checkLogin.php';
require_once '../controllers/connection.php';
require_once '../controllers/album.php';
require_once '../controllers/api.php';

$album = new Album();
$connection = new Connection();

$user_id = $connection->getUserIdByUsername($_SESSION['exploreUsername']);

if ($album->checkIfAlbumBelongsToUser($_GET['id'],$user_id)) {
    $allMovies = $album->getAllMoviesFromAlbumId($_GET['id']);
    $api = new API();
    $checkIfDeletable = $album->isWatchedOrWatchLater($_GET['id']);
    if($checkIfDeletable === false){
        echo '<br><form method="POST"><input type="submit" value="Delete Album"></form><br><br>';
    }

    foreach ($allMovies as $movies) {
        $movie = $api->getMovie($movies['movie_id']);
        echo '<div id="'.$movies['movie_id'].'">';
        echo $movie['title'] . '<br />';
        echo '<a href="movie.php?id=' . $movies['movie_id'] . '"><img src=' . $api->getImg($movie['poster_path'], 200) . '></a><br>';
        echo '<br></div>';
    }
} else {
    header("Location: ./exploreAlbum.php?username=".$_SESSION['exploreUsername']);
}
?>
</body>
<?php
require_once '../utils/footer.php';
?>
</html>