<?php

session_start();

if(!isset($_SESSION['usuario'])){
    header("Location: ../../auth/login.php");
    exit();
}

include("../../config/conexion.php");

$id = $_GET['id'];

# =========================
# VALIDAR CUENTA ACTIVA
# =========================

$sql = "SELECT 

ahorros.*,
asociados.nombres,
asociados.apellidos,
asociados.estado

FROM ahorros

INNER JOIN asociados
ON ahorros.asociado_id = asociados.id

WHERE ahorros.id='$id'

AND asociados.estado='activo'";

$resultado = mysqli_query($conn, $sql);

# =========================
# VALIDAR RESULTADO
# =========================

if(mysqli_num_rows($resultado) == 0){

    header("Location: index.php?error=inactivo");
    exit();
}

$cuenta = mysqli_fetch_assoc($resultado);

?>

<!DOCTYPE html>
<html lang="es">

<head>

<meta charset="UTF-8">

<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Depositar | CoopAhorro</title>

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

<h2 class="fw-bold mb-4">
💰 Realizar Depósito
</h2>

<!-- INFO CUENTA -->

<div class="alert alert-info border-0 rounded-4">

<p class="mb-2">

<strong>Asociado:</strong>

<?php
echo $cuenta['nombres'] . " " . $cuenta['apellidos'];
?>

</p>

<p class="mb-0">

<strong>Saldo actual:</strong>

$ <?php echo number_format($cuenta['saldo']); ?>

</p>

</div>

<!-- FORMULARIO -->

<form action="guardar_deposito.php" method="POST">

<input 
type="hidden"
name="id"
value="<?php echo $cuenta['id']; ?>">

<input 
type="hidden"
name="asociado_id"
value="<?php echo $cuenta['asociado_id']; ?>">

<!-- VALOR -->

<div class="mb-3">

<label class="form-label fw-semibold">
Valor a depositar
</label>

<input 
type="number"
name="valor"
class="form-control"
placeholder="Ingrese el valor"
required>

</div>

<!-- DESCRIPCIÓN -->

<div class="mb-4">

<label class="form-label fw-semibold">
Descripción
</label>

<textarea 
name="descripcion"
class="form-control"
rows="4"
placeholder="Descripción del depósito"></textarea>

</div>

<!-- BOTONES -->

<div class="d-flex gap-2">

<button class="btn btn-success">

<i class="bi bi-check-circle"></i>
 Guardar Depósito

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

<!-- SWEET ALERT -->

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<!-- ERROR -->

<?php if(isset($_GET['error']) && $_GET['error'] == 'inactivo'){ ?>

<script>

Swal.fire({

    icon: 'error',

    title: 'Operación bloqueada',

    text: 'El asociado se encuentra inactivo.'

});

</script>

<?php } ?>

</body>

</html>