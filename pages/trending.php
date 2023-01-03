<?php
require_once '../utils/header.php';
require_once '../controllers/api.php';
$page = $_GET['page'];
$api = new API();

$trending = $api->getTrending($page);
?>

<?php
  if (!empty($_POST)) {
    header("Location: trending.php?page=" . $_POST['page']);
  }
?>

  <main class="flex flex-col mt-20 lg:mt-32  w-11/12 mx-auto">
    <div class="flex flex-row w-full items-center mx-auto">
      <h2 class="titre uppercase text-rouge font-bold text-2xl w-11/12 mx-auto">trending</h2>
      <div class="w-full flex flex-col items-end">
        <button class="btnFilter uppercase bg-fond text-rouge rounded-md px-4 py-1 font-bold w-max focus:rounded-br-none relative">filter

        <div class="hidden filter absolute top-8 right-0 bg-fond text-gris capitalize flex flex-col lg:w-[500px] w-[300px] rounded-lg rounded-tr-none py-4 pb-6 justify-between z-20 font-normal">
          <div class="mt-2 flex flex-col lg:flex-row lg:items-center items-start w-11/12 mx-auto ">
            <div>
              <h3 class="uppercase font-bold mr-2">movies</h3>
            </div>
            <div class="mt-2">
              <input name="drone" class="w-4 h-4 mr-2 ml-1" type="radio">All
              <input name="drone" class="w-4 h-4 mr-2 ml-1" type="radio">Watched
              <input name="drone" class="w-4 h-4 mr-2 ml-1" type="radio">Unwatched
            </div>
          </div>
          <div class="w-full border-t-gris border-t mt-4"></div>
          <div class="mt-4 flex flex-col lg:flex-row lg:items-center items-start w-11/12 mx-auto">
            <div>
              <h3 class="uppercase font-bold mr-2">age</h3>
            </div>

            <div class="mt-2">
              <input name="drone" class="w-4 h-4 mr-2 ml-1" type="radio">All
              <input name="drone" class="w-4 h-4 mr-2 ml-1" type="radio">-18
              <input name="drone" class="w-4 h-4 mr-2 ml-1" type="radio">-16
              <input name="drone" class="w-4 h-4 mr-2 ml-1" type="radio">-12
            </div>
            
          </div>
          <div class="w-full border-t-gris border-t mt-4"></div>
          <div class="mt-4 flex flex-col lg:flex-row lg:items-center items-start w-11/12 mx-auto">
            <div>
              <h3 class="uppercase font-bold mr-2">order</h3>
            </div>
            <div class="mt-2">
              <input name="drone" class="w-4 h-4 mr-2 ml-1" type="radio">Ascending
              <input name="drone" class="w-4 h-4 mr-2 ml-1" type="radio">Descending
            </div>
            
          </div>
        </div>
        </button>
      </div>
    </div>

    <div class="films grid grid-cols-2 lg:grid-cols-5 gap-4 mx-auto mt-8">
      <?php

        foreach($trending['results'] as $item) {
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
      <input class="text-fond rounded-md pl-1 w-1/12" type="number" name="page" placeholder="enter page" min="1" max="<?php echo $trending['total_pages'] ?>"
        value="<?php echo $page ?>">
      <input class="text-white" type="submit" value="Jump to">
    </form>

  </main>

</body>
<?php
require_once '../utils/footer.php';
?>
</html>