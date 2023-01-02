<?php
require_once '../utils/header.php';
?>
<body>
<?php
require_once '../actions/checkLogin.php';
require_once '../controllers/connection.php';
?>
<button><a href="../pages/profil.php">Profil</a></button>
<form method="GET">
    <input type="submit" name="logout" placeholder="Logout" value="logout">
</form>

</body>
<?php
require_once '../utils/footer.php';
?>
</html>