<?php
require_once '../utils/header.php';
require_once '../controllers/api.php';
$page = $_GET['page'];
$api = new API();

$topRated = $api->getTopRated($page);
?>

<?php
if (!empty($_POST)) {
    header("Location: topRated.php?page=" . $_POST['page']);
}
?>

  <main class="flex flex-col mt-20 lg:mt-32  w-11/12 mx-auto">

    <h2 class="titre uppercase text-rouge mt-8 font-bold text-2xl">Top Rated</h2>

    <div class="films grid grid-cols-2 lg:grid-cols-5 gap-4 mx-auto mt-8">

      <?php

        foreach($topRated['results'] as $item) {
          echo '<a href=movie.php?id='.$item['id'].'>';
          echo '<div>';
          echo '<img src='.$api->getImg($item['poster_path'], 200).'>';
          echo '<div> </div>';
          echo '<p>'. $item["title"]. '</p>'. '<br />';
          echo '</div>';
          echo '</a>';
      }

      ?>

    </div>

    <form class="mt-8 mb-24" method="post">
        <input class="text-fond rounded-md pl-1 w-1/12" type="number" name="page" placeholder="enter page" min="1" max="<?php echo $topRated['total_pages'] ?>"
              value="<?php echo $page ?>">
        <input class="text-white" type="submit" value="Jump to">
    </form>

  </main>

</body>
<?php
require_once '../utils/footer.php';
?>
</html>