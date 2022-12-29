<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="./style.css" rel="stylesheet">
    <link href="../style.css" rel="stylesheet">

    <?php
    require_once '../controllers/connection.php';

    echo '<a href="../pages/home.php">Home</a>';
    echo ' | ';
    echo '<a href="../mids/allGenre.php">Genre</a>';
    echo ' | ';
    echo '<a href="../pages/trending.php?page=1">Trending</a>';
    echo ' | ';
    echo '<a href="../pages/topRated.php?page=1">Top Rated</a>';
    echo ' ';
    ?>

    <input id="search_bar" name="input" oninput=instantResearch('../fragments/dynamicSearch.php') />

    <?php

    if (isset($_SESSION['user']['id'])) {
        echo '<button><a href="../mids/accountNav.php">Account</a></button>';
    } else {
        echo '<button><a href="../connection/login.php">Login</a></button>';
    }
    ?>
    <ul id="search_results"></ul>
</head>
