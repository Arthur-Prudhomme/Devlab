<?php

if($_SESSION['id'] == null){
    logout();
}
if(array_key_exists('logout', $_GET)){
    logout();
}

function logout(){
    session_destroy();
    header("Location: ../index.php");
}