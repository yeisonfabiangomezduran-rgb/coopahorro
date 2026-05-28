<?php

session_start();

if(!isset($_SESSION['usuario'])){
    header("Location: ../../auth/login.php");
    exit();
}

include("../../config/conexion.php");

# =========================
# ASOCIADOS ACTIVOS
# =========================

$asociados = mysqli_query($conn,

"SELECT * FROM asociados

WHERE estado='activo'");

?>

<!DOCTYPE html>
<html lang="es">

<head>

<meta charset="UTF-8">

<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Nuevo Préstamo | CoopAhorro</title>

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

<div class="col-lg-7">

<div class="card border-0">

<div class="card-body p-4">

<!-- TITULO -->

<div class="mb-4">

<h2 class="fw-bold">
🏦 Nuevo Préstamo
</h2>

<p class="text-muted">
Registro de préstamos para asociados activos.
</p>

</div>

<!-- FORMULARIO -->

<form action="guardar.php" method="POST">

<!-- ASOCIADO -->

<div class="mb-3">

<label class="form-label fw-semibold">
Asociado
</label>

<select 
name="asociado_id"
class="form-select"
required>

<option value="">
Seleccione un asociado
</option>

<?php while($a = mysqli_fetch_assoc($asociados)){ ?>

<option value="<?php echo $a['id']; ?>">

<?php
echo $a['nombres'] . " " . $a['apellidos'];
?>

</option>

<?php } ?>

</select>

</div>

<!-- MONTO -->

<div class="mb-3">

<label class="form-label fw-semibold">
Monto del préstamo
</label>

<div class="input-group">

<span class="input-group-text">
$
</span>

<input 
type="number"
name="monto"
class="form-control"
placeholder="Ingrese el monto"
required>

</div>

</div>

<!-- INTERES -->

<div class="mb-3">

<label class="form-label fw-semibold">
Interés (%)
</label>

<div class="input-group">

<input 
type="number"
name="interes"
class="form-control"
value="10"
required>

<span class="input-group-text">
%
</span>

</div>

</div>

<!-- CUOTAS -->

<div class="mb-4">

<label class="form-label fw-semibold">
Número de cuotas
</label>

<input 
type="number"
name="cuotas"
class="form-control"
placeholder="Ingrese cantidad de cuotas"
required>

</div>

<!-- BOTONES -->

<div class="d-flex gap-2">

<button class="btn btn-success">

<i class="bi bi-check-circle"></i>
 Guardar Préstamo

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