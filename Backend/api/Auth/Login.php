<?php
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Content-Type");
header("Access-Control-Allow-Methods: POST, OPTIONS");

if ($_SERVER["REQUEST_METHOD"] === "OPTIONS") {
  exit;
}

require_once '../../Config/database.php';

$database = new Database();
$db = $database->getConnection();

$data = json_decode(file_get_contents("php://input"), true);

if(isset($data['username']) && isset($data['password'])) {
    if($data['username'] === 'Admin' && $data['password'] === 'password123') {
        echo json_encode([
            "success" => true,
            "message" => "Login successful",
            "user" => [
                "username" => "Admin",
                "role" => "admin",
                "token" => bin2hex(random_bytes(16))
            ]
        ]);
    } else {
        echo json_encode([
            "success" => false,
            "message" => "Invalid credentials"
        ]);
    }
} else {
    echo json_encode([
        "success" => false,
        "message" => "Username and password required"
    ]);
}