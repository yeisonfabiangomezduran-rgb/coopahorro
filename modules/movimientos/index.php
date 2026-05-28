<?php include("movimientos.php"); ?>

<!DOCTYPE html>
<html lang="es">

<head>

<meta charset="UTF-8">

<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Movimientos | CoopAhorro</title>

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
💸 Historial de Movimientos
</h2>

<p class="text-muted">
Consulta de depósitos y retiros realizados.
</p>

</div>

</div>

<!-- TABLA -->

<div class="card border-0">

<div class="card-body">

<div class="table-responsive">

<table class="custom-table">

<thead>

<tr>

<th width="80">ID</th>

<th>Asociado</th>

<th width="150">Tipo</th>

<th width="180">Valor</th>

<th>Descripción</th>

<th width="220">Fecha</th>

</tr>

</thead>

<tbody>

<?php while($fila = mysqli_fetch_assoc($resultado)){ ?>

<tr>

<td>

<?php echo $fila['id']; ?>

</td>

<td>

<?php
echo $fila['nombres'] . " " . $fila['apellidos'];
?>

</td>

<td>

<?php if(strtolower($fila['tipo']) == 'deposito'){ ?>

<span class="badge bg-success">
Depósito
</span>

<?php }else{ ?>

<span class="badge bg-warning text-dark">
Retiro
</span>

<?php } ?>

</td>

<td>

$ <?php echo number_format($fila['valor']); ?>

</td>

<td>

<?php echo $fila['descripcion']; ?>

</td>

<td>

<?php echo $fila['fecha']; ?>

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