<?php

session_start();

if(!isset($_SESSION['usuario'])){
    header("Location: ../../auth/login.php");
    exit();
}

include("../../config/conexion.php");

$sql = "SELECT

movimientos.*,
asociados.nombres,
asociados.apellidos

FROM movimientos

INNER JOIN asociados
ON movimientos.asociado_id = asociados.id

ORDER BY movimientos.fecha DESC";

$resultado = mysqli_query($conn, $sql);

?>