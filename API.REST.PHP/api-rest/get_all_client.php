<?php
    header("Access-Control-Allow-Origin: *"); 
    header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS"); 
    header("Access-Control-Allow-Headers: Content-Type, Authorization"); 
    header("Content-Type: application/json");

    if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
        exit;
    }
    require_once('../includes/Client.class.php');

    if ($_SERVER['REQUEST_METHOD'] == 'GET') {
        try {
            Client::get_all_clients();
        } catch (Exception $e) {
            echo json_encode(["error" => $e->getMessage()]);
        }
    }

?>