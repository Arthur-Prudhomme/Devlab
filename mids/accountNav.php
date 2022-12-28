<?php
require_once '../utils/header.php';
require_once '../controllers/connection.php';
?>
<body>
<button><a href="../pages/album.php">Albums</a></button>
<form method="GET">
    <input type="submit" name="logout" placeholder="Logout" value="logout">
</form>

<?php
    require_once '../actions/logout.php';
?>

</body>
<?php
require_once '../utils/footer.php';
?>
</html>