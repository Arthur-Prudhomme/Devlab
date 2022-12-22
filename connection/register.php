<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>register</title>
    <link href="../style.css" rel="stylesheet">
</head>
<body>
    <form method="POST">
        <input type="email" name="email" placeholder="email">
        <input type="password" name="password1" placeholder="password">
        <input type="password" name="password2" placeholder="retype password">
        <input type="submit" value="Register">
    </form>
    <button><a href="./login.php">Already have an account ?</a></button>

    <?php
        require_once '../controllers/user.php';
        require_once '../controllers/connection.php';

        if ($_POST) {
            $user = new User(
                $_POST['email'],
                $_POST['password1'],
                $_POST['password2']
            );

            if ($user->verifyUser()) {
                $connection = new Connection();
                $result = $connection->insertUser($user);

                if ($result) {
                    echo 'Registered with success';
                    header("Location: login.php");
                } else {
                    echo 'Internal error...';
                }

            } else {
                echo 'Form has an error';
            }
        }
    ?>

</body>
</html>