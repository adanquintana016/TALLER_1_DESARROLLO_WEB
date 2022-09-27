<?php
include '../conexion.php';

try {

    $statement = $mbd->prepare("SELECT * FROM cliente");
    $statement->execute();
    $posts = $statement->fetchAll(PDO::FETCH_ASSOC);

    for ($i = 0; $i < count($posts); $i++) {
        $statement = $mbd->prepare("SELECT * FROM producto where id = ". $posts[$i]['id_producto']);
        $statement->execute();
        $producto = $statement->fetch(PDO::FETCH_ASSOC);
        $posts[$i]['data_fk'] = $producto;
    }

    header('Content-type:application/json;charset=utf-8');
    echo json_encode($posts);
} catch (PDOException $e) {
    header('Content-type:application/json;charset=utf-8');
    echo json_encode([
        'error' => [
            'codigo' => $e->getCode(),
            'mensaje' => $e->getMessage()
        ]
    ]);
}