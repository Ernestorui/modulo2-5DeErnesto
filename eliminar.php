<?php

require_once 'conexion.php';

if($_SERVER['REQUEST_METHOD'] == 'POST'){

    $tabla = $_POST['tabla'];
    $id = $_POST['id'];

    if($tabla == 'categorias'){

        $stmt = $conn->prepare("DELETE FROM categorias
        WHERE id_categoria=?");

        $stmt->bind_param('i', $id);

    }

    if($tabla == 'medicamentos'){

        $stmt = $conn->prepare("DELETE FROM medicamentos
        WHERE codigo_medicamento=?");

        $stmt->bind_param('s', $id);

    }

    if($tabla == 'lotes'){

        $stmt = $conn->prepare("DELETE FROM lotes
        WHERE id_lote=?");

        $stmt->bind_param('i', $id);

    }

    $stmt->execute();

    $stmt->close();
    $conn->close();

    echo json_encode(['res' => true]);

} else {

    echo json_encode(['res' => null]);

}

?>
