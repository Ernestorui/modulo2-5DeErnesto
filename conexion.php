<?php
// Realizamos la conexión con la base utilizando la extensión mysqli
// Declaramos las variables que se necesitan para indicar la información
// de nuestra base de datos
$host = 'localhost';
$user = 'root';
$pass = '887866';
$db = 'farmaceuticadb';
// Guardamos en una variable el objeto de la conexion
$conn = new mysqli($host, $user, $pass, $db);
// Verificamos si la conexion se realizo correctamente
if($conn->connect_error)
die('Conexión fallida: ' . $conn->connect_error);