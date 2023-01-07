<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="./style.css" rel="stylesheet">
    <link href="../style.css" rel="stylesheet">
    <link href="src/input.css" rel="stylesheet">
    <link href="./build/css/style.css" rel="stylesheet">
    <link href="../build/css/style.css" rel="stylesheet">
</head>
<body>
  
<?php
require_once '../controllers/connection.php';

if ($_POST) {
    $connection = new Connection();
    $connection->login();
}
?>

<div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 flex flex-col bg-form text-rouge lg:w-1/3 w-11/12 mx-auto rounded-lg py-4 justify-between ">
  <div class="flex flex-col w-9/12 mx-auto">
    <div class="text-center">
      <h1 class="titre text-3xl font-bold mb-8">Hello again</h1>
    </div>
    <form method="POST" class="flex flex-col">
      <label class="uppercase font-bold" for="email">email</label>
      <input class="bg-transparent border border-gris rounded-sm px-2 py-1 my-2 text-gris" type="email" name="email" placeholder="email">
      <label class="uppercase font-bold pt-4" for="password">passowrd</label>
      <input class="bg-transparent border border-gris rounded-sm px-2 py-1 my-2 text-gris" id="password" name="password" type="password" placeholder="password">
      <input class="text-white bg-rouge my-10 text-2xl uppercase font-bold py-3 rounded-lg" type="submit" value="login">
    </form>
    
    <button class=" underline text-xl font-bold -mt-3 mb-3 "><a class="text-rouge" href="./register.php">Don't have an account ?</a></button>
    <button><a class="text-gris" href="../index.php">Back</a></button>
  </div>
  <div></div>
</div>

</body>
</html>