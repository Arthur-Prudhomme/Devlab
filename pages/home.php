<?php
require_once '../utils/header.php';
require_once '../controllers/api.php';

if (!empty($_POST)) {
    header("Location: ../pages/search.php?keyword=" . $_POST['search'] . "&page=1");
}
$api = new API();
$trending = $api->getTrending(1);

$slider = [];
for($i = 0; $i < 3; $i++){
    $img = $api->getPoster($trending['results'][$i]['backdrop_path']);
    array_push($slider,$img);
}
echo '<img src='.$slider[0].'>';
echo '<img src='.$slider[1].'>';
echo '<img src='.$slider[2].'>';

foreach ($trending['results'] as $item) {
    echo '<div>';
    echo $item['title'] . '<br />';
    echo '<a href=../pages/movie.php?id=' . $item['id'] . '><img src=' . $api->getImg($item['poster_path'], 200) . '></a>';
    echo '</div>';
}
?>
</body>
<?php
require_once '../utils/footer.php';
?>
</html>