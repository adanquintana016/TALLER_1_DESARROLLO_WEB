<?php
include '../conexion.php';

try {

    $statement = $mbd->prepare("SELECT * FROM cliente WHERE id = :id");
    $statement->bindParam(':id', $id);
    $id = $_GET['id'];      
    $statement->execute();
    $post = $statement->fetch(PDO::FETCH_ASSOC);

    $statement = $mbd->prepare("SELECT * FROM cliente WHERE id = ". $post['id_producto']);
    $statement->execute();
    $producto = $statement->fetch(PDO::FETCH_ASSOC);  

    $post['data_fk'] = $producto;

    header('Content-type:application/json;charset=utf-8');
    echo json_encode([
        "post" => $post        
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