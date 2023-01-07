<?php
require_once '../controllers/album.php';
require_once '../controllers/connection.php';
$album = new Album();
echo json_encode($album->getAllAlbumFromUserId($_SESSION['user']['id'],1,1));