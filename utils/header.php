<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="icon" type="image/png" href="../build/img/logo_v2_fond.svg" />
</head>
<body>
  
<header class="z-20 flex fixed top-0 w-screen flex-row bg-fond text-gris h-20">
    <div class="w-11/12 flex flex-row justify-between mx-auto">
        <div class="w-1/2 flex items-center">
          <a href="home.php">
            <img width="90" height="90" src="../build/img/logo_v2.svg" alt="">
          </a>
        </div>
        <div class="w-1/2 flex flex-row justify-between items-center text-gris">
            <a href="home.php" class="  text-gris cursor-pointer">Home</a>
            <a href="AllGenre.php" class="  text-gris cursor-pointer">Genre</a>
            <a href="topRated.php?page=1" class="  text-gris cursor-pointer">Top Rated </a>
            <a href="trending.php?page=1" class="  text-gris cursor-pointer">Trending</a>
            <a class=" text-gris appear cursor-pointer">Login</a>
            <form method="post">
                <input class="bg-transparent text-gris border border-gris p-1 px-2 rounded" type="text" name="search" placeholder="Enter Keywords...">
                <input class="ml-2 cursor-pointer rounded py-1 px-2" type="submit" value="Search">
            </form>
        </div>
    </div>
</header>
