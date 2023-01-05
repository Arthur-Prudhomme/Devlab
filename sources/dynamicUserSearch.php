<?php
require_once '../controllers/connection.php';
$parameters = file_get_contents('php://input');
$parameters = json_decode($parameters, true);
$query = $parameters['query'];
$connection = new Connection();
$search_results = $connection->getUserByUsername($query,1);
echo json_encode($search_results);