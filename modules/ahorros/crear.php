<?php

session_start();

if(!isset($_SESSION['usuario'])){
    header("Location: ../../auth/login.php");
    exit();
}

include("../../config/conexion.php");

# =========================
# SOLO ASOCIADOS ACTIVOS
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

<title>Nueva Cuenta | CoopAhorro</title>

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
💰 Nueva Cuenta de Ahorro
</h2>

<p class="text-muted">
Creación de cuentas de ahorro para asociados activos.
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

<?php echo $a['nombres'] . " " . $a['apellidos']; ?>

</option>

<?php } ?>

</select>

</div>

<!-- TIPO -->

<div class="mb-4">

<label class="form-label fw-semibold">
Tipo de ahorro
</label>

<select 
name="tipo"
class="form-select">

<option value="vista">
Ahorro a la vista
</option>

<option value="programado">
Ahorro programado
</option>

<option value="navideno">
Ahorro navideño
</option>

</select>

</div>

<!-- BOTONES -->

<div class="d-flex gap-2">

<button class="btn btn-success">

<i class="bi bi-check-circle"></i>
 Crear Cuenta

</button>

<a href="/coopahorro/modules/ahorros/"
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