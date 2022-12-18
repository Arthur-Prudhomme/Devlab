
<header class="z-20 flex fixed top-0 w-screen flex-row bg-fond text-gris h-20">
    <div class="w-11/12 flex flex-row justify-between mx-auto">
        <div class="w-1/2 flex items-center">
          <a href="home.php">
            <svg width="63" height="45" viewBox="0 0 63 45" fill="none" xmlns="http://www.w3.org/2000/svg">
                <rect width="63" height="45" rx="5" fill="#AE0000"/>
                <path d="M12.7614 34V10.7273H18.3864V29.4318H28.0682V34H12.7614ZM36.3267 34H30.2812L38.1335 10.7273H45.6222L53.4744 34H47.429L41.9631 16.5909H41.7812L36.3267 34ZM35.5199 24.8409H48.1562V29.1136H35.5199V24.8409Z" fill="#0D1013"/>
            </svg>
          </a>
        </div>
        <div class="w-1/2 flex flex-row justify-between items-center text-gris">
            <a href="home.php" class="  text-gris cursor-pointer">Home</a>
            <a href="AllGenre.php" class="  text-gris cursor-pointer">Genre</a>
            <a href="topRated.php?page=1" class="  text-gris cursor-pointer">Top Rated </a>
            <a href="trending.php?page=1" class="  text-gris cursor-pointer">Trending</a>
            <a class=" text-gris appear cursor-pointer">Login</a>
            <form method="post">
                <input class="bg-transparent text-gris border border-gris p-1 px-2 rounded-sm" type="text" name="search" placeholder="Enter Keywords...">
                <input type="submit" value="Search">
            </form>
        </div>
    </div>
</header>
