<?php
  require_once '../utils/header.php';
  require_once '../controllers/api.php';
  require_once '../controllers/connection.php';
  $movie_id = $_GET['id'];
  $api = new API();
  $movie = $api->getMovie($movie_id);
  $cast = $api->getCast($movie_id);

?>

  <main class="movie flex flex-col lg:mt-32 mt-20 ">
    <div class="flex flex-col lg:flex-row w-11/12 mx-auto text-gris ">
      <div class="affiche flex lg:w-5/12 rounded-2xl w-full">
        <?php 
          echo '<img class="w-[50vh] h-[80vh]" src='.$api->getImg($movie['poster_path'], 500) . '><br />';
        ?>
      </div>
      <div class="droite flex flex-col w-full lg:w-8/12 ">
        <div>
          <h2 class="titre uppercase font-bold mt-8 lg:mt-0 text-2xl lg:text-3xl">
            <?php 
              echo $movie['title'] . '<br />';
            ?>
          </h2>
          <h4 class="flex flex-col lg:flex-row mt-2">
            Genres : 
            <?php
              foreach($movie['genres'] as $item) {
                echo '<a class="text-gris" href=genre.php?id='.$item['id'].'&page=1&order=desc>'.$item['name'].'</a>';
              }
            ?>
          </h4>
          <div>
            <p class="leading-5 mt-4 titre overview">
              <?php
                echo $movie['overview'];
              ?>
              <!-- <script>
                var string = "<?php echo $movie['overview']; ?>";
                document.write(substr(string, 0, 40));
              </script> -->
            </p>
            <!-- <p class="btn">Read more</p> -->
          </div>

          <div class="lg:flex lg:flex-row grid grid-cols-2 gap-4 my-6 lg:w-7/12 justify-between">
            <?php 
              if (isset($_SESSION['user']['id'])) {
                  echo '<button class="btn bg-fond lg:text-base text-sm px-7 py-2 text-rouge font-bold uppercase rounded-lg hover:bg-black" onclick=watchedOrWatchLater("watched",' . $movie_id . ')>watched</button>';
                  echo '<button class="btn bg-fond lg:text-base text-sm px-7 py-2 text-rouge font-bold uppercase rounded-lg hover:bg-black" onclick=watchedOrWatchLater("watch_later",' . $movie_id . ')>watch later</button>';
                  ?>
                  <div class="relative ">
                    <?php
                      echo '<button class="addTo relative z-50 bg-fond lg:text-base text-sm px-7 py-2 font-bold uppercase rounded-lg hover:bg-black" onclick=addTo(' . $movie_id . ')>add to</button>';
                    ?>
                    <ul class="bg-fond w-max absolute flex flex-col pt-4 p-3 rounded top-0 z-10" id="album_list"></ul>
                  </div>
                <?php
              }
            ?>
          </div>

        </div>
        <div class="mb-12 lg:mb-0">
          <h3 class="titre uppercase font-bold text-2xl">actors</h3>
          <div class="acteur flex snap-x snap-mandatory h-max w-full mx:auto overflow-scroll overflow-y-hidden mt-6 justify-between">
            <div class="mr-8 snap-start shrink-0 flex flex-row text-center">
              <?php
                foreach($cast['cast'] as $item) {
                  echo '<a href=actor.php?id='.$item['id'].'>';
                  ?>
                  
                    <div class=" mr-8">
                      <?php
                      echo '<img src='. $api->getImg($item['profile_path'], 200).'><br />';
                      ?>
                      <p>
                        <?php echo $item['name'] . ' as '. '<br />'; ?>
                      </p>
                      <p class=" text-rouge font-bold">
                        <?php echo $item['character'] . ''; ?>
                      </p>
                    </div>
                  <?php
                  echo '</a>';
                }
              ?>
            </div>
          </div>
        </div>
      </div>
    </div>
  </main>

</body>
<?php
require_once '../utils/footer.php';
?>
<script>
      
</script>
</html>