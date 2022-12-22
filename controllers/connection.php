<?php
require_once 'user.php';
session_start();

class Connection
{
    private PDO $pdo;

    public function __construct()
    {
        $this->pdo = new PDO('mysql:dbname=devlab;host=127.0.0.1', 'root', '');
    }

    public function insertUser(User $user): bool
    {
        $login_email = $user->email;
        $query = 'SELECT * FROM `user` WHERE `email` =?';
        $email_check = $this->pdo->prepare($query);
        $email_check->execute(array($login_email));
        $email_check = $email_check->fetch();

        if(isset($email_check['email'])){
            echo'There is already an account registered with this email - ';
            return false;
        }else{
            $query = 'INSERT INTO user (email, password)
                    VALUES (:email, :password)';

            $statement = $this->pdo->prepare($query);

            return $statement->execute([
                'email' => $user->email,
                'password' => md5($user->password . 'VforVendetta'),
            ]);
        }
    }
    public function login(){
        $login_email = $_POST['email'];
        $login_password = md5($_POST['password'] . 'VforVendetta');

        $query = 'SELECT * FROM user WHERE email =?';

        $login_check = $this->pdo->prepare($query);
        $login_check->execute(array($login_email));
        $login_check = $login_check->fetch();

        if(!$login_check){
            echo'There is no account registered with this email';
        }
        else{
            if($login_check['password'] == $login_password){
                $_SESSION['id'] = $login_check['id'];
                $_SESSION['email'] = $login_check['email'];

                header("Location: ../index.php");
            }else{
                echo'Wrong password';
            }
        }
    }
}
