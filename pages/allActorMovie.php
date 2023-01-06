<?php
require_once '../utils/header.php';
require_once '../controllers/api.php';
$person_id = $_GET['id'];
$page = $_GET['page'];
$api = new API();

$actorMovies = $api->getMovieByPerson($person_id, $page);
?>

<?php
if (!empty($_POST)) {
    header('Location: allActorMovie.php?id=' . $person_id . '&page=' . $_POST['page']);
}
?>

  <main class="flex flex-col mt-20 lg:mt-32  w-11/12 mx-auto">

    <h2 class="titre uppercase text-rouge mt-8 font-bold text-2xl">Movies</h2>

    <div class="films grid grid-cols-2 lg:grid-cols-5 gap-4 mx-auto mt-8">

        <?php

        foreach($actorMovies['results'] as $item) {
            echo '<a href=movie.php?id='.$item['id'].'>';
            echo '<div>';
            echo '<img src='.$api->getImg($item['poster_path'], 300).'>';
            echo '<div> </div>';
            echo '<p>'. $item["title"]. '</p>'. '<br />';
            echo '</div>';
            echo '</a>';
        }

        ?>

    </div>

    <form class="mt-8 mb-24" method="post">
        <input class="text-fond rounded-md pl-1 w-1/12" type="number" name="page" placeholder="enter page" min="1" max="<?php echo $actorMovies['total_pages'] ?>"
              value="<?php echo $page ?>">
        <input class="text-white" type="submit" value="Jump to">
    </form>

  </main>

</body>
<?php
require_once '../utils/footer.php';
?>
</html>