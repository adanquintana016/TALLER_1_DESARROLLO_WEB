<?php
include '../conexion.php';

try {

    $statement = $mbd->prepare("INSERT INTO cliente (nombre, telefono, correo, id_producto) VALUES (:nombre, :telefono, :correo, :id_producto)");

    $statement->bindParam(':nombre', $nombre);
    $statement->bindParam(':telefono', $telefono);
    $statement->bindParam(':correo', $correo);
    $statement->bindParam(':id_producto', $id_producto);

    $nombre = $_POST['nombre'];
    $telefono = $_POST['telefono'];
    $correo = $_POST['correo'];  
    $id_producto = $_POST['id_producto'];  

    $statement->execute();
    $_POST['id'] = $mbd->lastInsertId();

    $statement = $mbd->prepare("SELECT * FROM cliente WHERE id = ". $_POST['id_producto']);
    $statement->execute();
    $data = $statement->fetch(PDO::FETCH_ASSOC);
    $_POST['data_fk'] = $data;
    
    header('Content-type:application/json;charset=utf-8');
    echo json_encode($_POST);
} catch (PDOException $e) {
    header('Content-type:application/json;charset=utf-8');
    echo json_encode([
        'error' => [
            'codigo' => $e->getCode(),
            'mensaje' => $e->getMessage()
        ]
    ]);
}