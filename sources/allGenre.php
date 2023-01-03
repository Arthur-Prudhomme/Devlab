<?php
require_once '../controllers/api.php';
$api = new API();
$allGenre = $api->getAllGenre();
echo json_encode($allGenre);