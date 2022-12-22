<?php
require_once './header.php';
?>
<body>
    <?php
    $genre_id = $_GET['id'];
    $page = $_GET['page'];

    require_once '../controllers/api.php';
    $api = new API();

    $movie = $api->getMovieByGenre($genre_id,$page);
    foreach($movie['results'] as $item) {
        echo '<div>';
        echo $item['title'] . '<br />';
        echo '<a href=movie.php?id='.$item['id'].'><img src='. $api->getImg($item['poster_path'],200).'></a>';
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