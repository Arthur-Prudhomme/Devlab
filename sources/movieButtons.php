<?php
require_once '../controllers/connection.php';
require_once '../controllers/album.php';
$album = new Album();
$parameters = file_get_contents('php://input');
$parameters = json_decode($parameters, true);
if (isset($_SESSION['user']['id'])) {
    if ($parameters["action"] == "watched") {
        $album_id = $album->getAlbumIdByNameAndUserId($_SESSION['user']['id'], 'watched');
        $album->insertMovieIntoAlbum($album_id, $parameters['movie_id'] , 1);
    } elseif ($parameters["action"] == "watch_later") {
        $album_id = $album->getAlbumIdByNameAndUserId($_SESSION['user']['id'], 'watch_later');
        $album->insertMovieIntoAlbum($album_id, $parameters['movie_id'], 1);
    } elseif ($parameters["action"] == "add_to") {
        var_dump($parameters["action"]);
    }
} else {
    header('HTTP/1.0 403 Forbidden');
}