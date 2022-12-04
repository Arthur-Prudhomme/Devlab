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
    $genre_id = $_GET['id'];
    $page = $_GET['page'];

    require_once 'core.php';
    $core = new Core();

    $movie = $core->getMovieByGenre($genre_id,$page);
    foreach($movie['results'] as $item) {
        echo '<div>';
        echo $item['title'] . '<br />';
        echo '<a href=movie.php?id='.$item['id'].'><img src='. $core->getImg($item['poster_path'],200).'></a>';
        echo '</div>';
    }
    ?>
    <form method="post">
        <input type="number" name="page" placeholder="enter page" min="1" max="<?php echo $movie['total_pages'] ?>" value="<?php echo $page ?>">
        <input type="submit" value="Jump to">
    </form>
    <?php
        if(!empty($_POST)){
            header("Location: genre.php?id=".$genre_id."&page=".$_POST['page']);
        }
    ?>
</body>
</html>