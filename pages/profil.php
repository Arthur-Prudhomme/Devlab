<?php
require_once '../utils/header.php';
require_once '../actions/checkLogin.php';
echo '<h1>Hello ' . $_SESSION['user']['username'] . '</h1>';
?>
<a href="albums.php">Your Albums</a>
<a href="./likedAlbum.php">Liked Albums</a>
</body>
<?php
require_once '../utils/footer.php';
?>
</html>