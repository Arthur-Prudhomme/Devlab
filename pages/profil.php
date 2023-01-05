<?php
require_once '../utils/header.php';
require_once '../actions/checkLogin.php';
require_once '../controllers/album.php';
require_once '../controllers/api.php';

echo '<h1>Hello ' . $_SESSION['user']['username'] . '</h1>';

echo '<h2>Search User</h2>';
echo '<input id="user_search_bar" name="input" oninput=instantResearch("../sources/dynamicUserSearch.php",1) />';
echo '<ul id="user_search_results"></ul>';

echo '<h2>Your Albums</h2>';
echo '<a href="albums.php"><img src=https://redellantasonline.com/assets/img-temp/200x300/img1.png></a><br>';

echo '<h2>Liked Albums</h2>';
echo '<a href="likedAlbum.php"><img src=https://redellantasonline.com/assets/img-temp/200x300/img1.png></a><br>';

?>
</body>
<?php
require_once '../utils/footer.php';
?>
</html>