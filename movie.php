<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="./style.css" rel="stylesheet">
</head>
<body>
<?php
    $movie_id = $_GET['id'];
    require_once 'core.php';
    $core = new Core();
    $movie = $core->getMovie($movie_id);
    $cast = $core->getCast($movie_id);

    echo '<div>';
    echo $movie['title'] . '<br />';
    echo '<img src='.$core->getImg($movie['poster_path'],300).'><br />';
    echo $movie['overview'];
    echo '<br><br>';

    echo '<div>';
    foreach($movie['genres'] as $item) {
        echo '<a href=genre.php?id='.$item['id'].'&page=1>'.$item['name'].'<br /></a>';
    }
    echo '</div>';
    echo '</div>';

    echo '<br><br>';
    foreach($cast['cast'] as $item) {
        echo '<a href=actor.php?id='.$item['id'].'>';
        echo '<div>';
        echo '<img src='.$core->getImg($item['profile_path'],200).'><br />';
        echo $item['name'] . ' as ' . $item['character'] . '<br />';
        echo '</div>';
        echo '</a><br><br>';
    }
?>

</body>
</html>