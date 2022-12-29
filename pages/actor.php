<?php
require_once '../utils/header.php';
?>
<body>
<?php
require_once '../controllers/api.php';
$person_id = $_GET['id'];
$api = new API();
$person = $api->getPerson($person_id);

echo '<div>';
echo '<h2>' . $person['name'] . '</h2><br>';
echo '<img src=' . $api->getImg($person['profile_path'], 300) . '><br>';
echo 'Birth : ' . $person['birthday'] . '<br><br>';
echo 'Known for : ' . $person['known_for_department'] . '<br><br>';
echo 'Biography : ' . $person['biography'];
echo '</div><br><br>';
echo '<a href=./allActorMovie.php?id=' . $person_id . '&page=1>Voir films</a>';
?>
</body>
<?php
require_once '../utils/footer.php';
?>
</html>