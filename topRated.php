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
<body>
  <div class="bg-bg h-full w-full flex flex-col relative">
    <?php 
      require_once 'utils/header.php';
    ?>

    <?php
    $page = $_GET['page'];

    require_once 'core.php';
    $core = new Core();

    $topRated = $core->getTopRated($page);
    ?>

    <main class="flex flex-col mt-32  w-11/12 mx-auto">

      <h2 class="titre uppercase text-rouge mt-8 font-bold text-2xl">Top Rated</h2>

      <div class="films grid grid-cols-5 gap-4 mx-auto mt-8">

      <?php

        foreach($topRated['results'] as $item) {
          echo '<a href=movie.php?id='.$item['id'].'>';
          echo '<div>';
          echo '<img src='. $core->getImg($item['poster_path'],200).'>';
          echo '<div> </div>';
          echo '<p>'. $item["title"]. '</p>'. '<br />';
          echo '</div>';
          echo '</a>';
      }

      ?>

      </div>

      <form class="mt-8 mb-24" method="post">
          <input class="text-font rounded-md pl-1" type="number" name="page" placeholder="enter page" min="1" max="<?php echo $topRated['total_pages'] ?>" value="<?php echo $page ?>">
          <input class="text-white" type="submit" value="Jump to">
      </form>

      <?php
      if(!empty($_POST)){
          header("Location: topRated.php?page=".$_POST['page']);
      }
      ?>
    </main>
  </div>
  
</body>
</html>