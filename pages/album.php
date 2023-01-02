<?php
require_once '../utils/header.php';
?>
<body>
<?php
require_once '../actions/checkLogin.php';
require_once '../controllers/connection.php';
require_once '../controllers/album.php';
echo '<h2>Your Albums</h2>';
$album = new Album();
$allAlbums = $album->getAllAlbumFromUserId($_SESSION['user']['id']);
$histAlbum = [];

foreach ($allAlbums as $albums) {
    array_push($histAlbum, $albums['id']);
    echo '<div>';
    echo '<a href="albumContent.php?id=' . $albums['id'] . '">' . $albums['name'] . '</a>';
    echo '</div>';
}
$_SESSION['hist'] = $histAlbum;
?>
</body>
<?php
require_once '../utils/footer.php';
?>
</html>