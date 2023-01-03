<?php
require_once '../controllers/album.php';
require_once '../controllers/connection.php';
$parameters = file_get_contents('php://input');
$parameters = json_decode($parameters, true);
$album = new Album();
$album->insertMovieIntoAlbum($parameters['album_id'],$parameters['movie_id'],0);