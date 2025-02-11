<?php
    header("Access-Control-Allow-Origin: *"); 
    header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS"); 
    header("Access-Control-Allow-Headers: Content-Type, Authorization"); 

    if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
        exit;
    }
    require_once('../includes/Client.class.php');

    if($_SERVER['REQUEST_METHOD'] == 'DELETE' 
        && isset($_GET['id']) ){
            Client::delete_client_by_id($_GET['id']);
        }

?>