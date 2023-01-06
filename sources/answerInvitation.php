<?php
require_once '../controllers/album.php';
$parameters = file_get_contents('php://input');
$parameters = json_decode($parameters, true);
$album = new Album();
$album->answerInvitation($parameters['invitation_id'],$parameters['answer']);