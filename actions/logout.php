<?php

require_once '../controllers/connection.php';

session_destroy();
header("Location: ../index.php");