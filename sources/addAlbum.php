<?php
require_once '../controllers/album.php';
require_once '../controllers/connection.php';
$parameters = file_get_contents('php://input');
$parameters = json_decode($parameters, true);
$album = new Album();
$album->createAlbum($_SESSION['user']['id'],$parameters['album_name'],$parameters['album_visibility']);