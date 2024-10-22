<?php
class User {
    private $pdo;

    public function __construct($db){
        $this->pdo = $db; //store the database connection
    }

    //register user
    public function register($name, $email, $password){
        $hashed_password = 
        password_hash($password, PASSWORD_DEFAULT);
        $stmt= $this->pdo->prepare("INSERT INTO users(name, email, password) VALUES (?,?,?,?");
        return $stmt->execute([$name, $email, $hashed_password]);
    }

    //login user
    public function login($email, $password) {
        $stmt=$this->pdo->prepare("SELECT * FROM users WHERE email =?");
        $stmt->execute($email);
        $user=$stmt-> fetch();

        if ($user && password_verify($password, $user['password'])) {
            return $user;
        }
        return false;

    }

    //forgot password

    public function resetPassword($email, $newPassword) {
        $stmt= $this->pdo->prepare("SELECT * FROM users WHERE email=?");
        if ($stmt->rowCount() > 0) {
            $hashed_password = password_hash($newPassword, PASSWORD_DEFAULT);
            $update = $this->pdo->prepare("UPDATE users SET password = ? WHERE email = ?");
            return
            $update->execute([$hashed_password, $email]);
        }
        return false;
    }
}