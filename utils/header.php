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
        if($_SERVER['REQUEST_METHOD'] === 'GET'){

        if(isset($check_path)){
            echo '<a href="./index.php">Home</a>';
            echo ' | ';
            echo '<a href="./mids/allGenre.php">Genre</a>';
            echo ' | ';
            echo '<a href="./pages/trending.php?page=1">Trending</a>';
            echo ' | ';
            echo '<a href="./pages/topRated.php?page=1">Top Rated</a>';
            echo ' ';
        }else{
            echo '<a href="../index.php">Home</a>';
            echo ' | ';
            echo '<a href="../mids/allGenre.php">Genre</a>';
            echo ' | ';
            echo '<a href="../pages/trending.php?page=1">Trending</a>';
            echo ' | ';
            echo '<a href="../pages/topRated.php?page=1">Top Rated</a>';
            echo ' ';
        }

        if(isset($check_path)){$check = 1;}else{$check = 0;}
        echo '<input id="search_bar" name="input" oninput=instantResearch('.$check.') />';

        if(isset($check_path)){
            require_once './controllers/connection.php';
            if(isset($_SESSION['user']['id'])){
                echo '<button><a href="./mids/accountNav.php">Account</a></button>';
            }else{
                echo '<button><a href="./connection/login.php">Login</a></button>';
            }
        }else{
            require_once '../controllers/connection.php';
            if(isset($_SESSION['user']['id'])){
                echo '<button><a href="../mids/accountNav.php">Account</a></button>';
            }else{
                echo '<button><a href="../connection/login.php">Login</a></button>';
            }
        }

        echo '<ul id="search_results"></ul>';

        }elseif($_SERVER['REQUEST_METHOD'] === 'POST'){
            require_once './controllers/api.php';
            $parameters = file_get_contents('php://input');
            $parameters = json_decode($parameters, true);
            $query = $parameters['query'];
            $check_path = $parameters['check_path'];
            $api = new API();
            $search_results = $api->getMovieBySearch($query,1);
            echo json_encode($search_results);
        }
    ?>
</head>
