<?php
require_once '../controllers/api.php';
$parameters = file_get_contents('php://input');
$parameters = json_decode($parameters, true);
$query = $parameters['query'];
$api = new API();
$search_results = $api->getMovieBySearch($query, 1);
echo json_encode($search_results);