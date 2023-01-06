<?php
require_once '../controllers/connection.php';
$parameters = file_get_contents('php://input');
$parameters = json_decode($parameters, true);
$connection = new Connection();
$search_results = $connection->getUserByUsername($parameters['query'],1,$parameters['excludeUser']);
echo json_encode($search_results);