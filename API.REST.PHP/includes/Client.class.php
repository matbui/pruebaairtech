<?php
header("Access-Control-Allow-Origin: *"); 
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS"); 
header("Access-Control-Allow-Headers: Content-Type, Authorization"); 
header("Content-Type: application/json"); 

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    exit;
}

require_once('Database.class.php');

class Client {
    public static function create_client($email, $name, $city, $telephone) {
        $database = new Database();
        $conn = $database->getConnection();

        $stmt = $conn->prepare('INSERT INTO listado_clientes(email, name, city, telephone)
            VALUES(:email, :name, :city, :telephone)');
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':city', $city);
        $stmt->bindParam(':telephone', $telephone);

        if ($stmt->execute()) {
            http_response_code(201); 
            echo json_encode(["message" => "Cliente creado correctamente"]);
        } else {
            http_response_code(500); 
            echo json_encode(["error" => "No se pudo crear el cliente"]);
        }
    }

    public static function delete_client_by_id($id) {
        $database = new Database();
        $conn = $database->getConnection();

        $stmt = $conn->prepare('DELETE FROM listado_clientes WHERE id=:id');
        $stmt->bindParam(':id', $id);

        if ($stmt->execute()) {
            http_response_code(200); 
            echo json_encode(["message" => "Cliente borrado correctamente"]);
        } else {
            http_response_code(500); 
            echo json_encode(["error" => "No se pudo borrar el cliente"]);
        }
    }

    public static function get_all_clients() {
        $database = new Database();
        $conn = $database->getConnection();

        $stmt = $conn->prepare('SELECT * FROM listado_clientes');
        if ($stmt->execute()) {
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC); 
            http_response_code(200); 
            echo json_encode($result);
        } else {
            http_response_code(500);
            echo json_encode(["error" => "No se pudo consultar los clientes"]);
        }
    }

    public static function update_client($id, $email, $name, $city, $telephone) {
        $database = new Database();
        $conn = $database->getConnection();

        $stmt = $conn->prepare('UPDATE listado_clientes SET email=:email, name=:name, city=:city, telephone=:telephone WHERE id=:id');
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':city', $city);
        $stmt->bindParam(':telephone', $telephone);
        $stmt->bindParam(':id', $id);

        if ($stmt->execute()) {
            http_response_code(200); 
            echo json_encode(["message" => "Cliente actualizado correctamente"]);
        } else {
            http_response_code(500); 
            echo json_encode(["error" => "No se pudo actualizar el cliente"]);
        }
    }
}
?>