<?php
if($_SERVER['REQUEST_METHOD'] === 'GET'){
    require_once '../utils/header.php';
    $movie_id = $_GET['id'];
    require_once '../controllers/api.php';
    require_once '../controllers/connection.php';
    $api = new API();
    $movie = $api->getMovie($movie_id);
    $cast = $api->getCast($movie_id);

    echo '<div>';
    echo $movie['title'] . '<br />';
    echo '<img src='.$api->getImg($movie['poster_path'],300).'><br />';
    ?>

    <button onclick=button("watched")>watched</button>
    <button onclick=button("watch_later")>watch_later</button>
    <button onclick=button("add_to")>add to</button>
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
<?php
}elseif ($_SERVER['REQUEST_METHOD'] === 'POST'){
    require_once '../controllers/connection.php';
    require_once '../controllers/album.php';
    $album = new Album();
    $action = file_get_contents('php://input');
    $action = json_decode($action, true);
    if(isset($_SESSION['id'])){
        if($action["action"] == "watched"){
            $album_id = $album->getAlbumIdByNameAndUserId($_SESSION['id'], 'watched');
            $album->insertMovieIntoAlbum($album_id, $_GET['id'],1);
        }elseif($action["action"] == "watch_later"){
            $album_id = $album->getAlbumIdByNameAndUserId($_SESSION['id'], 'watch_later');
            $album->insertMovieIntoAlbum($album_id, $_GET['id'],1);
        }elseif($action["action"] == "add_to"){
            var_dump($action["action"]);
        }
    }else{
        ini_set('display_errors',0);
        throw new Error('You need to be logged to use this');
    }
}else{
    ini_set('display_errors',0);
    throw new Error('unknow method');
}