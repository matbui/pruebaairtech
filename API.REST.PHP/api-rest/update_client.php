<?php
    header("Access-Control-Allow-Origin: *"); 
    header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS"); 
    header("Access-Control-Allow-Headers: Content-Type, Authorization"); 

    if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
        exit;
    }
    require_once('../includes/Client.class.php');

    if($_SERVER['REQUEST_METHOD'] == 'PUT' 
        && isset($_GET['id'], $_GET['email']) && isset($_GET['name']) && isset($_GET['city'])  && isset($_GET['telephone'])){
            Client::update_client($_GET['id'], $_GET['email'], $_GET['name'], $_GET['city'], $_GET['telephone']);
        }

?>