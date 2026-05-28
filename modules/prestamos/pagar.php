<?php

session_start();

if(!isset($_SESSION['usuario'])){
    header("Location: ../../auth/login.php");
    exit();
}

include("../../config/conexion.php");

$id = $_GET['id'];

$sql = "SELECT

prestamos.*,
asociados.nombres,
asociados.apellidos

FROM prestamos

INNER JOIN asociados
ON prestamos.asociado_id = asociados.id

WHERE prestamos.id='$id'";

$resultado = mysqli_query($conn, $sql);

$prestamo = mysqli_fetch_assoc($resultado);

?>

<!DOCTYPE html>
<html lang="es">

<head>

<meta charset="UTF-8">

<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Pagar Cuota | CoopAhorro</title>

<!-- BOOTSTRAP -->

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<!-- CSS -->

<link rel="stylesheet" href="../../assets/css/dashboard.css">

<!-- ICONOS -->

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

</head>

<body>

<!-- SIDEBAR -->

<?php include("../../layouts/sidebar.php"); ?>

<!-- CONTENIDO -->

<div class="main-content">

<div class="row justify-content-center">

<div class="col-lg-8">

<div class="card border-0">

<div class="card-body p-4">

<!-- TITULO -->

<div class="mb-4">

<h2 class="fw-bold">
💳 Pago de Cuota
</h2>

<p class="text-muted">
Registro de pagos de préstamos.
</p>

</div>

<!-- INFO PRÉSTAMO -->

<div class="alert alert-info border-0 rounded-4">

<p class="mb-2">

<strong>Asociado:</strong>

<?php
echo $prestamo['nombres'] . " " . $prestamo['apellidos'];
?>

</p>

<p class="mb-0">

<strong>Saldo pendiente:</strong>

$ <?php echo number_format($prestamo['saldo']); ?>

</p>

</div>

<!-- FORMULARIO -->

<form action="guardar_pago.php" method="POST">

<input 
type="hidden"
name="prestamo_id"
value="<?php echo $prestamo['id']; ?>">

<input 
type="hidden"
name="saldo"
value="<?php echo $prestamo['saldo']; ?>">

<!-- VALOR -->

<div class="mb-4">

<label class="form-label fw-semibold">
Valor a pagar
</label>

<input 
type="number"
name="valor"
class="form-control"
placeholder="Ingrese valor del pago"
required>

</div>

<!-- BOTONES -->

<div class="d-flex gap-2">

<button class="btn btn-success">

<i class="bi bi-check-circle"></i>
 Guardar Pago

</button>

<a href="/coopahorro/modules/prestamos/"
class="btn btn-secondary">

<i class="bi bi-arrow-left"></i>
 Volver

</a>

</div>

</form>

</div>

</div>

</div>

</div>

</div>

</body>

</html>