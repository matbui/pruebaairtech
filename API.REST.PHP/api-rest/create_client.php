<?php
header("Access-Control-Allow-Origin: *"); 
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS"); 
header("Access-Control-Allow-Headers: Content-Type, Authorization"); 
header("Content-Type: application/json"); 

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    exit;
}

require_once('../includes/Client.class.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $data = json_decode(file_get_contents("php://input"), true);

    if (isset($data['email']) && isset($data['name']) && isset($data['city']) && isset($data['telephone'])) {
        Client::create_client($data['email'], $data['name'], $data['city'], $data['telephone']);
    } else {
        http_response_code(400); 
        echo json_encode(["error" => "Faltan datos requeridos"]);
    }
}
?>