<?php
require_once '../utils/header.php';
require_once '../controllers/connection.php';
require_once '../controllers/album.php';
?>
<body>
<?php
require_once '../actions/logout.php';
$album = new Album();
$allAlbums = $album->getAllAlbumFromUserId($_SESSION['id']);

$album->insertMovieIntoAlbum($_GET['album_id'], $_GET['movie_id'], 0);
header("Location: ../pages/movie.php?id=" . $_GET['movie_id']);

?>
</body>
</html>