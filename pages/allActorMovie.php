<?php
require_once '../utils/header.php';
require_once '../controllers/api.php';
$person_id = $_GET['id'];
$page = $_GET['page'];
$api = new API();

$actorMovies = $api->getMovieByPerson($person_id, $page);

if (!empty($_POST)) {
    header('Location: allActorMovie.php?id=' . $person_id . '&page=' . $_POST['page']);
}
?>


<main class="flex flex-col mt-20 lg:mt-32  w-11/12 mx-auto">

  <h2 class="titre uppercase text-rouge mt-8 font-bold text-2xl">Movies</h2>

  <div class="films grid grid-cols-2 lg:grid-cols-5 gap-4 mx-auto mt-8">

    <?php

    foreach($actorMovies['results'] as $item) {
      echo '<div class="flex flex-col items-center">';
        echo '<div class="flex flex-col items-center text-center relative w-full">';
          echo '<a class="absolute w-[31vh] h-[47vh] z-10 bottom-0" href="movie.php?id=' . $item['id'] . '"></a>';
          echo '<p class="absolute text-white font-bold text-base z-10 w-11/12 bottom-5">'.$item["title"].'</p>';
          echo '<a class="mt-4 w-[31vh] h-[47vh] ouaip" href="movie.php?id='.$item['id'].'"><img class="rounded-lg lg:w-[31vh] lg:h-[47vh] " src='.$api->getImg($item['poster_path'], 300).'></a>';
          echo '<div class="w-[31vh] h-[47vh] absolute gradient"></div>';
        echo '</div>';
      echo '</div>';
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