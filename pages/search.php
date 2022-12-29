<?php
require_once '../utils/header.php';
?>
<body>
<?php
require_once '../controllers/api.php';
?>
<form method="post">
    <input type="text" name="search" placeholder="enter keyword">
    <input type="submit" value="Search">
</form>

<?php
$keyword = $_GET['keyword'];
$page = $_GET['page'];
$api = new API();

$search = $api->getMovieBySearch($keyword, $page);
foreach ($search['results'] as $item) {
    $movie = $api->getMovie($item['id']);
    echo '<div>';
    echo $movie['title'] . '<br />';
    echo '<a href=movie.php?id=' . $movie['id'] . '><img src=' . $api->getImg($movie['poster_path'], 200) . '></a>';
    echo '</div>';
}
?>

<form method="post">
    <input type="number" name="page" placeholder="enter page" min="1" max="<?php echo $search['total_pages'] ?>"
           value="<?php echo $page ?>">
    <input type="submit" value="Jump to">
</form>

<?php
if (isset($_POST['search'])) {
    header("Location: search.php?keyword=" . $_POST['search'] . "&page=1");
}
if (isset($_POST['page'])) {
    header("Location: search.php?keyword=" . $keyword . "&page=" . $_POST['page']);
}
?>
</body>
<?php
require_once '../utils/footer.php';
?>
</html>