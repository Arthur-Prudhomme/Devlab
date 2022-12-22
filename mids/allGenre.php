<?php
    require_once '../utils/header.php';
?>
<body>
    <?php
    require_once '../controllers/api.php';
    $api = new API();

    $allGenre = $api->getAllGenre();
    foreach ($allGenre['genres'] as $item) {
        echo '<a href=../pages/genre.php?id='.$item['id'].'&page=1>'.$item['name'].'<br /></a>';
    }
?>
</body>
</html>