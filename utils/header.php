<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="./style.css" rel="stylesheet">
    <link href="../style.css" rel="stylesheet">
</head>

<body>
<?php
require_once '../controllers/connection.php';

echo '<button><a href="../pages/home.php">Home</a></button>';
echo ' | ';
echo '<button onclick=allAlbum()>Genre</button>';
echo ' | ';
echo '<button><a href="../pages/trending.php?page=1">Trending</a></button>';
echo ' | ';
echo '<button><a href="../pages/topRated.php?page=1">Top Rated</a></button>';
echo ' ';
?>

<input id="search_bar" name="input" oninput=instantResearch('../sources/dynamicSearch.php',0,0) />

<?php

if (isset($_SESSION['user'])) {
    echo '<button onclick=accountNav()>Account</button>';
} else {
    echo '<button><a href="../connection/login.php">Login</a></button>';
}
?>
<ul id="account_nav"></ul>
<ul id="search_results"></ul>
<ul id="genre_list"></ul>
