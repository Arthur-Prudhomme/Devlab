<?php
require_once '../utils/header.php';
?>
<body>
<?php
    $person_id = $_GET['id'];
    $page = $_GET['page'];

    require_once '../controllers/api.php';
    $api = new API();

    $actorMovies = $api->getMovieByPerson($person_id,$page);
    foreach($actorMovies['results'] as $item) {
        echo '<div>';
        echo $item['title'] . '<br />';
        echo '<a href=../pages/movie.php?id='.$item['id'].'><img src='. $api->getImg($item['poster_path'],200).'></a>';
        echo '</div>';
    }
    ?>
    <form method="post">
        <input type="number" name="page" placeholder="enter page" min="1" max="<?php echo $actorMovies['total_pages'] ?>" value="<?php echo $page ?>">
        <input type="submit" value="Jump to">
    </form>
    <?php
    if(!empty($_POST)){
        header('Location: allActorMovie.php?id='.$person_id.'&page='.$_POST['page']);
    }
?>
</body>
<?php
require_once '../utils/footer.php';
?>
</html>