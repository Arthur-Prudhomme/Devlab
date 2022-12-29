<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>login</title>
    <link href="../style.css" rel="stylesheet">
</head>
<body>
<form method="POST">
    <input type="email" name="email" placeholder="email">
    <input type="password" name="password" placeholder="password">
    <input type="submit" value="Login">
</form>
<button><a href="./register.php">Don't have an account ?</a></button>
<button><a href="../index.php">Back</a></button>
<?php
require_once '../controllers/connection.php';

if ($_POST) {
    $connection = new Connection();
    $login = $connection->login();
}
?>
</body>
</html>