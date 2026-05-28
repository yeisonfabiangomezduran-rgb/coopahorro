<?php

session_start();

include("../../config/conexion.php");

$sql = "SELECT 
ahorros.id,
asociados.nombres,
asociados.apellidos,
ahorros.tipo,
ahorros.saldo

FROM ahorros

INNER JOIN asociados
ON ahorros.asociado_id = asociados.id";

$resultado = mysqli_query($conn, $sql);

?>

<!DOCTYPE html>
<html lang="es">

<head>

<meta charset="UTF-8">

<title>Ahorros</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="../../assets/css/dashboard.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>

<body class="bg-light">

<?php include("../../layouts/sidebar.php"); ?>

<div style="margin-left:260px; padding:20px;">

<div class="d-flex justify-content-between align-items-center mb-4">

<div class="d-flex justify-content-between align-items-center mb-4">

<div>

<h2 class="fw-bold">
💰 Módulo de Ahorros
</h2>

<p class="text-muted mb-0">
Gestión de cuentas y movimientos de ahorro.
</p>

</div>

</div>

<a href="crear.php" class="btn btn-success">
+ Nueva Cuenta
</a>

</div>

<div class="card shadow border-0">

<div class="card-body">

<table class="table table-hover">

<thead class="table-dark">

<tr>

<th>ID</th>
<th>Asociado</th>
<th>Tipo</th>
<th>Saldo</th>
<th>Acciones</th>

</tr>

</thead>

<tbody>

<?php while($fila = mysqli_fetch_assoc($resultado)){ ?>

<tr>

<td><?php echo $fila['id']; ?></td>

<td>
<?php echo $fila['nombres'] . " " . $fila['apellidos']; ?>
</td>

<td><?php echo $fila['tipo']; ?></td>

<td>
$ <?php echo number_format($fila['saldo']); ?>
</td>

<td>

<a 
href="depositar.php?id=<?php echo $fila['id']; ?>"
class="btn btn-success btn-sm">
Depositar
</a>

<a 
href="retirar.php?id=<?php echo $fila['id']; ?>"
class="btn btn-warning btn-sm">
Retirar
</a>

</td>

</tr>

<?php } ?>

</tbody>

</table>

</div>

</div>

</div>

</body>

</html>