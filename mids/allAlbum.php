<?php
require_once '../utils/header.php';
?>
<body>
<?php
require_once '../actions/logout.php';
require_once '../controllers/connection.php';
require_once '../controllers/album.php';
$album = new Album();
$allAlbums = $album->getAllAlbumFromUserId($_SESSION['user']['id']);

foreach ($allAlbums as $albums) {
    if ($albums['is_watched'] == 0 && $albums['is_watch_later'] == 0) {
        echo '<div>';
        echo '<a href="../actions/addToAlbum.php?album_id=' . $albums['id'] . '&movie_id=' . $_GET['movie_id'] . '">' . $albums['name'] . '</a>';
        echo '</div>';
    }
}
?>
</body>
<?php
require_once '../utils/footer.php';
?>
</html>