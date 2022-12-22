<?php
require_once '../utils/header.php';
require_once '../controllers/connection.php';
require_once '../controllers/album.php';
?>
<body>
<?php
require_once '../connection/logout.php';
$album = new Album();
$allAlbums = $album->getAllAlbumFromUserId($_SESSION['id']);

foreach ($allAlbums as $albums){
    echo '<div>';
    echo '<a href="album_content.php?id='. $albums['id'] .'">' . $albums['name'] . '</a>';
    echo '</div>';
}
?>
</body>
</html>