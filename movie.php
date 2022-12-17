<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="./style.css" rel="stylesheet">
    <link href="src/input.css" rel="stylesheet">
    <link href="./build/css/style.css" rel="stylesheet">
</head>
<body class="movie">

  <div class="bg-bg h-full w-full flex flex-col relative">
    <?php 
      require_once 'utils/header.php';
    ?>

    <?php
      $movie_id = $_GET['id'];
      require_once 'core.php';
      $core = new Core();
      $movie = $core->getMovie($movie_id);
      $cast = $core->getCast($movie_id);

    ?>

    <main class="flex flex-col mt-32 ">
    <div class="flex flex-row w-11/12 mx-auto text-gris">
      <div class="affiche flex w-5/12 rounded-2xl">
        <?php 
          echo '<img src='.$core->getImg($movie['poster_path'],300).'><br />';
        ?>
          
      </div>
      <div class=" droite flex flex-col w-8/12">
        <div>
          <h2 class="titre uppercase font-bold text-3xl">
            <?php 
              echo $movie['title'] . '<br />';
            ?>
          </h2>
          <h4 class="flex flex-row mt-2">
            Genres : 
            <?php
              echo '<div>';
              foreach($movie['genres'] as $item) {
                echo '<a href=genre.php?id='.$item['id'].'&page=1>'.$item['name'].'</a>';
              }
              echo '</div>';
            ?>
          </h4>
          <p class="leading-5 mt-4 titre">
            <?php
              echo $movie['overview'];
            ?>
          </p>

          <div class="flex flex-row my-6 w-5/12 justify-between">
            <button class="btn off bg-fond px-7 py-2 text-rouge font-bold uppercase rounded-lg">watched</button>
            <button class="appear bg-fond px-7 py-2 font-bold uppercase rounded-lg">add to album</button>
          </div>

          <div class="hidden album absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 flex flex-col bg-form text-rouge w-2/12 mx-auto py-2 justify-between h-64">
            <svg class="close absolute top-4 right-4 cursor-pointer z-10" width="20" height="20" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M8 0.25C3.71875 0.25 0.25 3.71875 0.25 8C0.25 12.2812 3.71875 15.75 8 15.75C12.2812 15.75 15.75 12.2812 15.75 8C15.75 3.71875 12.2812 0.25 8 0.25ZM8 14.25C4.53125 14.25 1.75 11.4688 1.75 8C1.75 4.5625 4.53125 1.75 8 1.75C11.4375 1.75 14.25 4.5625 14.25 8C14.25 11.4688 11.4375 14.25 8 14.25ZM11.1562 6.0625C11.3125 5.9375 11.3125 5.6875 11.1562 5.53125L10.4688 4.84375C10.3125 4.6875 10.0625 4.6875 9.9375 4.84375L8 6.78125L6.03125 4.84375C5.90625 4.6875 5.65625 4.6875 5.5 4.84375L4.8125 5.53125C4.65625 5.6875 4.65625 5.9375 4.8125 6.0625L6.75 8L4.8125 9.96875C4.65625 10.0938 4.65625 10.3438 4.8125 10.5L5.5 11.1875C5.65625 11.3438 5.90625 11.3438 6.03125 11.1875L8 9.25L9.9375 11.1875C10.0625 11.3438 10.3125 11.3438 10.4688 11.1875L11.1562 10.5C11.3125 10.3438 11.3125 10.0938 11.1562 9.96875L9.21875 8L11.1562 6.0625Z" fill="#AE0000"/>
            </svg>

            <div class="flex flex-col w-full mx-auto">
              <div class="text-center">
                <h1 class="titre text-2xl font-bold mb-4 uppercase">albums</h1>
                <p class="text-left text-gris border-t-gris border-t border-opacity-50 pl-4 px-1">Watched</p>
                <p class="text-left text-gris border-t-gris border-t border-opacity-50 pl-4 px-1">Watched</p>
                <p class="text-left text-gris border-t-gris border-t border-opacity-50 pl-4 px-1">Watched</p>
              </div>
            </div>
        </div>
  
        </div>
        <div>
          <h3 class="titre uppercase font-bold text-2xl">actors</h3>
          <div class="acteur flex snap-x snap-mandatory h-max w-full mx:auto overflow-scroll overflow-y-hidden mt-6 justify-between">
            <div class="mr-8 snap-start shrink-0 flex flex-row text-center">
              <?php
                foreach($cast['cast'] as $item) {
                  ?>
                    <div class=" mr-8">
                      <?php
                      echo '<img src='.$core->getImg($item['profile_path'],200).'><br />';
                      ?>
                      <p>
                        <?php echo $item['name'] . ' as '. '<br />'; ?>
                      </p>
                      <p class=" text-rouge font-bold">
                        <?php echo $item['character'] . ''; ?>
                      </p>
                    </div>
                  <?php
                }
              ?>
            </div>
          </div>
        </div>
      </div>
    </div>
   </main>

  </div>

</body>
</html>