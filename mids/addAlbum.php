<?php
require_once '../utils/header.php';

?>
<body>
<?php
require_once '../actions/logout.php';
require_once '../controllers/connection.php';
require_once '../controllers/album.php';
$album = new Album();
?>

<form method="POST">
    <input type="text" name="album_name" placeholder="Name">
    <select name="visibility">
        <option value="public">Public</option>
        <option value="private">Private</option>
    </select>
    <input type="submit" name="create_album" placeholder="Create Album" value="create_album">
</form>

<?php
if (!empty($_POST)) {
    if ($_POST['visibility'] == 'public') {
        $visibility = 0;
    } else {
        $visibility = 1;
    }
    $album->createAlbum($_SESSION['user']['id'], $_POST['album_name'], $visibility);
    header("Location: ./allAlbums.php?movie_id=" . $_GET['movie_id']);
}
?>

</body>
<?php
require_once '../utils/footer.php';
?>
</html>