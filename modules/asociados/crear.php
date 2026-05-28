<?php

session_start();

if(!isset($_SESSION['usuario'])){
    header("Location: ../../auth/login.php");
    exit();
}

?>

<!DOCTYPE html>
<html lang="es">

<head>

<meta charset="UTF-8">

<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Nuevo Asociado | CoopAhorro</title>

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

<div class="col-lg-10">

<div class="card border-0">

<div class="card-body p-4">

<!-- TITULO -->

<div class="mb-4">

<h2 class="fw-bold">
👥 Nuevo Asociado
</h2>

<p class="text-muted">
Registro de nuevos asociados en CoopAhorro.
</p>

</div>

<!-- FORMULARIO -->

<form action="/coopahorro/modules/asociados/guardar.php" method="POST">

<div class="row">

<!-- NOMBRES -->

<div class="col-md-6 mb-3">

<label class="form-label fw-semibold">
Nombres
</label>

<input 
type="text"
name="nombres"
class="form-control"
placeholder="Ingrese nombres"
required>

</div>

<!-- APELLIDOS -->

<div class="col-md-6 mb-3">

<label class="form-label fw-semibold">
Apellidos
</label>

<input 
type="text"
name="apellidos"
class="form-control"
placeholder="Ingrese apellidos"
required>

</div>

<!-- CÉDULA -->

<div class="col-md-6 mb-3">

<label class="form-label fw-semibold">
Cédula
</label>

<input 
type="text"
name="cedula"
class="form-control"
placeholder="Ingrese cédula"
required>

</div>

<!-- TELÉFONO -->

<div class="col-md-6 mb-3">

<label class="form-label fw-semibold">
Teléfono
</label>

<input 
type="text"
name="telefono"
class="form-control"
placeholder="Ingrese teléfono">

</div>

<!-- DIRECCIÓN -->

<div class="col-md-6 mb-3">

<label class="form-label fw-semibold">
Dirección
</label>

<input 
type="text"
name="direccion"
class="form-control"
placeholder="Ingrese dirección">

</div>

<!-- CORREO -->

<div class="col-md-6 mb-3">

<label class="form-label fw-semibold">
Correo electrónico
</label>

<input 
type="email"
name="correo"
class="form-control"
placeholder="Ingrese correo">

</div>

</div>

<!-- BOTONES -->

<div class="d-flex gap-2 mt-3">

<button class="btn btn-success">

<i class="bi bi-check-circle"></i>
 Guardar Asociado

</button>

<a href="/coopahorro/modules/asociados/"
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