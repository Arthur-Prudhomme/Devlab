<?php
require_once '../utils/header.php';
require_once '../actions/checkLogin.php';
require_once '../controllers/album.php';
require_once '../controllers/api.php';

$connection = new Connection();
$album = new Album();
$api = new API();

if(!isset($_GET['username'])){
    echo '<h1>Hello ' . $_SESSION['user']['username'] . '</h1>';
    $invitations = $album->getAllPendingInvitationFromUserId($_SESSION['user']['id']);
    if(!empty($invitations)){
        foreach ($invitations as $invitation){
            echo '<div id="i' . $invitation['id'] . '">';
            echo $connection->getUserById($invitation['owner'])[1]
                . ' as invited you on ' .
                $album->getAlbumInfosById($invitation['album_id'])[2]
                . ' ' .
                '<button onclick=answerInvitation('.$invitation['id'].',1)>Accept</button>'
                . ' ' .
                '<button onclick=answerInvitation('.$invitation['id'].',0)>Deny</button>';
            echo '</div>';
        }
    }

    echo '<h2>Search User</h2>';
    echo '<input id="user_search_bar" name="input" oninput=instantResearch("../sources/dynamicUserSearch.php",1,0,0) />';
    echo '<ul id="user_search_results"></ul>';

    $userAllAlbum = $album->getAllAlbumFromUserId($_SESSION['user']['id'],1,0);
    $imgs = [];
    for($i = 0; $i < 3; $i++){
        $albumGroup = $album->getFirstMovieIdOfAllAlbums();
        if(!empty($userAllAlbum)) {
            if ($i < count($userAllAlbum)) {
                $key = array_search($userAllAlbum[$i]['id'], array_column($albumGroup, 'album_id'));
                $path = $api->getMovie($albumGroup[$key]['movie_id'])['poster_path'];
                $img = $api->getImg($path, 200);
            } else {
                $key = array_search($userAllAlbum[0]['id'], array_column($albumGroup, 'album_id'));
                $path = $api->getMovie($albumGroup[$key]['movie_id'])['poster_path'];
                $img = $api->getImg($path, 200);
            }
        }else{
            $img = 'https://redellantasonline.com/assets/img-temp/200x300/img1.png';
        }
        array_push($imgs,$img);
    }
    echo '<a href="albums.php">';
    echo '<h2>Your Albums</h2>';
    echo '<img src='.$imgs[0].'>';
    echo '<img src='.$imgs[1].'>';
    echo '<img src='.$imgs[2].'>';
    echo '</a>';

    $userAllAlbum = $album->getAllLikedAlbumsFromUser($_SESSION['user']['id']);
    $imgs = [];
    for($i = 0; $i < 3; $i++){
        $albumGroup = $album->getFirstMovieIdOfAllAlbums();
        if(!empty($userAllAlbum)) {
            if ($i < count($userAllAlbum)) {
                $key = array_search($userAllAlbum[$i]['album_id'], array_column($albumGroup, 'album_id'));
                $path = $api->getMovie($albumGroup[$key]['movie_id'])['poster_path'];
                $img = $api->getImg($path, 200);
            } else {
                $key = array_search($userAllAlbum[0]['album_id'], array_column($albumGroup, 'album_id'));
                $path = $api->getMovie($albumGroup[$key]['movie_id'])['poster_path'];
                $img = $api->getImg($path, 200);
            }
        }else{
            $img = 'https://redellantasonline.com/assets/img-temp/200x300/img1.png';
        }
        array_push($imgs,$img);
    }
    echo '<a href="likedAlbum.php">';
    echo '<h2>Liked Albums</h2>';
    echo '<img src='.$imgs[0].'>';
    echo '<img src='.$imgs[1].'>';
    echo '<img src='.$imgs[2].'>';
    echo '</a>';

    $userAllAlbum = $album->getAllSharedAlbumsFromUser($_SESSION['user']['id']);
    $imgs = [];
    for($i = 0; $i < 3; $i++){
        $albumGroup = $album->getFirstMovieIdOfAllAlbums();
        if(!empty($userAllAlbum)) {
            if ($i < count($userAllAlbum)) {
                $key = array_search($userAllAlbum[$i]['id'], array_column($albumGroup, 'album_id'));
                $path = $api->getMovie($albumGroup[$key]['movie_id'])['poster_path'];
                $img = $api->getImg($path, 200);
            } else {
                $key = array_search($userAllAlbum[0]['id'], array_column($albumGroup, 'album_id'));
                $path = $api->getMovie($albumGroup[$key]['movie_id'])['poster_path'];
                $img = $api->getImg($path, 200);
            }
        }else{
            $img = 'https://redellantasonline.com/assets/img-temp/200x300/img1.png';
        }
        array_push($imgs,$img);
    }
    echo '<a href="sharedAlbum.php">';
    echo '<h2>Shared With You</h2>';
    echo '<img src='.$imgs[0].'>';
    echo '<img src='.$imgs[1].'>';
    echo '<img src='.$imgs[2].'>';
    echo '</a>';

}else{
    if($connection->getUserByUsername($_GET['username'],0,'') == null){
        echo '<h1>No user found with the name "'.$_GET['username'].'"</h1>';
    }else{
        echo '<h1>'.$_GET['username'].'\'s Profil</h1>';

        $userAllAlbum = $album->getAllAlbumFromUserId($_SESSION['user']['id'],0,0);
        $imgs = [];
        for($i = 0; $i < 3; $i++){
            $albumGroup = $album->getFirstMovieIdOfAllAlbums();
            if(!empty($userAllAlbum)) {
                if ($i < count($userAllAlbum)) {
                    $key = array_search($userAllAlbum[$i]['id'], array_column($albumGroup, 'album_id'));
                    $path = $api->getMovie($albumGroup[$key]['movie_id'])['poster_path'];
                    $img = $api->getImg($path, 200);
                } else {
                    $key = array_search($userAllAlbum[0]['id'], array_column($albumGroup, 'album_id'));
                    $path = $api->getMovie($albumGroup[$key]['movie_id'])['poster_path'];
                    $img = $api->getImg($path, 200);
                }
            }else{
                $img = 'https://redellantasonline.com/assets/img-temp/200x300/img1.png';
            }
            array_push($imgs,$img);
        }
        echo '<a href="albums.php?username='.$_GET['username'].'">';
        echo '<h2>'.$_GET['username'].'\'s Albums</h2>';
        echo '<img src='.$imgs[0].'>';
        echo '<img src='.$imgs[1].'>';
        echo '<img src='.$imgs[2].'>';
        echo '</a>';

        $userAllAlbum = $album->getAllLikedAlbumsFromUser($_SESSION['user']['id']);
        $imgs = [];
        for($i = 0; $i < 3; $i++){
            $albumGroup = $album->getFirstMovieIdOfAllAlbums();
            if(!empty($userAllAlbum)) {
                if ($i < count($userAllAlbum)) {
                    $key = array_search($userAllAlbum[$i]['album_id'], array_column($albumGroup, 'album_id'));
                    $path = $api->getMovie($albumGroup[$key]['movie_id'])['poster_path'];
                    $img = $api->getImg($path, 200);
                } else {
                    $key = array_search($userAllAlbum[0]['album_id'], array_column($albumGroup, 'album_id'));
                    $path = $api->getMovie($albumGroup[$key]['movie_id'])['poster_path'];
                    $img = $api->getImg($path, 200);
                }
            }else{
                $img = 'https://redellantasonline.com/assets/img-temp/200x300/img1.png';
            }
            array_push($imgs,$img);
        }
        echo '<a href="likedAlbum.php?username='.$_GET['username'].'">';
        echo '<h2>'.$_GET['username'].'\'s Liked Albums</h2>';
        echo '<img src='.$imgs[0].'>';
        echo '<img src='.$imgs[1].'>';
        echo '<img src='.$imgs[2].'>';
        echo '</a>';
    }
}

?>
</body>
<?php
require_once '../utils/footer.php';
?>
</html>