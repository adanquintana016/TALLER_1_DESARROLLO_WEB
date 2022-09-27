<?php
include '../conexion.php';

try {


    $statement = $mbd->prepare("SELECT * FROM cliente WHERE id = ". $_POST['id']);
    $statement->execute();
    $post = $statement->fetch(PDO::FETCH_ASSOC);
  
    $statement = $mbd->prepare("SELECT * FROM cliente WHERE id = ". $post['id_producto']);
    $statement->execute();
    $producto = $statement->fetch(PDO::FETCH_ASSOC);  

    $post['data_fk'] = $producto;

    $statement = $mbd->prepare("DELETE FROM producto WHERE id = :id");
    $statement->bindParam(':id', $id);    
    $id = $_POST['id'];
    $statement->execute();

    header('Content-type:application/json;charset=utf-8');
    echo json_encode([
        "mensaje" => "eliminacion correcta",
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
