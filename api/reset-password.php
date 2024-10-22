<?php
require_once '../config/db.php';
require_once '../models/User.php';

header("Content-Type: application/json");

$data = json_decode(file_get_contents("php://input"), true);

if (isset($data['email']) && isset($data['newPassword'])) {
    $user = new User($pdo);
    if ($user->resetPassword($data['email'], $data['newPassword'])) {
        echo json_encode(["message" => "Password reset successfully"]);
    } else {
        echo json_encode(["message" => "Password reset failed"]);
    }
} else {
    echo json_encode(["message" => "Invalid input"]);
}
