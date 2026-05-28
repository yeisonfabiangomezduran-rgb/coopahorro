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

<title>Gestión Avanzada</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
rel="stylesheet">

<link rel="stylesheet"
href="../../assets/css/dashboard.css">

</head>

<body>

<?php include("../../layouts/sidebar.php"); ?>

<div class="main-content">

<div class="row justify-content-center">

<div class="col-lg-5">

<div class="card border-0 shadow-sm">

<div class="card-body p-4">

<h2 class="fw-bold text-danger mb-3">
⚠️ Gestión Avanzada BD
</h2>

<p class="text-muted mb-4">
Confirma tus credenciales para continuar.
</p>

<form action="verificar.php" method="POST">

<div class="mb-3">

<label>
Usuario
</label>

<input
type="text"
name="usuario"
class="form-control"
required>

</div>

<div class="mb-4">

<label>
Contraseña
</label>

<input
type="password"
name="password"
class="form-control"
required>

</div>

<button class="btn btn-danger w-100">

Ingresar

</button>

</form>

</div>

</div>

</div>

</div>

</div>

</body>

</html>