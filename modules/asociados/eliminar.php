<?php

session_start();

if(!isset($_SESSION['usuario'])){
    header("Location: ../../auth/login.php");
    exit();
}

include("../../config/conexion.php");

$id = $_GET['id'];

# =========================
# VALIDAR PRESTAMOS ACTIVOS
# =========================

$prestamos = mysqli_query($conn,

"SELECT * FROM prestamos

WHERE asociado_id='$id'

AND estado != 'pagado'");

if(mysqli_num_rows($prestamos) > 0){

    header("Location: index.php?error=prestamo");
    exit();
}

# =========================
# DESACTIVAR ASOCIADO
# =========================

$sql = "UPDATE asociados

SET estado='inactivo'

WHERE id='$id'";

$resultado = mysqli_query($conn, $sql);

# =========================
# REDIRECT
# =========================

if($resultado){

    header("Location: index.php?success=desactivado");

}else{

    echo "Error al desactivar asociado";
}

?>