<?php
require_once '../config/db.php';
require_once '../models/User.php';

header("Content-Type: application/json");

$data = json_decode(file_get_contents("php://input"), true);

if (isset($data['email']) && isset($data['password'])) {
    $user = new User($pdo);
    $loggedInUser = $user->login($data['email'], $data['password']);
    if ($loggedInUser) {
        echo json_encode(["message" => "Login successful", "user" => $loggedInUser]);
    } else {
        echo json_encode(["message" => "Invalid email or password"]);
    }
} else {
    echo json_encode(["message" => "Invalid input"]);
}
