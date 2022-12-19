<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="icon" type="image/png" src="build/img/logo_v2.png"/>
    
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

  <main class="flex flex-col mt-24 lg:mt-32 mb-24 px-5 lg:px-0">
      <div class="flex mx-auto flex-col">

      <div class="rounded-2xl flex">

        <!-- composant -->
        <script defer src="https://unpkg.com/alpinejs@3.2.3/dist/cdn.min.js"></script>

        <article x-data="slider" class="relative w-full flex flex-shrink-0 overflow-hidden shadow-2xl ">
            <template x-for="(image, index) in images">
                <figure class="h-[550px]" x-show="currentIndex == index + 1">
                <img :src="image" alt="Image" class="rounded-2xl absolute inset-0 z-10 h-full w-full object-cover opacity-70"/>
                </figure>
            </template>

            <button @click="back()"
                class="absolute left-4 mt-10 top-1/2 -translate-y-1/2 w-11 h-11 flex justify-center items-center rounded-full shadow-md z-10 bg-gray-100 hover:bg-gray-200 opacity-50">
                <svg class=" w-8 h-8 font-bold transition duration-500 ease-in-out transform motion-reduce:transform-none text-gray-500 hover:text-gray-600 hover:-translate-x-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7">
                    </path>
                </svg>
            </button>

            <button @click="next()"
            class="absolute right-4 top-1/2 translate-y-1/2 w-11 h-11 flex justify-center items-center rounded-full shadow-md z-10 bg-gray-100 hover:bg-gray-200  opacity-50">
                <svg class=" w-8 h-8 font-bold transition duration-500 ease-in-out transform motion-reduce:transform-none text-gray-500 hover:text-gray-600 hover:translate-x-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"></path>
                </svg>
            </button>
        </article>

        <script>
            document.addEventListener('alpine:init', () => {
                Alpine.data('slider', () => ({
                    currentIndex: 1,
                    images: [
                        'https://static1.colliderimages.com/wordpress/wp-content/uploads/2021/09/hobbit-lotr-movies-in-order.jpg',
                        'http://img.over-blog-kiwi.com/0/83/97/57/ob_3a7b42_the-hobbit-2.jpg'
                    ],
                    back() {
                        if (this.currentIndex > 1) {
                            this.currentIndex = this.currentIndex - 1;
                        }
                    },
                    next() {
                        if (this.currentIndex < this.images.length) {
                            this.currentIndex = this.currentIndex + 1;
                        } else if (this.currentIndex <= this.images.length){
                            this.currentIndex = this.images.length - this.currentIndex + 1
                        }
                    },
                }))
            })
        </script>

        </div>


      <h2 class="titre uppercase text-rouge mt-8 font-bold text-2xl">Trending</h2>

        <div class="films grid grid-cols-2 lg:grid-cols-5 gap-4 mx-auto mt-8 w-11/12 ">

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
</body>

</html>