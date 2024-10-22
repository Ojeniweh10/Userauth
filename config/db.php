<?php
// db.php
$host = 'localhost';
$db_name = 'userauth';
$username = 'root'; // or your DB username
$password = ''; // or your DB password

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db_name", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}
