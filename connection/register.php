<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link href="./style.css" rel="stylesheet">
    <link href="../style.css" rel="stylesheet">
    <link href="src/input.css" rel="stylesheet">
    <link href="./build/css/style.css" rel="stylesheet">
    <link href="../build/css/style.css" rel="stylesheet">
</head>
<body>
<?php
require_once '../controllers/user.php';
require_once '../controllers/connection.php';

if ($_POST) {
    $user = new User(
        $_POST['email'],
        $_POST['username'],
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

<div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 flex flex-col bg-form text-rouge lg:w-1/3 w-11/12 mx-auto rounded-lg py-4 justify-between ">
    <div class="flex flex-col w-9/12 mx-auto">
      <div class="text-center">
        <h1 class="titre text-3xl font-bold mb-8">Greetings</h1>
      </div>
      <form method="POST" class="flex flex-col">
        <label class="uppercase font-bold" for="email">email</label>
        <input class="bg-transparent border border-gris rounded-sm px-2 py-1 my-2 text-gris" type="email" name="email" placeholder="email">
        <label class="uppercase font-bold" for="username">username</label>
        <input class="bg-transparent border border-gris rounded-sm px-2 py-1 my-2 text-gris" type="text" name="username" placeholder="username">
        <label class="uppercase font-bold pt-4" for="password">passowrd</label>
        <input class="bg-transparent border border-gris rounded-sm px-2 py-1 my-2 text-gris" id="password" name="password1" type="password" placeholder="password">
        <label class="uppercase font-bold pt-4" for="password">passowrd</label>
        <input class="bg-transparent border border-gris rounded-sm px-2 py-1 my-2 text-gris" id="password" type="password" name="password2" placeholder="retype password">
        <input class="text-white bg-rouge my-10 text-2xl uppercase font-bold py-3 rounded-lg" type="submit" value="Register">
      </form>
      
      <button class=" underline text-xl font-bold -mt-3 mb-3 "><a class="text-rouge" href="./login.php">Already have an account ?</a></button>
      <button><a class="text-gris" href="../index.php">Back</a></button>
    </div>
    <div></div>
  </div>


</body>
</html>