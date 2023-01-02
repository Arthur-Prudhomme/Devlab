<?php
require_once '../utils/header.php';
?>
<body>
<?php
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

    foreach ($allMovies as $movies) {
        $movie = $api->getMovie($movies['movie_id']);
        echo '<div>';
        echo $movie['title'] . '<br />';
        echo '<a href="movie.php?id=' . $movies['movie_id'] . '"><img src=' . $api->getImg($movie['poster_path'], 200) . '></a>';
        echo '</div>';
    }
} else {
    header("Location: ./album.php");
}
?>
</body>
<?php
require_once '../utils/footer.php';
?>
</html>