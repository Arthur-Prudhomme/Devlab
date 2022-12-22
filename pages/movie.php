<?php
require_once '../utils/header.php';
?>
<?php
    $movie_id = $_GET['id'];
    require_once '../controllers/api.php';
    $api = new API();
    $movie = $api->getMovie($movie_id);
    $cast = $api->getCast($movie_id);

    echo '<div>';
    echo $movie['title'] . '<br />';
    echo '<img src='.$api->getImg($movie['poster_path'],300).'><br />';
    echo $movie['overview'];
    echo '<br><br>';

    echo '<div>';
    foreach($movie['genres'] as $item) {
        echo '<a href=genre.php?id='.$item['id'].'&page=1>'.$item['name'].'<br /></a>';
    }
    echo '</div>';
    echo '</div>';

    echo '<br><br>';
    foreach($cast['cast'] as $item) {
        echo '<div>';
        echo '<a href=actor.php?id='.$item['id'].'><img src='.$api->getImg($item['profile_path'],200).'><br /></a>';
        echo $item['name'] . ' as ' . $item['character'] . '<br />';
        echo '</div>';
        echo '<br><br>';
    }
?>

</body>
</html>