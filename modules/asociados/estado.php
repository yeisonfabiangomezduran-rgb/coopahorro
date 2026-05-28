<?php

session_start();

if(!isset($_SESSION['usuario'])){
    header("Location: ../../auth/login.php");
    exit();
}

include("../../config/conexion.php");

$id = $_GET['id'];

$accion = $_GET['accion'];

# =========================
# VALIDAR PRESTAMOS
# =========================

if($accion == 'inactivar'){

    $prestamos = mysqli_query($conn,

    "SELECT * FROM prestamos

    WHERE asociado_id='$id'

    AND estado != 'pagado'");

    if(mysqli_num_rows($prestamos) > 0){

        header("Location: index.php?error=prestamo");
        exit();
    }

    $estado = 'inactivo';

}else{

    $estado = 'activo';
}

# =========================
# ACTUALIZAR
# =========================

mysqli_query($conn,

"UPDATE asociados

SET estado='$estado'

WHERE id='$id'");

header("Location: index.php");

?>