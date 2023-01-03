<?php
  require_once '../utils/header.php';
  require_once '../controllers/api.php';
  $person_id = $_GET['id'];
  $api = new API();
  $person = $api->getPerson($person_id);

?>

  <main class="acteur flex flex-col mt-32 h-screen">
    <div class="flex flex-col lg:flex-row w-11/12 mx-auto text-gris h-full justify-between">
      <div class="affiche flex lg:w-5/12 rounded-2xl">
        <?php 
          echo '<img class="w-[55vh] h-[80vh] rounded-2xl" src='.$api->getImg($person['profile_path'], 300).'><br>';
        ?>
      </div>
      <div class="droite flex flex-col w-full lg:w-8/12">
        <div>
          <h2 class=" uppercase font-bold mt-8 lg:mt-0 text-2xl lg:text-3xl">
            <?php 
              echo $person['name'];
            ?>
          </h2>
          <h4 class="flex flex-col lg:flex-row mt-2 text-white font-bold">
            Birth :&ensp;
            <p class="text-gris font-normal">
              <?php
                echo $person['birthday'];
              ?>
            </p>
          </h4>

          <div class="flex flex-row my-6 lg:w-5/12 justify-between">
            <button class="btn bg-fond px-7 py-2 font-bold uppercase rounded-lg hover:bg-black">
              <?php
                echo '<a class="text-rouge" href=./allActorMovie.php?id=' . $person_id . '&page=1>Voir films</a>';
              ?>
            </button>
          </div>

          <div class="leading-5 mt-4 flex flex-col h-64 justify-between">
            <div class="flex flex-col lg:flex-row text-white font-bold">
              Known for :&ensp;
              <p class="text-gris font-normal">
                <?php 
                  echo $person['known_for_department'];
                ?>
              </p>
            </div>
            <div class="flex flex-col text-white font-bold mt-4">
              Biography :&ensp;
              <p class="text-gris font-normal mt-2">
                <?php 
                  echo $person['biography'];
                ?>
              </p>
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
</html>