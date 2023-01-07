<?php
require_once '../utils/header.php';
require_once '../actions/checkLogin.php';
require_once '../controllers/album.php';
require_once '../controllers/api.php';

$album = new Album();
$connection = new Connection();
$api = new API();

if($album->checkIfAlbumBelongsToUser($_GET['id'],$_SESSION['user']['id'])){
    $allMovies = $album->getAllMoviesFromAlbumId($_GET['id']);

    foreach ($allMovies as $movies) {
        $movie = $api->getMovie($movies['movie_id']);
        echo '<div id="'.$movies['movie_id'].'">';
        echo $movie['title'] . '<br />';
        echo '<a href="movie.php?id=' . $movies['movie_id'] . '"><img src=' . $api->getImg($movie['poster_path'], 200) . '></a><br>';
        echo '<button onclick=removeFromAlbum(' . $movies['movie_id'] . ',' . $_GET['id'] . ')>Remove From Album</button>';
        echo '<br></div>';
    }
} else {
    header("Location: ./sharedAlbum.php");
}
?>
</body>
<?php
require_once '../utils/footer.php';
?>
</html>