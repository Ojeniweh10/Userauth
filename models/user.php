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
        $stmt= $this->pdo->prepare("INSERT INTO user_id(name, email, password) VALUES (?,?,?)");
        return $stmt->execute([$name, $email, $hashed_password]);
    }

    //login user
    public function login($email, $password) {
        $stmt=$this->pdo->prepare("SELECT * FROM user_id WHERE email = :email");
        $stmt->execute([':email' => $email]);
        $user=$stmt-> fetch();

        if ($user && password_verify($password, $user['password'])) {
            return $user;
        }
        return false;

    }

    //forgot password

    public function resetPassword($email, $newPassword) {
    // Prepare the SELECT statement
    $stmt = $this->pdo->prepare("SELECT * FROM user_id WHERE email = :email");
    // Execute the SELECT statement
    $stmt->execute([':email' => $email]); // Execute the statement with the email parameter

    // Check if any user was found with the provided email
    if ($stmt->rowCount() > 0) {
        // Hash the new password
        $hashed_password = password_hash($newPassword, PASSWORD_DEFAULT);

        // Prepare the UPDATE statement
        $update = $this->pdo->prepare("UPDATE user_id SET password = :password WHERE email = :email");
        
        // Execute the UPDATE statement with both parameters
        return $update->execute([':password' => $hashed_password, ':email' => $email]);
    }
    return false; // If no user was found, return false
}

}