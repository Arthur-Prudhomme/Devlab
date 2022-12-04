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

    <form method="post">
        <input type="text" name="search" placeholder="enter keyword">
        <input type="submit" value="Search">
    </form>

    <?php
        $keyword = $_GET['keyword'];
        $page = $_GET['page'];

        require_once 'core.php';
        $core = new Core();

        $search = $core->getMovieBySearch($keyword,$page);
        foreach($search['results'] as $item) {
            $movie = $core->getMovie($item['id']);
            echo '<div>';
            echo $movie['title'] . '<br />';
            echo '<a href=movie.php?id='.$movie['id'].'><img src='. $core->getImg($movie['poster_path'],200).'></a>';
            echo '</div>';
        }
    ?>

    <form method="post">
        <input type="number" name="page" placeholder="enter page" min="1" max="<?php echo $search['total_pages'] ?>" value="<?php echo $page ?>">
        <input type="submit" value="Jump to">
    </form>

    <?php
        if(isset($_POST['search'])){
            header("Location: search.php?keyword=".$_POST['search']."&page=1");
        }
        if(isset($_POST['page'])){
            header("Location: search.php?keyword=".$keyword."&page=".$_POST['page']);
        }
    ?>
</body>
</html>