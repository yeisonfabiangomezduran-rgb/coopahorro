<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

include("../../config/conexion.php");

$nombres = $_POST['nombres'];
$apellidos = $_POST['apellidos'];
$cedula = $_POST['cedula'];
$telefono = $_POST['telefono'];
$direccion = $_POST['direccion'];
$correo = $_POST['correo'];

$sql = "INSERT INTO asociados
(
nombres,
apellidos,
cedula,
telefono,
direccion,
correo
)

VALUES

(
'$nombres',
'$apellidos',
'$cedula',
'$telefono',
'$direccion',
'$correo'
)";

$resultado = mysqli_query($conn, $sql);

if($resultado){

    header("Location: index.php");
    exit();

}else{

    echo "ERROR: " . mysqli_error($conn);

}

?>