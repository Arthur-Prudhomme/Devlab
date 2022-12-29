<?php
require_once '../utils/header.php';
?>
<body>
<?php
require_once '../controllers/api.php';
require_once '../controllers/connection.php';
$movie_id = $_GET['id'];
$api = new API();
$movie = $api->getMovie($movie_id);
$cast = $api->getCast($movie_id);

echo '<div>';
echo $movie['title'] . '<br />';
echo '<img src=' . $api->getImg($movie['poster_path'], 300) . '><br />';
?>

<button onclick=button("watched",<?php echo $movie_id; ?>)>watched</button>
<button onclick=button("watch_later",<?php echo $movie_id; ?>)>watch_later</button>
<button onclick=button("add_to",<?php echo $movie_id; ?>)>add to</button>
<br>

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