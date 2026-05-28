<?php

session_start();

if(!isset($_SESSION['usuario'])){
    header("Location: ../../auth/login.php");
    exit();
}

include("../../config/conexion.php");

# =========================
# CONSULTAR ACTIVOS
# =========================

$sql = "SELECT * FROM asociados

WHERE estado='activo'

ORDER BY id DESC";

$resultado = mysqli_query($conn, $sql);

?>

<!DOCTYPE html>
<html lang="es">

<head>

<meta charset="UTF-8">

<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Asociados | CoopAhorro</title>

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
👥 Módulo de Asociados
</h2>

<p class="text-muted">
Gestión de asociados activos.
</p>

</div>

<div class="d-flex gap-2 flex-wrap">

<!-- PDF -->

<a 
href="/coopahorro/modules/reportes/asociados_pdf.php"
class="btn btn-danger">

<i class="bi bi-file-earmark-pdf"></i>
 PDF

</a>

<!-- NUEVO -->

<a href="crear.php" class="btn btn-success">

<i class="bi bi-plus-circle"></i>
 Nuevo Asociado

</a>

<!-- INACTIVOS -->

<a href="inactivos.php" class="btn btn-secondary">

<i class="bi bi-person-x"></i>
 Asociados Inactivos

</a>

</div>

</div>

<!-- TABLA -->

<div class="card border-0">

<div class="card-body">

<div class="table-responsive">

<table class="custom-table">

<thead>

<tr>

<th>ID</th>
<th>Nombres</th>
<th>Apellidos</th>
<th>Cédula</th>
<th>Teléfono</th>
<th>Correo</th>
<th>Estado</th>

<th class="text-center">
Acciones
</th>

</tr>

</thead>

<tbody>

<?php while($fila = mysqli_fetch_assoc($resultado)){ ?>

<tr>

<!-- ID -->

<td>

<?php echo $fila['id']; ?>

</td>

<!-- NOMBRES -->

<td>

<?php echo $fila['nombres']; ?>

</td>

<!-- APELLIDOS -->

<td>

<?php echo $fila['apellidos']; ?>

</td>

<!-- CÉDULA -->

<td>

<?php echo $fila['cedula']; ?>

</td>

<!-- TELÉFONO -->

<td>

<?php echo $fila['telefono']; ?>

</td>

<!-- CORREO -->

<td class="correo-columna">

<?php echo $fila['correo']; ?>

</td>

<!-- ESTADO -->

<td>

<span class="badge bg-success">
Activo
</span>

</td>

<!-- ACCIONES -->

<td class="text-center acciones-tabla">

<div class="d-flex justify-content-center gap-2">

<!-- EDITAR -->

<a 
href="editar.php?id=<?php echo $fila['id']; ?>" 
class="btn btn-primary btn-sm">

<i class="bi bi-pencil-square"></i>
 Editar

</a>

<!-- INACTIVAR -->

<button 
class="btn btn-warning btn-sm"
onclick="cambiarEstado(<?php echo $fila['id']; ?>,'inactivar')">

<i class="bi bi-person-x"></i>
 Inactivar

</button>

</div>

</td>

</tr>

<?php } ?>

</tbody>

</table>

</div>

</div>

</div>

</div>

<!-- SWEET ALERT -->

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<!-- CAMBIAR ESTADO -->

<script>

function cambiarEstado(id,accion){

    Swal.fire({

        title: '¿Inactivar asociado?',

        text: 'El asociado no podrá realizar operaciones.',

        icon: 'warning',

        showCancelButton: true,

        confirmButtonColor: '#f59e0b',

        cancelButtonColor: '#6b7280',

        confirmButtonText: 'Sí, inactivar',

        cancelButtonText: 'Cancelar'

    }).then((result) => {

        if(result.isConfirmed){

            window.location.href =
            'estado.php?id=' + id + '&accion=' + accion;
        }

    });

}

</script>

<!-- ERROR PRÉSTAMO -->

<?php if(isset($_GET['error']) && $_GET['error'] == 'prestamo'){ ?>

<script>

Swal.fire({

    icon: 'error',

    title: 'Acción bloqueada',

    text: 'No puedes inactivar un asociado con préstamos activos.'

});

</script>

<?php } ?>

<!-- ÉXITO -->

<?php if(isset($_GET['success'])){ ?>

<script>

Swal.fire({

    icon: 'success',

    title: 'Proceso exitoso',

    text: 'El estado del asociado fue actualizado correctamente.',

    timer: 2000,

    showConfirmButton: false

});

</script>

<?php } ?>

</body>

</html>