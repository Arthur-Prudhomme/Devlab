<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Devlab</title>
  <link rel="icon" type="image/png" href="../build/img/logo_v2_fond.svg" />
    <script src="../build/js/script.js"></script>
</head>
<body>
  
<header class="z-50 flex fixed top-0 w-screen flex-row bg-fond text-gris h-14 lg:h-20">
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
              <a class="btnForm text-gris appear cursor-pointer">Login</a>

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
              <span  class="rounded-sm block absolute  h-0.5 w-5 text-gris bg-current transform transition duration-500 ease-in-out" :class="{'opacity-0': open } "></span>
              <span  class=" rounded-sm block absolute  h-0.5 w-7 text-gris bg-current transform  transition duration-500 ease-in-out" :class="{'-rotate-45': open, ' translate-y-1.5': !open}"></span>
            </div>
          </button>
          
        </div>
    </div>
</header>

<div class="form hidden fixed w-screen h-screen bg-black bg-opacity-50 top-0 z-50">
  <div class="login absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 flex flex-col bg-form text-rouge w-1/3 mx-auto rounded-lg py-4 justify-between ">
      <svg class="close absolute top-4 right-4 cursor-pointer z-10" width="20" height="20" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
          <path d="M8 0.25C3.71875 0.25 0.25 3.71875 0.25 8C0.25 12.2812 3.71875 15.75 8 15.75C12.2812 15.75 15.75 12.2812 15.75 8C15.75 3.71875 12.2812 0.25 8 0.25ZM8 14.25C4.53125 14.25 1.75 11.4688 1.75 8C1.75 4.5625 4.53125 1.75 8 1.75C11.4375 1.75 14.25 4.5625 14.25 8C14.25 11.4688 11.4375 14.25 8 14.25ZM11.1562 6.0625C11.3125 5.9375 11.3125 5.6875 11.1562 5.53125L10.4688 4.84375C10.3125 4.6875 10.0625 4.6875 9.9375 4.84375L8 6.78125L6.03125 4.84375C5.90625 4.6875 5.65625 4.6875 5.5 4.84375L4.8125 5.53125C4.65625 5.6875 4.65625 5.9375 4.8125 6.0625L6.75 8L4.8125 9.96875C4.65625 10.0938 4.65625 10.3438 4.8125 10.5L5.5 11.1875C5.65625 11.3438 5.90625 11.3438 6.03125 11.1875L8 9.25L9.9375 11.1875C10.0625 11.3438 10.3125 11.3438 10.4688 11.1875L11.1562 10.5C11.3125 10.3438 11.3125 10.0938 11.1562 9.96875L9.21875 8L11.1562 6.0625Z" fill="#AE0000"/>
      </svg>
      <div class="flex flex-col w-9/12 mx-auto">
          <div class="text-center">
              <h1 class="titre text-3xl font-bold mb-8">Hello again</h1>
          </div>
          <form action="post" class="flex flex-col">
              <label class="uppercase font-bold" for="email">email</label>
              <input class="bg-transparent border border-gris rounded-sm px-2 py-1 my-2" type="email" id="email" placeholder="ex@ex.com">
              <label class="uppercase font-bold pt-4" for="password">passowrd</label>
              <input class="bg-transparent border border-gris rounded-sm px-2 py-1 my-2" id="password" type="password" placeholder="password">
              <input class="text-white bg-rouge my-10 text-2xl uppercase font-bold py-3 rounded-lg" type="submit" value="login">
          </form>
          <button class="change underline text-xl font-bold -mt-3 mb-3">Register</button>
      </div>
      <div></div>
  </div>

  <div class="register hidden absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 flex flex-col bg-form text-rouge w-1/3 mx-auto rounded-lg py-4 justify-between">
      <svg class="close absolute top-4 right-4 cursor-pointer z-10" width="20" height="20" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
          <path d="M8 0.25C3.71875 0.25 0.25 3.71875 0.25 8C0.25 12.2812 3.71875 15.75 8 15.75C12.2812 15.75 15.75 12.2812 15.75 8C15.75 3.71875 12.2812 0.25 8 0.25ZM8 14.25C4.53125 14.25 1.75 11.4688 1.75 8C1.75 4.5625 4.53125 1.75 8 1.75C11.4375 1.75 14.25 4.5625 14.25 8C14.25 11.4688 11.4375 14.25 8 14.25ZM11.1562 6.0625C11.3125 5.9375 11.3125 5.6875 11.1562 5.53125L10.4688 4.84375C10.3125 4.6875 10.0625 4.6875 9.9375 4.84375L8 6.78125L6.03125 4.84375C5.90625 4.6875 5.65625 4.6875 5.5 4.84375L4.8125 5.53125C4.65625 5.6875 4.65625 5.9375 4.8125 6.0625L6.75 8L4.8125 9.96875C4.65625 10.0938 4.65625 10.3438 4.8125 10.5L5.5 11.1875C5.65625 11.3438 5.90625 11.3438 6.03125 11.1875L8 9.25L9.9375 11.1875C10.0625 11.3438 10.3125 11.3438 10.4688 11.1875L11.1562 10.5C11.3125 10.3438 11.3125 10.0938 11.1562 9.96875L9.21875 8L11.1562 6.0625Z" fill="#AE0000"/>
      </svg>
      <div class="flex flex-col w-9/12 mx-auto">
          <div class="text-center">
              <h1 class="titre text-3xl font-bold mb-8">Greetings</h1>
          </div>
          <form action="post" class="flex flex-col">
              <label class="uppercase font-bold" for="email">email</label>
              <input class="bg-transparent border border-gris rounded-sm px-2 py-1 my-2" type="email" placeholder="ex@ex.com">
              <label class="uppercase font-bold pt-4" for="password">passowrd</label>
              <input class="bg-transparent border border-gris rounded-sm px-2 py-1 my-2" type="password" placeholder="password">
              <label class="uppercase font-bold pt-4" for="password">confirm passowrd</label>
              <input class="bg-transparent border border-gris rounded-sm px-2 py-1 my-2" type="password" placeholder="password">
              <input class="text-white bg-rouge my-10 text-2xl uppercase font-bold py-3 rounded-lg" type="submit" value="Register">
          </form>
          <button class="change underline text-xl font-bold -mt-3 mb-3">Login</button>
      </div>
      <div>

      </div>
  </div>
</div>

<script>
  const menuBtn = document.querySelector('.menuBtn');
  const menu = document.querySelector('.menu');

  menuBtn.addEventListener('click', () => {
      menu.classList.toggle('hidden');
  });

  const form = document.querySelector('.form');
  const login = document.querySelector('.login');
  const register = document.querySelector('.register');
  const change = document.querySelector('.change');
  const btnForm = document.querySelector('.btnForm');
  const close = document.querySelectorAll('.close');

  //quand btnform est cliqué form est visible
  btnForm.addEventListener('click', () => {
    // console.log('click');
      form.classList.toggle('hidden');
  });
  
  //quand close est cliqué form est caché
    close.forEach((btn) => {
        btn.addEventListener('click', () => {
            form.classList.add('hidden');
        });
    });
    
    //quand change est cliqué si login et visible alors le cacher et afficher register et vice versa
    change.addEventListener('click', () => {
        if (login.classList.contains('hidden')) {
            login.classList.remove('hidden');
            login.classList.add('flex');
            register.classList.remove('flex');
            register.classList.add('hidden');
        } else {
            login.classList.remove('flex');
            login.classList.add('hidden');
            register.classList.remove('hidden');
            register.classList.add('flex');
        }
    });
    
</script>
