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

$prestamo_id = $_POST['prestamo_id'];

$saldo = $_POST['saldo'];

$valor = $_POST['valor'];

# =========================
# VALIDACIONES
# =========================

if($valor <= 0){

    die("Valor inválido");
}

# =========================
# VALIDAR EXCESO
# =========================

if($valor > $saldo){

    echo "

    <script>

    alert('El pago supera el saldo pendiente');

    window.location='index.php';

    </script>

    ";

    exit();
}

# =========================
# NUEVO SALDO
# =========================

$nuevoSaldo = $saldo - $valor;

# EVITAR NEGATIVOS

if($nuevoSaldo < 0){

    $nuevoSaldo = 0;
}

# =========================
# ESTADO
# =========================

$estado = 'aprobado';

if($nuevoSaldo <= 0){

    $estado = 'pagado';
}

# =========================
# ACTUALIZAR PRÉSTAMO
# =========================

$sql = "UPDATE prestamos

SET saldo='$nuevoSaldo',
estado='$estado'

WHERE id='$prestamo_id'";

$resultado = mysqli_query($conn, $sql);

# =========================
# REGISTRAR PAGO
# =========================

$sqlPago = "INSERT INTO pagos_prestamo
(
prestamo_id,
valor
)

VALUES
(
'$prestamo_id',
'$valor'
)";

mysqli_query($conn, $sqlPago);

# =========================
# REDIRECT
# =========================

if($resultado){

    header("Location: index.php");

}else{

    echo "Error al registrar pago";
}

exit();

?>