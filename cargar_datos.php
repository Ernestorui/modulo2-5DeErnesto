<?php

require_once 'conexion.php';

if($_SERVER['REQUEST_METHOD'] == 'POST'){

    $tabla = $_POST['tabla'];

    if($tabla == 'categorias'){

        $stmt = $conn->prepare("SELECT * FROM categorias");
        $stmt->execute();
        $result = $stmt->get_result();

        $categorias = [];
        foreach($result as $row)
        $categorias[] = $row;

        echo json_encode($categorias);

    }

    if($tabla == 'medicamentos'){

        $idCategoria = $_POST['id_categoria'];

        $stmt = $conn->prepare("SELECT * FROM medicamentos WHERE id_categoria=?");
        $stmt->bind_param('i', $idCategoria);
        $stmt->execute();

        $result = $stmt->get_result();

        $medicamentos = [];

        foreach($result as $row)
        $medicamentos[] = $row;

        echo json_encode($medicamentos);

    }

    if($tabla == 'lotes'){

        $codigo = $_POST['codigo_medicamento'];

        $stmt = $conn->prepare("SELECT * FROM lotes WHERE codigo_medicamento=?");
        $stmt->bind_param('s', $codigo);
        $stmt->execute();

        $result = $stmt->get_result();

        $lotes = [];

        foreach($result as $row)
        $lotes[] = $row;

        echo json_encode($lotes);

    }

}

?>