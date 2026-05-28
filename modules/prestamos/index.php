<?php

session_start();

if(!isset($_SESSION['usuario'])){
    header("Location: ../../auth/login.php");
    exit();
}

include("../../config/conexion.php");

$sql = "SELECT

prestamos.*,
asociados.nombres,
asociados.apellidos

FROM prestamos

INNER JOIN asociados
ON prestamos.asociado_id = asociados.id

WHERE prestamos.estado != 'pagado'

ORDER BY prestamos.id DESC";

$resultado = mysqli_query($conn, $sql);

?>

<!DOCTYPE html>
<html lang="es">

<head>

<meta charset="UTF-8">

<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Préstamos | CoopAhorro</title>

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

<!-- HEADER -->

<div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-2">

<div>

<h2 class="fw-bold">
🏦 Módulo de Préstamos
</h2>

<p class="text-muted">
Gestión de préstamos registrados.
</p>

</div>

<a href="crear.php" class="btn btn-success">

<i class="bi bi-plus-circle"></i>
 Nuevo Préstamo

</a>

</div>

<!-- TABLA -->

<div class="card border-0">

<div class="card-body">

<div class="table-responsive">

<table class="custom-table">

<thead>

<tr>

<th>ID</th>
<th>Asociado</th>
<th>Monto</th>
<th>Interés</th>
<th>Cuotas</th>
<th>Saldo</th>
<th>Estado</th>
<th>Acciones</th>

</tr>

</thead>

<tbody>

<?php while($fila = mysqli_fetch_assoc($resultado)){ ?>

<tr>

<!-- ID -->

<td>

<?php echo $fila['id']; ?>

</td>

<!-- ASOCIADO -->

<td>

<?php
echo $fila['nombres'] . " " . $fila['apellidos'];
?>

</td>

<!-- MONTO -->

<td>

$ <?php echo number_format($fila['monto']); ?>

</td>

<!-- INTERÉS -->

<td>

<?php echo $fila['interes']; ?> %

</td>

<!-- CUOTAS -->

<td>

<?php echo $fila['cuotas']; ?>

</td>

<!-- SALDO -->

<td>

$ <?php echo number_format($fila['saldo']); ?>

</td>

<!-- ESTADO -->

<td>

<?php if($fila['estado'] == 'aprobado'){ ?>

<span class="badge bg-success">
Aprobado
</span>

<?php }elseif($fila['estado'] == 'pagado'){ ?>

<span class="badge bg-primary">
Pagado
</span>

<?php }else{ ?>

<span class="badge bg-warning text-dark">
Pendiente
</span>

<?php } ?>

</td>

<!-- ACCIONES -->

<td>

<a 
href="pagar.php?id=<?php echo $fila['id']; ?>" 
class="btn btn-primary btn-sm">

<i class="bi bi-cash"></i>
 Pagar

</a>

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