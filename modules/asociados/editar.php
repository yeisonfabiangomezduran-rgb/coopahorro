<?php

include("../../config/conexion.php");

$id = $_GET['id'];

$sql = "SELECT * FROM asociados WHERE id='$id'";

$resultado = mysqli_query($conn, $sql);

$asociado = mysqli_fetch_assoc($resultado);

?>

<!DOCTYPE html>
<html lang="es">

<head>

<meta charset="UTF-8">

<title>Editar Asociado</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body class="bg-light">

<?php include("../../layouts/sidebar.php"); ?>

<div style="margin-left:260px; padding:20px;">

<div class="card shadow border-0">

<div class="card-body">

<h2 class="mb-4">
Editar Asociado
</h2>

<form action="actualizar.php" method="POST">

<input 
type="hidden"
name="id"
value="<?php echo $asociado['id']; ?>">

<div class="row">

<div class="col-md-6 mb-3">

<label>Nombres</label>

<input 
type="text"
name="nombres"
class="form-control"
value="<?php echo $asociado['nombres']; ?>">

</div>

<div class="col-md-6 mb-3">

<label>Apellidos</label>

<input 
type="text"
name="apellidos"
class="form-control"
value="<?php echo $asociado['apellidos']; ?>">

</div>

<div class="col-md-6 mb-3">

<label>Cédula</label>

<input 
type="text"
name="cedula"
class="form-control"
value="<?php echo $asociado['cedula']; ?>">

</div>

<div class="col-md-6 mb-3">

<label>Teléfono</label>

<input 
type="text"
name="telefono"
class="form-control"
value="<?php echo $asociado['telefono']; ?>">

</div>

<div class="col-md-6 mb-3">

<label>Correo</label>

<input 
type="email"
name="correo"
class="form-control"
value="<?php echo $asociado['correo']; ?>">

</div>

</div>

<button class="btn btn-primary">
Actualizar
</button>

</form>

</div>

</div>

</div>

</body>

</html>