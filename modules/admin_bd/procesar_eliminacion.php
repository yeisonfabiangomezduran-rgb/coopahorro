<?php

session_start();

include("../../config/conexion.php");

if(!isset($_SESSION['admin_bd'])){

    header("Location:index.php");
    exit();

}

$id = $_GET['id'];

/* =========================
   OBTENER PRÉSTAMOS
========================= */

$prestamos = mysqli_query($conn,

"SELECT id

FROM prestamos

WHERE asociado_id='$id'");

/* =========================
   ELIMINAR PAGOS
========================= */

while($p = mysqli_fetch_assoc($prestamos)){

    $prestamo_id = $p['id'];

    mysqli_query($conn,

    "DELETE FROM pagos_prestamo

    WHERE prestamo_id='$prestamo_id'");

}

/* =========================
   ELIMINAR PRÉSTAMOS
========================= */

mysqli_query($conn,

"DELETE FROM prestamos

WHERE asociado_id='$id'");

/* =========================
   ELIMINAR MOVIMIENTOS
========================= */

mysqli_query($conn,

"DELETE FROM movimientos

WHERE asociado_id='$id'");

/* =========================
   ELIMINAR AHORROS
========================= */

mysqli_query($conn,

"DELETE FROM ahorros

WHERE asociado_id='$id'");

/* =========================
   ELIMINAR ASOCIADO
========================= */

mysqli_query($conn,

"DELETE FROM asociados

WHERE id='$id'");

/* =========================
   REDIRECCIÓN
========================= */

header("Location: eliminar_definitivo.php");
exit();

?>