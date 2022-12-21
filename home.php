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
<a href="AllGenre.php">Genre</a>
<a href="trending.php?page=1">Trending</a>
<a href="topRated.php?page=1">Top Rated</a>

<form method="post">
    <input type="text" name="search" placeholder="enter keyword">
    <input type="submit" value="Search">
</form><br>

    <?php
        if(!empty($_POST)){
            header("Location: search.php?keyword=".$_POST['search']."&page=1");
        }

        require_once 'core.php';
        $core = new Core();
        $trending = $core->getTrending(1);

        foreach($trending['results'] as $item) {
            echo '<div>';
            echo $item['title'] . '<br />';
            echo '<a href=movie.php?id='.$item['id'].'><img src='. $core->getImg($item['poster_path'],200).'></a>';
            echo '</div>';
        }
    ?>
</body>
</html>