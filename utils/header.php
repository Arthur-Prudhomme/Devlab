<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Devlab</title>
  <link rel="icon" type="image/png" href="../build/img/logo_v2_fond.svg" />
</head>
<body>
  
<header class="z-20 flex fixed top-0 w-screen flex-row bg-fond text-gris h-14 lg:h-20">
    <div class="w-11/12 flex flex-row justify-between mx-auto">
        <div class="w-1/2 flex items-center">
          <a href="home.php">
            <img class=" w-16 lg:w-20" src="../build/img/logo_v2.svg" alt="">
          </a>
        </div>
        <div class="menu w-1/2 hidden lg:flex flex-row justify-between items-center text-gris">
          <ul class="flex flex-col lg:flex-row justify-between lg:items-center lg:w-full w-2/3 bg-fond absolute lg:relative top-0 right-0 p-8 lg:p-0 lg:h-auto h-80"> 
              <a href="home.php" class="text-gris cursor-pointer">Home</a>
              <a href="AllGenre.php" class="text-gris cursor-pointer">Genre</a>
              <a href="topRated.php?page=1" class="text-gris cursor-pointer">Top Rated </a>
              <a href="trending.php?page=1" class="text-gris cursor-pointer">Trending</a>
              <a class=" text-gris appear cursor-pointer">Login</a>

              <form class="lg:flex flex-row" method="post">
                  <input class="bg-transparent text-gris border border-gris p-1 px-2 rounded" type="text" name="search" placeholder="Enter Keywords...">
                  <input class="lg:ml-2 cursor-pointer rounded py-1 px-2" type="submit" value="Search">
              </form>
            </ul>
        </div>
        <div x-data="{ open: false }" class="inline-flex md:hidden">
          <button @click="open = !open" class="menuBtn flex-none px-2 z-50">
            
            <div class="block w-5 transform -translate-x-1/2 -translate-y-1/2 ">
              <span  class="rounded-sm block absolute h-0.5 w-7 text-gris bg-current transform transition duration-500 ease-in-out" :class="{'rotate-45': open,' -translate-y-1.5': !open }"></span>
              <span  class="rounded-sm block absolute  h-0.5 w-5 text-gris bg-current   transform transition duration-500 ease-in-out" :class="{'opacity-0': open } "></span>
              <span  class=" rounded-sm block absolute  h-0.5 w-7 text-gris bg-current transform  transition duration-500 ease-in-out" :class="{'-rotate-45': open, ' translate-y-1.5': !open}"></span>
            </div>
          </button>
          
        </div>
    </div>
</header>

<script>
    const menuBtn = document.querySelector('.menuBtn');
    const menu = document.querySelector('.menu');
    menuBtn.addEventListener('click', () => {
        menu.classList.toggle('hidden');
    });
</script>
