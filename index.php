<?php
    require_once './utils/header.php';
?>
<body>
<a href="./mids/allGenre.php">Genre</a>
<a href="./pages/trending.php?page=1">Trending</a>
<a href="./pages/topRated.php?page=1">Top Rated</a>
<input id="search_bar" name="input" oninput=instantResearch() />

<?php
    require_once './controllers/connection.php';
    if(isset($_SESSION['id'])){
        echo '<button><a href="./mids/accountNav.php">Account</a></button>';
    }else{
        echo '<button><a href="./connection/login.php">Login</a></button>';
    }
?>
<div id="search_results"></div>
<br><br>

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
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script src="./script.js"></script>
</body>
</html>