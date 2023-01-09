<?php
require_once '../utils/header.php';
require_once '../actions/checkLogin.php';
require_once '../controllers/album.php';
require_once '../controllers/api.php';

$album = new Album();
$connection = new Connection();
$api = new API();

$album_id = $_GET['id'];
$user_id = $connection->getUserIdByUsername($_SESSION['likedAlbum_userUsername']);
$check = $album->checkIfAlbumIsLikedByUser($album_id, $user_id);

if($check){
    $allMovies = $album->getAllMoviesFromAlbumId($_GET['id']);

    foreach ($allMovies as $movies) {
        $movie = $api->getMovie($movies['movie_id']);
        echo '<div id="'.$movies['movie_id'].'">';
        echo $movie['title'] . '<br />';
        echo '<a href="movie.php?id=' . $movies['movie_id'] . '"><img src=' . $api->getImg($movie['poster_path'], 200) . '></a><br>';
        echo '<br></div>';
    }
} else {
    if($_SESSION['likedAlbum_userUsername'] === $_SESSION['user']['username']) {
        header("Location: ./likedAlbum.php");
    }else{
        header("Location: ./likedAlbum.php?username=".$_SESSION['likedAlbum_userUsername']);
    }
}
?>
</body>
<?php
require_once '../utils/footer.php';
?>
</html>