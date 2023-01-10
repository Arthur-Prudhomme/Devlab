<?php
require_once '../utils/header.php';
require_once '../controllers/api.php';

if (!empty($_POST)) {
    header("Location: ../pages/search.php?keyword=" . $_POST['search'] . "&page=1");
}
$api = new API();
$trending = $api->getTrending(1);

?>


<main class="flex flex-col mt-24 lg:mt-32 mb-24 px-5 lg:px-0 w-full">
    <div class="flex mx-auto flex-col w-11/12">

      <div class="rounded-2xl flex">

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

        <?php

					$slider = [];
					for($i = 0; $i < 3; $i++){
							$img = $api->getPoster($trending['results'][$i]['backdrop_path']);
							array_push($slider,$img);
					}
					echo '<img src='.$slider[0].'>';
					echo '<img src='.$slider[1].'>';
					echo '<img src='.$slider[2].'>';

        ?>

        <script>
            document.addEventListener('alpine:init', () => {
                Alpine.data('slider', () => ({
                    currentIndex: 1,
                    images: [
											<?php 
												echo '<img src='.$slider[0].'>';
												echo '<img src='.$slider[1].'>';
												echo '<img src='.$slider[2].'>';
											?>
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

      <div class="grid lg:grid-cols-5 gap-4 grid-cols-2 mt-8">

        <?php
          foreach($trending['results'] as $item) {
            echo '<div class="flex flex-col items-center ">';
              echo '<div class="flex flex-col items-center text-center relative w-full ">';
                echo '<a class="absolute w-[31vh] h-[47vh] z-10 bottom-0" href="movie.php?id=' . $item['id'] . '"></a>';
                echo '<p class="absolute text-white font-bold text-base z-10 w-11/12 bottom-5">'.$item["title"].'</p>';
                echo '<a class="mt-4 w-[31vh] h-[47vh] ouaip" href="movie.php?id='.$item['id'].'"><img class="rounded-lg lg:w-[31vh] lg:h-[47vh] " src='.$api->getImg($item['poster_path'], 300).'></a>';
                echo '<div class="w-[31vh] h-[47vh] absolute gradient"></div>';
              echo '</div>';
          echo '</div>';
          }
        ?>

      </div>

    </div>

  </main>


</body>
<?php
require_once '../utils/footer.php';
?>
</html>