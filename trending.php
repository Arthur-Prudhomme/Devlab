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

    $trending = $core->getTrending($page);
    ?>
    <?php
    if(!empty($_POST)){
        header("Location: trending.php?page=".$_POST['page']);
    }
    ?>

    <main class="flex flex-col mt-32  w-11/12 mx-auto">
    <div class="flex flex-row w-full items-center mx-auto">
      <h2 class="titre uppercase text-rouge font-bold text-2xl w-11/12 mx-auto">trending</h2>
      <div class="w-full flex flex-col items-end">
        <button class="uppercase filter bg-rouge txt-fond rounded-md px-4 py-1 font-extrabold w-max focus:rounded-br-none relative">filter

        <div class="hidden absolute top-8 right-0 bg-rouge text-fond capitalize flex flex-col w-[500px] rounded-lg rounded-tr-none py-2 justify-between z-20 font-normal">
          <div class="mt-2 flex flex-row items-center w-11/12 mx-auto ">
            <h3 class="uppercase font-bold mr-2">movies</h3>
            <input class="w-4 h-4 mr-2 ml-1" type="radio">All
            <input class="w-4 h-4 mr-2 ml-1" type="radio">Only watched
            <input class="w-4 h-4 mr-2 ml-1" type="radio">Only unwatched
          </div>
          <div class="mt-4 flex flex-row items-center w-11/12 mx-auto">
            <h3 class="uppercase font-bold mr-2">age</h3>
            <input class="w-4 h-4 mr-2 ml-1" type="radio">All
            <input class="w-4 h-4 mr-2 ml-1" type="radio">-18
            <input class="w-4 h-4 mr-2 ml-1" type="radio">-16
            <input class="w-4 h-4 mr-2 ml-1" type="radio">-12
          </div>
          <div class="mt-4 flex flex-row items-center w-11/12 mx-auto">
            <h3 class="uppercase font-bold mr-2">order</h3>
            <input class="w-4 h-4 mr-2 ml-1" type="radio">Ascending
            <input class="w-4 h-4 mr-2 ml-1" type="radio">Descending
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
        echo '<img src='. $core->getImg($item['poster_path'],200).'>';
        echo '<div> </div>';
        echo '<p>'. $item["title"]. '</p>'. '<br />';
        echo '</div>';
        echo '</a>';
      }

    ?>
    </div>

    <form class="mt-8 mb-24" method="post">
        <input class="text-font rounded-md pl-1" type="number" name="page" placeholder="enter page" min="1" max="<?php echo $trending['total_pages'] ?>" value="<?php echo $page ?>">
        <input class="text-white hover:opacity-60 cursor-pointer" type="submit" value="Jump to">
    </form>
    </main>
  </div>

</body>
</html>