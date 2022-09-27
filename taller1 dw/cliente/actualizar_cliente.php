<?php
include '../conexion.php';

try {

    $statement = $mbd->prepare("UPDATE cliente SET nombre = :nombre, telefono= :telefono , correo = :correo, id_producto = :id_producto WHERE id = :id");

    $statement->bindParam(':id', $id);
    $statement->bindParam(':nombre', $nombre);
    $statement->bindParam('telefono', $telefono);
    $statement->bindParam(':correo', $correo);
    $statement->bindParam(':id_producto', $id_producto);

    $id = $_POST['id'];
    $nombre = $_POST['nombre'];
    $telefono = $_POST['telefono'];
    $correo = $_POST['correo'];
    $id_producto = $_POST['id_producto'];

    $statement->execute();

    $statement = $mbd->prepare("SELECT * FROM cliente WHERE id = ". $_POST['id']);
    $statement->execute();
    $post = $statement->fetch(PDO::FETCH_ASSOC);
  
    $statement = $mbd->prepare("SELECT * FROM producto WHERE id = ". $post['id_producto']);
    $statement->execute();
    $producto = $statement->fetch(PDO::FETCH_ASSOC);  

    $post['data_fk'] = $producto;

    header('Content-type:application/json;charset=utf-8');
    echo json_encode([
        "mensaje" => " actualizacion satisfactoria",
        "data" => $post
    ]);
} catch (PDOException $e) {
    header('Content-type:application/json;charset=utf-8');
    echo json_encode([
        'error' => [
            'codigo' => $e->getCode(),
            'mensaje' => $e->getMessage()
        ]
    ]);
}
