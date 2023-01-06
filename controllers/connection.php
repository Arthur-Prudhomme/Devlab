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

        if (isset($email_check['email'])) {
            echo 'There is already an account registered with this email - ';
            return false;
        }
        $username = $user->username;
        $query = 'SELECT * FROM `user` WHERE `username` =?';
        $username_check = $this->pdo->prepare($query);
        $username_check->execute(array($username));
        $username_check = $username_check->fetch();

        if (isset($username_check['username'])) {
            echo 'There is already an account registered with this username - ';
            return false;
        } else {
            $query = 'INSERT INTO user (email, username, password)
                    VALUES (:email, :username, :password)';
            $statement = $this->pdo->prepare($query);
            $statement->execute([
                'email' => $user->email,
                'username' => $user->username,
                'password' => md5($user->password . 'VforVendetta'),
            ]);

            $query = 'SELECT `id` FROM `user` WHERE `email` =?';
            $get_id = $this->pdo->prepare($query);
            $get_id->execute(array($login_email));
            $get_id = $get_id->fetch();

            $query = 'INSERT INTO album (user_id, name, is_watched)
                    VALUES (:user_id, :name, :is_watched)';
            $statement = $this->pdo->prepare($query);
            $statement->execute([
                'user_id' => $get_id['id'],
                'name' => 'watched',
                'is_watched' => '1',
            ]);

            $query = 'INSERT INTO album (user_id, name, is_watch_later)
                    VALUES (:user_id, :name, :is_watch_later)';
            $statement = $this->pdo->prepare($query);
            return $statement->execute([
                'user_id' => $get_id['id'],
                'name' => 'watch_later',
                'is_watch_later' => '1',
            ]);
        }
    }

    public function login()
    {
        $login_email = $_POST['email'];
        $login_password = md5($_POST['password'] . 'VforVendetta');

        $query = 'SELECT * FROM user WHERE email =?';

        $login_check = $this->pdo->prepare($query);
        $login_check->execute(array($login_email));
        $login_check = $login_check->fetch();

        if (!$login_check) {
            echo 'There is no account registered with this email';
        } else {
            if ($login_check['password'] == $login_password) {
                $_SESSION['user'] = $login_check;

                header("Location: ../index.php");
            } else {
                echo 'Wrong password';
            }
        }
    }

    public function getUserByUsername($username, bool $containing, $excludeUser){
        if(!empty($username)){
            if(!empty($excludeUser)){
                $query = 'SELECT * FROM user WHERE id != '.$excludeUser.' AND username LIKE ?';
            }else {
                $query = 'SELECT * FROM user WHERE username LIKE ?';
            }
            if($containing === true){
                $username = '%'.$username.'%';
            }
            $statement = $this->pdo->prepare($query);
            $statement->execute(array($username));
            return $statement->fetchAll();
        }
    }

    public function getUserIdByUsername($username){
        $query = 'SELECT id FROM user WHERE username LIKE ?';
        $statement = $this->pdo->prepare($query);
        $statement->execute(array($username));
        $statement = $statement->fetchAll(PDO::FETCH_COLUMN, 0);
        return $statement[0];
    }

    public function getUserById($user_id){
        $query = 'SELECT * FROM user WHERE `id` =?';
        $statement = $this->pdo->prepare($query);
        $statement->execute(array($user_id));
        return $statement->fetch();
    }
}
