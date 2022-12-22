<?php
    require_once './pages/header.php';
?>
<body>
<a href="./mids/allGenre.php">Genre</a>
<a href="./pages/trending.php?page=1">Trending</a>
<a href="./pages/topRated.php?page=1">Top Rated</a>
<button><a href="./connection/login.php">Login</a></button><br><br>

<form method="post">
    <input type="text" name="search" placeholder="enter keyword">
    <input type="submit" value="Search">
</form><br>

    <?php
        if(!empty($_POST)){
            header("Location: ./pages/search.php?keyword=".$_POST['search']."&page=1");
        }

        require_once './controllers/api.php';
        $api = new API();
        $trending = $api->getTrending(1);

        foreach($trending['results'] as $item) {
            echo '<div>';
            echo $item['title'] . '<br />';
            echo '<a href=./pages/movie.php?id='.$item['id'].'><img src='. $api->getImg($item['poster_path'],200).'></a>';
            echo '</div>';
        }
    ?>
</body>
</html>