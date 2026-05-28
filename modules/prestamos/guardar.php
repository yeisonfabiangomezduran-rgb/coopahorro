<?php

session_start();

if(!isset($_SESSION['usuario'])){
    header("Location: ../../auth/login.php");
    exit();
}

include("../../config/conexion.php");

# =========================
# DATOS
# =========================

$asociado_id = $_POST['asociado_id'];

$monto = $_POST['monto'];

$interes = $_POST['interes'];

$cuotas = $_POST['cuotas'];

# =========================
# VALIDAR ASOCIADO ACTIVO
# =========================

$validar = mysqli_query($conn,

"SELECT * FROM asociados

WHERE id='$asociado_id'

AND estado='activo'");

if(mysqli_num_rows($validar) == 0){

    die("Asociado inactivo");
}

# =========================
# CALCULOS
# =========================

$totalInteres = ($monto * $interes) / 100;

$saldoTotal = $monto + $totalInteres;

# =========================
# ESTADO INICIAL
# =========================

$estado = 'pendiente';

# =========================
# INSERTAR PRESTAMO
# =========================

$sql = "INSERT INTO prestamos
(
asociado_id,
monto,
interes,
cuotas,
saldo,
estado
)

VALUES
(
'$asociado_id',
'$monto',
'$interes',
'$cuotas',
'$saldoTotal',
'$estado'
)";

$resultado = mysqli_query($conn, $sql);

# =========================
# REDIRECT
# =========================

if($resultado){

    header("Location: index.php");

}else{

    echo "Error al registrar préstamo";
}

exit();

?>