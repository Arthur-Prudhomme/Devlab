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
    <script src="https://cdn.tailwindcss.com/%22%3E"></script>
    
</head>
<body>
  
    <?php
      if(!empty($_POST)){
        header("Location: search.php?keyword=".$_POST['search']."&page=1");
      }
  
      require_once 'core.php';
      $core = new Core();
      $trending = $core->getTrending(1);
  
    ?>

<div class="bg-bg h-full w-full flex flex-col relative">

<?php 
    require_once 'utils/header.php';
?>

  <div class="form hidden fixed parent w-screen h-screen bg-black bg-opacity-50 top-0 z-50">
      <div class="login absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 flex flex-col bg-form text-rouge w-1/3 mx-auto rounded-lg py-4 justify-between ">
          <svg class="disappear absolute top-4 right-4 cursor-pointer z-10" width="20" height="20" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
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
          <svg class="disappear absolute top-4 right-4 cursor-pointer z-10" width="20" height="20" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
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

  <main class="flex flex-col mt-32 ">
      <div class="flex mx-auto flex-col">

      <div>
        <div>
            <img class="rounded-2xl" src="../build/img/dune.jpg" alt="">
        </div>
      </div>
      <!-- <div id="carouselExampleSlidesOnly" class="carousel slide relative " data-bs-ride="carousel">
          <div class="carousel-inner relative w-full overflow-hidden rounded-2xl">
              <div class="carousel-item active relative float-left w-full">
                  <img
                          src="../build/img/hobbit.jpg"
                          class="image block w-full"
                          alt="Affiche"
                  />
              </div>
              <div class="carousel-item relative float-left w-full">
                  <img
                          src="../build/img/dune.jpg"
                          class="image block w-full"
                          alt="Affiche"
                  />
              </div>
              <div class="carousel-item relative float-left w-full">
                  <img
                          src="../build/img/interstellar.jpeg"
                          class="image block w-full"
                          alt="Affiche"
                  />
              </div>
          </div>
      </div> -->

      <h2 class="titre uppercase text-rouge mt-8 font-bold text-2xl">Trending</h2>

        <div class="films grid grid-cols-5 gap-4 mx-auto mt-8">

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

      </div>

  </main>



</div>
<script>

  let login = document.querySelector(".login");
  let register = document.querySelector(".register");
  let appear = document.querySelector(".appear");
  let disappear = document.querySelector(".disappear");


  appear.addEventListener('click',
    function () {
      // console.log(parent);
      parent.classList.add("appear");
      parent.classList.remove("ninja");
    }
  )

  disappear.addEventListener('click',
    function () {
      // console.log(parent);
      parent.classList.add("ninja");
      parent.classList.remove("appear");
    }
  )

</script>
</body>

</html>