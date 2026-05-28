<?php

include("../../config/conexion.php");

$id = $_POST['id'];
$nombres = $_POST['nombres'];
$apellidos = $_POST['apellidos'];
$cedula = $_POST['cedula'];
$telefono = $_POST['telefono'];
$correo = $_POST['correo'];

$sql = "UPDATE asociados SET

nombres='$nombres',
apellidos='$apellidos',
cedula='$cedula',
telefono='$telefono',
correo='$correo'

WHERE id='$id'";

mysqli_query($conn, $sql);

header("Location: index.php");
exit();

?>