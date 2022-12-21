<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="./style.css" rel="stylesheet">
</head>
<body>
    <?php
    $person_id = $_GET['id'];
    require_once 'core.php';
    $core = new Core();
    $person = $core->getPerson($person_id);

    echo '<div>';
    echo '<h2>'.$person['name'].'</h2><br>';
    echo '<img src='.$core->getImg($person['profile_path'],300).'><br>';
    echo 'Birth : '.$person['birthday'].'<br><br>';
    echo 'Known for : '.$person['known_for_department'].'<br><br>';
    echo 'Biography : '.$person['biography'];
    echo '</div><br><br>';
    echo '<a href=allActorMovie.php?id='.$person_id.'&page=1>Voir films</a>';
?>
</body>
</html>