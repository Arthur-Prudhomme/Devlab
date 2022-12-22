<?php
require_once '../utils/header.php';
require_once '../controllers/connection.php';
require_once '../controllers/album.php';
require_once '../controllers/api.php';
?>
<body>
<?php
require_once '../connection/logout.php';
$album = new Album();
$allMovies = $album->getAllMoviesFromAlbumId($_GET['id']);
$api = new API();

foreach ($allMovies as $movies){
    $movie = $api->getMovie($movies['movie_id']);
    echo '<div>';
    echo $movie['title'] . '<br />';
    echo '<a href="movie.php?id='. $movies['movie_id'] .'"><img src='. $api->getImg($movie['poster_path'],200).'></a>';
    echo '</div>';
}
?>
</body>
</html>