<?php
require_once '../config/db.php'; //connect to the database
require_once '../models/user.php'; //Load user model

header("Content-Type: application/json"); //set json response needed for postman

$data= json_decode(file_get_contents("php://input"),true);  //get json input

if (isset($data['name']) && isset($data['email']) && isset($data['password'])) {
    $user = new user($pdo); //instantiate user class
    if ($user->register($data['name'], $data['email'], $data['password'])){
        echo json_encode(["message" => "User Registered Successfully"]);
    }else {
        echo json_encode(["message" => "User Registration Failed"]);
    }
} else {
    echo json_encode(["message" => "invalid input"]);
}