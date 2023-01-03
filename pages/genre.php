<?php
require_once '../utils/header.php';
require_once '../controllers/api.php';
$genre_id = $_GET['id'];
$page = $_GET['page'];
$order_by = "popularity." . $_GET['order'];
$api = new API();

$movie = $api->getMovieByGenre($genre_id, $page, $order_by);
?>

<?php
  if (!empty($_POST)) {
    header("Location: genre.php?id=" . $genre_id . "&page=" . $_POST['page']);
  }
?>

  <main class="flex flex-col mt-20 lg:mt-32  w-11/12 mx-auto">
    
    <div class="films grid grid-cols-2 lg:grid-cols-5 gap-4 mx-auto mt-8">
    
      <?php
    
        foreach($movie['results'] as $item) {
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
        <input class="text-fond rounded-md pl-1 w-1/12" type="number" name="page" placeholder="enter page" min="1" max="
        <?php if($movie['total_pages'] > 500){
              echo 500;
          } else{
              echo $movie['total_pages'];
          }
        ?>"value="<?php echo $page ?>">
        <input class="text-white" type="submit" value="Jump to">
    </form>
  </main>
</body>
<?php
require_once '../utils/footer.php';
?>
</html>