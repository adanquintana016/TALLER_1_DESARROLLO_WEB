<?php
include '../conexion.php';

try {

    $statement = $mbd->prepare("UPDATE producto SET artista = :artista,  album = :album, idcom :idcom, fecha_entrada :fecha_entrada, fecha_salida :fecha_salida, cantidad :cantidad, precio :precio, correo :correo WHERE id = :id");

    $statement->bindParam(':id', $id);
    $statement->bindParam(':artista', $artista);
    $statement->bindParam(':album', $album);
    $statement->bindParam(':idcom', $idcom);
    $statement->bindParam(':fecha_entrada', $fecha_entrada);
    $statement->bindParam(':fecha_salida', $fecha_salida);
    $statement->bindParam(':cantidad', $cantidad);
    $statement->bindParam(':precio', $precio);
    $statement->bindParam(':correo', $correo);

    $id = $_POST['id'];
    $artista = $_POST['artista'];
    $album = $_POST['album'];
    $idcom = $_POST['idcom'];
    $fecha_salida = $_POST['fecha_salida'];
    $fecha_entrada = $_POST['fecha_entrada'];
    $cantidad = $_POST['cantidad'];
    $precio = $_POST['precio'];
    $correo = $_POST['correo'];

    $statement->execute();
    header('Content-type:application/json;charset=utf-8');
    echo json_encode([
        "mensaje" => " actualizacion correcta",
        "data" => [
            "id" => $id,
            "descripcion" => "Desarrollo Web II"
        ]
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