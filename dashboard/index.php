<?php

session_start();

include("../config/conexion.php");

if(!isset($_SESSION['usuario'])){
    header("Location: ../auth/login.php");
    exit();
}

/* =========================
   ASOCIADOS ACTIVOS
========================= */

$activos = mysqli_query($conn,

"SELECT COUNT(*) total

FROM asociados

WHERE estado='activo'");

$totalActivos =
mysqli_fetch_assoc($activos)['total'];

/* =========================
   TOTAL AHORROS
========================= */

$ahorros = mysqli_query($conn,

"SELECT SUM(saldo) total

FROM ahorros");

$totalAhorros =
mysqli_fetch_assoc($ahorros)['total'];

/* =========================
   PRÉSTAMOS ACTIVOS
========================= */

$prestamos = mysqli_query($conn,

"SELECT SUM(saldo) total

FROM prestamos

WHERE estado!='pagado'");

$totalPrestamos =
mysqli_fetch_assoc($prestamos)['total'];

/* =========================
   MOVIMIENTOS DEL DÍA
========================= */

$movimientosHoy = mysqli_query($conn,

"SELECT COUNT(*) total

FROM movimientos

WHERE DATE(fecha)=CURDATE()");

$totalMovimientosHoy =
mysqli_fetch_assoc($movimientosHoy)['total'];

/* =========================
   ÚLTIMOS MOVIMIENTOS
========================= */

$sqlMovimientos = "SELECT

movimientos.*,
asociados.nombres,
asociados.apellidos

FROM movimientos

INNER JOIN asociados
ON movimientos.asociado_id = asociados.id

ORDER BY movimientos.fecha DESC

LIMIT 5";

$movimientos = mysqli_query($conn, $sqlMovimientos);

?>

<!DOCTYPE html>
<html lang="es">

<head>

<meta charset="UTF-8">

<meta name="viewport"
content="width=device-width, initial-scale=1.0">

<title>Dashboard | CoopAhorro</title>

<!-- BOOTSTRAP -->

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
rel="stylesheet">

<!-- CSS -->

<link rel="stylesheet"
href="../assets/css/dashboard.css">

<!-- ICONOS -->

<link rel="stylesheet"
href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

</head>

<body>

<!-- SIDEBAR -->

<?php include("../layouts/sidebar.php"); ?>

<!-- CONTENIDO -->

<div class="main-content">

<!-- HEADER -->

<div class="mb-5">

<h2 class="fw-bold mb-2">
Dashboard
</h2>

<p class="text-muted">
Resumen general del sistema financiero.
</p>

</div>

<!-- TARJETAS -->

<div class="row">

<!-- ASOCIADOS -->

<div class="col-lg-3 col-md-6 mb-4">

<div class="card border-0 shadow-sm">

<div class="card-body card-dashboard">

<div>

<p class="text-muted mb-1">
Asociados activos
</p>

<h3 class="fw-bold text-dark">

<?php echo $totalActivos; ?>

</h3>

</div>

<i class="bi bi-people card-icon"></i>

</div>

</div>

</div>

<!-- AHORROS -->

<div class="col-lg-3 col-md-6 mb-4">

<div class="card border-0 shadow-sm">

<div class="card-body card-dashboard">

<div>

<p class="text-muted mb-1">
Ahorros totales
</p>

<h3 class="fw-bold text-dark">

$ <?php echo number_format($totalAhorros); ?>

</h3>

</div>

<i class="bi bi-wallet2 card-icon"></i>

</div>

</div>

</div>

<!-- PRÉSTAMOS -->

<div class="col-lg-3 col-md-6 mb-4">

<div class="card border-0 shadow-sm">

<div class="card-body card-dashboard">

<div>

<p class="text-muted mb-1">
Préstamos activos
</p>

<h3 class="fw-bold text-dark">

$ <?php echo number_format($totalPrestamos); ?>

</h3>

</div>

<i class="bi bi-bank card-icon"></i>

</div>

</div>

</div>

<!-- MOVIMIENTOS -->

<div class="col-lg-3 col-md-6 mb-4">

<div class="card border-0 shadow-sm">

<div class="card-body card-dashboard">

<div>

<p class="text-muted mb-1">
Movimientos hoy
</p>

<h3 class="fw-bold text-dark">

<?php echo $totalMovimientosHoy; ?>

</h3>

</div>

<i class="bi bi-arrow-left-right card-icon"></i>

</div>

</div>

</div>

</div>

<!-- TABLA -->

<div class="card border-0 shadow-sm">

<div class="card-body">

<div class="d-flex
justify-content-between
align-items-center
mb-4">

<div>

<h4 class="fw-bold mb-1">
Últimos movimientos
</h4>

<p class="text-muted mb-0">
Movimientos recientes registrados.
</p>

</div>

<a href="../modules/movimientos/index.php"
class="btn btn-dark">

Ver todos

</a>

</div>

<div class="table-responsive">

<table class="custom-table">

<thead>

<tr>

<th>Asociado</th>
<th>Tipo</th>
<th>Valor</th>
<th>Fecha</th>

</tr>

</thead>

<tbody>

<?php while($m = mysqli_fetch_assoc($movimientos)){ ?>

<tr>

<td>

<?php
echo $m['nombres']." ".
$m['apellidos'];
?>

</td>

<td class="text-dark">

<?php echo ucfirst($m['tipo']); ?>

</td>

<td>

$ <?php echo number_format($m['valor']); ?>

</td>

<td>

<?php echo $m['fecha']; ?>

</td>

</tr>

<?php } ?>

</tbody>

</table>

</div>

</div>

</div>

</div>

</body>

</html>