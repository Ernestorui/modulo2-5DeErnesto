<?php

require_once 'conexion.php';

if($_SERVER['REQUEST_METHOD'] == 'POST'){

    $tabla = $_POST['tabla'];
    $process = $_POST['process'];
    $id = $_POST['id'];

    if($tabla == 'categorias'){

        $nombre = $_POST['nombre_categoria'];

        if($process == 'new'){

            $stmt = $conn->prepare("INSERT INTO categorias(nombre_categoria)
            VALUES(?)");

            $stmt->bind_param('s', $nombre);

        } else {

            $stmt = $conn->prepare("UPDATE categorias SET nombre_categoria=?
            WHERE id_categoria=?");

            $stmt->bind_param('si', $nombre, $id);

        }

    }

    if($tabla == 'medicamentos'){

        $codigo = $_POST['codigo_medicamento'];
        $comercial = $_POST['nombre_comercial'];
        $generico = $_POST['nombre_generico'];
        $forma = $_POST['forma_farmaceutica'];
        $concentracion = $_POST['concentracion'];
        $receta = $_POST['requiere_receta'];
        $categoria = $_POST['id_categoria'];

        if($process == 'new'){

            $stmt = $conn->prepare("INSERT INTO medicamentos
            (codigo_medicamento, nombre_comercial, nombre_generico,
            forma_farmaceutica, concentracion, requiere_receta, id_categoria)
            VALUES(?, ?, ?, ?, ?, ?, ?)");

            $stmt->bind_param(
                'sssssii',
                $codigo,
                $comercial,
                $generico,
                $forma,
                $concentracion,
                $receta,
                $categoria
            );

        } else {                                                                                                         
            $stmt = $conn->prepare("UPDATE medicamentos SET
            nombre_comercial=?,
            nombre_generico=?,
            forma_farmaceutica=?,
            concentracion=?,
            requiere_receta=?,
            id_categoria=?
            WHERE codigo_medicamento=?");

            $stmt->bind_param(
                'ssssiis',
                $comercial,
                $generico,
                $forma,
                $concentracion,
                $receta,
                $categoria,
                $id
            );

        }

    }

    if($tabla == 'lotes'){

        $numero = $_POST['numero_lote'];
        $ingreso = $_POST['fecha_ingreso'];
        $caducidad = $_POST['fecha_caducidad'];
        $stock = $_POST['stock'];
        $ubicacion = $_POST['ubicacion_almacen'];
        $compra = $_POST['precio_compra'];
        $venta = $_POST['precio_venta'];
        $codigo = $_POST['codigo_medicamento'];

        if($process == 'new'){

            $stmt = $conn->prepare("INSERT INTO lotes
            (numero_lote, fecha_ingreso, fecha_caducidad, stock,
            ubicacion_almacen, precio_compra, precio_venta, codigo_medicamento)
            VALUES(?, ?, ?, ?, ?, ?, ?, ?)");

            $stmt->bind_param(
                'sssisdsi',
                $numero,
                $ingreso,
                $caducidad,
                $stock,
                $ubicacion,
                $compra,
                $venta,
                $codigo
            );

        } else {

            $stmt = $conn->prepare("UPDATE lotes SET
            numero_lote=?,
            fecha_ingreso=?,
            fecha_caducidad=?,
            stock=?,
            ubicacion_almacen=?,
            precio_compra=?,
            precio_venta=?
            WHERE id_lote=?");

            $stmt->bind_param(
                'sssisdsi',
                $numero,
                $ingreso,
                $caducidad,
                $stock,
                $ubicacion,
                $compra,
                $venta,
                $id
            );

        }

    }

    if($stmt->execute())
    echo json_encode(['res' => true]);
    else
    echo json_encode(['res' => false]);

}

?>

