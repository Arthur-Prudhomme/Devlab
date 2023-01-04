<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link href="./style.css" rel="stylesheet">
  <link href="../style.css" rel="stylesheet">
  <link href="src/input.css" rel="stylesheet">
  <link href="../src/input.css" rel="stylesheet">
  <link href="./build/css/style.css" rel="stylesheet">
  <link href="../build/css/style.css" rel="stylesheet">
</head>

<?php
  require_once '../controllers/connection.php';
?>

<header class="z-50 flex fixed top-0 w-screen flex-row bg-fond text-gris h-14 lg:h-20">
  <div class="w-11/12 flex flex-row justify-between mx-auto">
    <div class="w-1/2 flex items-center">
      <?php 
        echo 
        '<button>
          <a href="../pages/home.php"><img class=" w-16 lg:w-20" src="../build/img/logo_v2.svg" alt=""></a>
        </button>';
      ?>
      </a>
    </div>
    <div class="menu w-1/2 hidden lg:flex flex-row justify-between items-center text-gris">
      <ul class="flex flex-col lg:flex-row justify-between lg:items-center lg:w-full w-2/3 bg-fond absolute lg:relative top-0 right-0 p-8 lg:p-0 lg:h-auto h-80 items-start"> 
        <?php 
          echo '<button><a class="text-gris cursor-pointer" href="../pages/home.php">Home</a></button>';
          ?> 
          <div>
            <?php
              echo '<button class="text-gris cursor-pointer" onclick=allAlbum()>Genre</button>';
            ?>
            <ul class="bg-fond absolute flex flex-col z-50 pt-4 p-3 rounded w-4/12 justify-between" id="genre_list"></ul>
          </div>
          <?php
          echo '<button><a class="text-gris cursor-pointer" href="../pages/trending.php?page=1">Trending</a></button>';
          echo '<button><a class="text-gris cursor-pointer" href="../pages/topRated.php?page=1">Top Rated</a></button>';
        ?>
          <form class="lg:flex flex-row relative" method="post">
            <div class="relative">
              <input class="bg-transparent text-gris border border-gris p-1 px-2 rounded" placeholder="Enter Keywords..." id="search_bar" name="input" oninput=instantResearch('../sources/dynamicSearch.php') />
              <ul class="bg-fond absolute flex flex-col pt-4 p-3 rounded top-0 mt-12" id="search_results"></ul>
            </div>
          </form>

        <?php
          if (isset($_SESSION['user'])) {
            ?>
            <div class="relative">
              <?php
                echo '<button class=" text-white z-40 appear px-4 py-1 rounded bg-rouge cursor-pointer" onclick=accountNav()>Account</button>';
              ?>
              <ul class="bg-fond absolute flex flex-col z-50 pt-4 p-3 rounded w-full" id="account_nav"></ul>
            </div>
            <?php
          } else {
              echo '<button class=" text-white z-40 appear px-4 py-1 rounded bg-rouge cursor-pointer"><a href="../connection/login.php">Login</a></button>';
          }
        ?>

        </ul>
    </div>
    <div x-data="{ open: false }" class="inline-flex md:hidden">
      <button @click="open = !open" class="menuBtn flex-none px-2 z-50">
        
        <div class="block w-5 transform -translate-x-1/2 -translate-y-1/2 ">
          <span  class="rounded-sm block absolute h-0.5 w-7 text-gris bg-current transform transition duration-500 ease-in-out" :class="{'rotate-45': open,' -translate-y-1.5': !open }"></span>
          <span  class="rounded-sm block absolute  h-0.5 w-5 text-gris bg-current transform transition duration-500 ease-in-out" :class="{'opacity-0': open } "></span>
          <span  class=" rounded-sm block absolute  h-0.5 w-7 text-gris bg-current transform  transition duration-500 ease-in-out" :class="{'-rotate-45': open, ' translate-y-1.5': !open}"></span>
        </div>
      </button>
      
    </div>
  </div>


</header>

<body class="bg-bg h-full w-full flex flex-col relative text-white">
