<?php
require_once '../utils/header.php';
require_once '../controllers/api.php';
require_once '../controllers/connection.php';
require_once '../controllers/album.php';
$movie_id = $_GET['id'];
$api = new API();
$album = new Album();
$movie = $api->getMovie($movie_id);
$cast = $api->getCast($movie_id);

echo '<div>';
echo $movie['title'] . '<br />';
echo '<img src=' . $api->getImg($movie['poster_path'], 300) . '><br />';

if (isset($_SESSION['user']['id'])) {
    echo '<button id="watched" onclick=watchedOrWatchLater("watched",' . $movie_id . ')>watched</button>';
    echo '<button id="watch_later" onclick=watchedOrWatchLater("watch_later",' . $movie_id . ')>watch_later</button>';
    echo '<button onclick=addTo(' . $movie_id . ')>add to</button>';
    $belongsToWatched = $album->checkIfMovieBelongsToUserWatchedOrWatchLater($_SESSION['user']['id'],$movie_id,1);
    $belongsToWatchLater = $album->checkIfMovieBelongsToUserWatchedOrWatchLater($_SESSION['user']['id'],$movie_id,0);
    echo '<div style="display: none" id="belongsToWatched">'.$belongsToWatched.'</div>';
    echo '<div style="display: none" id="belongsToWatchLater">'.$belongsToWatchLater.'</div>';
}
?>
<ul id="album_list"></ul>

<?php

echo $movie['overview'];
echo '<br><br>';

echo '<div>';
foreach ($movie['genres'] as $item) {
    echo '<a href=genre.php?id=' . $item['id'] . '&page=1&order=desc>' . $item['name'] . '<br /></a>';
}
echo '</div>';
echo '</div>';

echo '<br><br>';
foreach ($cast['cast'] as $item) {
    echo '<div>';
    echo '<a href=actor.php?id=' . $item['id'] . '><img src=' . $api->getImg($item['profile_path'], 200) . '><br /></a>';
    echo $item['name'] . ' as ' . $item['character'] . '<br />';
    echo '</div>';
    echo '<br><br>';
}
?>
</body>
<?php
require_once '../utils/footer.php';
?>
</html>