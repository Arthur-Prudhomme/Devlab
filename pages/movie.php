<?php
require_once '../utils/header.php';

    $movie_id = $_GET['id'];
    require_once '../controllers/api.php';
    require_once '../controllers/album.php';
    require_once '../controllers/connection.php';
    $api = new API();
    $movie = $api->getMovie($movie_id);
    $cast = $api->getCast($movie_id);

    echo '<div>';
    echo $movie['title'] . '<br />';
    echo '<img src='.$api->getImg($movie['poster_path'],300).'><br />';
    ?>

    <form method="POST">
        <input type="submit" name="watched" placeholder="Watched" value="watched">
        <input type="submit" name="watch_later" placeholder="Watch Later" value="watch_later">
        <input type="submit" name="add_to" placeholder="Add To" value="add_to">
    </form>

    <?php
    $album = new Album();
    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        if(isset($_SESSION['id'])){
            if(isset($_POST['watched'])){
                $album_id = $album->getAlbumIdByNameAndUserId($_SESSION['id'], 'watched');
                $album->insertMovieIntoAlbum($album_id, $_GET['id']);
            }elseif(isset($_POST['watch_later'])){
                $album_id = $album->getAlbumIdByNameAndUserId($_SESSION['id'], 'watch_later');
                $album->insertMovieIntoAlbum($album_id, $_GET['id']);
            }else{
                header("Location: ../mids/allAlbum.php?movie_id=" . $_GET['id']);
            }
        }else{
            echo 'You need to be logged to use this';
            echo '<br><br>';
        }
    }

    echo $movie['overview'];
    echo '<br><br>';

    echo '<div>';
    foreach ($movie['genres'] as $item) {
        echo '<a href=genre.php?id=' . $item['id'] . '&page=1>' . $item['name'] . '<br /></a>';
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
</html>