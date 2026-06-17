<?php

require_once 'conexion.php';

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $tabla = $_POST['tabla'];
    $id = $_POST['id'];

    if($tabla == 'categorias'){
//prepara la consulta SQL para obtener la categoría con el id especificado
        $stmt = $conn->prepare("SELECT * FROM categorias WHERE id_categoria=?");
        ///reemplaza el signo de interrogación por el valor de $id, indicando que es un entero 
        $stmt->bind_param('i', $id);
        $stmt->execute();

        $result = $stmt->get_result();
        $categoria = $result->fetch_assoc();

        $stmt->close();

        echo json_encode($categoria);

    }

    if($tabla == 'medicamentos'){

        $stmt = $conn->prepare("SELECT * FROM medicamentos WHERE codigo_medicamento=?");
        $stmt->bind_param('s', $id);
        $stmt->execute();

        $result = $stmt->get_result();
        $medicamento = $result->fetch_assoc();

        $stmt->close();

        echo json_encode($medicamento);

    }

    if($tabla == 'lotes'){

        $stmt = $conn->prepare("SELECT * FROM lotes WHERE id_lote=?");
        $stmt->bind_param('i', $id);
        $stmt->execute();

        $result = $stmt->get_result();
        $lote = $result->fetch_assoc();

        $stmt->close();

        echo json_encode($lote);

    }

} else {

    echo json_encode(['res' => null]);

}

?>