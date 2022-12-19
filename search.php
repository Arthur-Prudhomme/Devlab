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
        $keyword = $_GET['keyword'];
        $page = $_GET['page'];

        require_once 'core.php';
        $core = new Core();

        $search = $core->getMovieBySearch($keyword,$page);
    ?>

    <form method="post">
        <input type="number" name="page" placeholder="enter page" min="1" max="<?php echo $search['total_pages'] ?>" value="<?php echo $page ?>">
        <input type="submit" value="Jump to">
    </form>

    <?php
        if(isset($_POST['search'])){
            header("Location: search.php?keyword=".$_POST['search']."&page=1");
        }
        if(isset($_POST['page'])){
            header("Location: search.php?keyword=".$keyword."&page=".$_POST['page']);
        }
    ?>

    <main class="flex flex-col mt-20 lg:mt-32  w-11/12 mx-auto">

      <h2 class="titre uppercase text-rouge mt-8 font-bold text-2xl">Results for : '
        <?php 
            
          ?>'
      </h2>

      <div class="films grid grid-cols-2 lg:grid-cols-5 gap-4 mx-auto mt-8">

        <?php

            foreach($search['results'] as $item) {
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

      <form class="mt-8 mb-24 w-1/2" method="post">
          <input class="text-font rounded-md pl-1  w-1/12" type="number" name="page" placeholder="enter page" min="1" max="<?php echo $trending['total_pages'] ?>" value="<?php echo $page ?>">
          <input class="text-white hover:opacity-60 cursor-pointer" type="submit" value="Jump to">
      </form>

    </main>

    </div>
</body>
</html>