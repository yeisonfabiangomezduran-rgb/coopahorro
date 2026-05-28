<?php

include("../../config/conexion.php");

/* =========================
   INGRESOS DEL MES
========================= */

$ingresos = mysqli_query($conn,

"SELECT SUM(valor) total

FROM movimientos

WHERE tipo='deposito'

AND MONTH(fecha)=MONTH(CURDATE())

AND YEAR(fecha)=YEAR(CURDATE())");

$totalIngresos =
mysqli_fetch_assoc($ingresos)['total'];

/* =========================
   RETIROS DEL MES
========================= */

$retiros = mysqli_query($conn,

"SELECT SUM(valor) total

FROM movimientos

WHERE tipo='retiro'

AND MONTH(fecha)=MONTH(CURDATE())

AND YEAR(fecha)=YEAR(CURDATE())");

$totalRetiros =
mysqli_fetch_assoc($retiros)['total'];

/* =========================
   PRÉSTAMOS DEL MES
========================= */

$prestamos = mysqli_query($conn,

"SELECT SUM(monto) total

FROM prestamos

WHERE MONTH(fecha)=MONTH(CURDATE())

AND YEAR(fecha)=YEAR(CURDATE())");

$totalPrestamos =
mysqli_fetch_assoc($prestamos)['total'];

/* =========================
   NUEVOS ASOCIADOS
========================= */

$asociados = mysqli_query($conn,

"SELECT COUNT(*) total

FROM asociados

WHERE MONTH(fecha_registro)=MONTH(CURDATE())

AND YEAR(fecha_registro)=YEAR(CURDATE())");

$totalAsociados =
mysqli_fetch_assoc($asociados)['total'];

/* =========================
   CAPITAL ACTUAL
========================= */

$capital = mysqli_query($conn,

"SELECT SUM(saldo) total

FROM ahorros");

$totalCapital =
mysqli_fetch_assoc($capital)['total'];

?>

<!DOCTYPE html>
<html lang="es">

<head>

<meta charset="UTF-8">

<title>Resumen Financiero</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
rel="stylesheet">

<link rel="stylesheet"
href="../../assets/css/dashboard.css">

<link rel="stylesheet"
href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

<style>

.container-resumen{

    margin-left:260px;

    padding:35px;
}

.card-resumen{

    background:#ffffff;

    border-radius:25px;

    padding:30px;

    border:1px solid #e5e7eb;

    box-shadow:
    0 10px 25px rgba(0,0,0,.04);

    height:100%;
}

.icon-resumen{

    font-size:42px;

    color:#111827;

    margin-bottom:15px;
}

.valor-resumen{

    font-size:32px;

    font-weight:800;

    color:#111827;
}

.titulo-resumen{

    color:#6b7280;

    font-size:15px;
}

</style>

</head>

<body>

<?php include("../../layouts/sidebar.php"); ?>

<div class="container-resumen">

<div class="mb-5">

<h1 class="fw-bold">

<i class="bi bi-bar-chart-line"></i>
 Resumen Financiero Mensual

</h1>

<p class="text-muted">

Indicadores financieros del mes actual.

</p>

</div>

<div class="row g-4">

<!-- INGRESOS -->

<div class="col-lg-4">

<div class="card-resumen">

<div class="icon-resumen">

<i class="bi bi-arrow-down-circle"></i>

</div>

<div class="titulo-resumen">
Ingresos del mes
</div>

<div class="valor-resumen">

$ <?php echo number_format($totalIngresos); ?>

</div>

</div>

</div>

<!-- RETIROS -->

<div class="col-lg-4">

<div class="card-resumen">

<div class="icon-resumen">

<i class="bi bi-arrow-up-circle"></i>

</div>

<div class="titulo-resumen">
Retiros del mes
</div>

<div class="valor-resumen">

$ <?php echo number_format($totalRetiros); ?>

</div>

</div>

</div>

<!-- PRESTAMOS -->

<div class="col-lg-4">

<div class="card-resumen">

<div class="icon-resumen">

<i class="bi bi-bank"></i>

</div>

<div class="titulo-resumen">
Préstamos otorgados
</div>

<div class="valor-resumen">

$ <?php echo number_format($totalPrestamos); ?>

</div>

</div>

</div>

<!-- ASOCIADOS -->

<div class="col-lg-6">

<div class="card-resumen">

<div class="icon-resumen">

<i class="bi bi-people"></i>

</div>

<div class="titulo-resumen">
Nuevos asociados
</div>

<div class="valor-resumen">

<?php echo $totalAsociados; ?>

</div>

</div>

</div>

<!-- CAPITAL -->

<div class="col-lg-6">

<div class="card-resumen">

<div class="icon-resumen">

<i class="bi bi-wallet2"></i>

</div>

<div class="titulo-resumen">
Capital actual
</div>

<div class="valor-resumen">

$ <?php echo number_format($totalCapital); ?>

</div>

</div>

</div>

</div>

</div>

</body>

</html>