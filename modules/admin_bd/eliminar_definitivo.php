<?php

session_start();

include("../../config/conexion.php");

if(!isset($_SESSION['admin_bd'])){

    header("Location:index.php");
    exit();

}

$sql = "SELECT *

FROM asociados

WHERE estado='inactivo'

ORDER BY id DESC";

$resultado = mysqli_query($conn, $sql);

?>

<!DOCTYPE html>
<html lang="es">

<head>

<meta charset="UTF-8">

<meta name="viewport"
content="width=device-width, initial-scale=1.0">

<title>Eliminación Definitiva</title>

<!-- BOOTSTRAP -->

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
rel="stylesheet">

<!-- CSS -->

<link rel="stylesheet"
href="../../assets/css/dashboard.css">

<!-- ICONOS -->

<link rel="stylesheet"
href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

</head>

<body>

<!-- SIDEBAR -->

<?php include("../../layouts/sidebar.php"); ?>

<!-- CONTENIDO -->

<div class="main-content">

<!-- TITULO -->

<div class="mb-4">

<h2 class="fw-bold text-danger">

<i class="bi bi-exclamation-triangle-fill"></i>
 Eliminación Definitiva

</h2>

<p class="text-muted">
Gestión avanzada de eliminación permanente.
</p>

</div>

<!-- ALERTA -->

<div class="alert alert-danger border-0 rounded-4 mb-4">

<i class="bi bi-exclamation-octagon-fill"></i>

Esta acción eliminará permanentemente
el asociado y todos sus registros.

</div>

<!-- TABLA -->

<div class="card border-0 shadow-sm">

<div class="card-body">

<div class="table-responsive">

<table class="custom-table">

<thead>

<tr>

<th>ID</th>
<th>Nombre</th>
<th>Cédula</th>
<th>Estado</th>
<th>Acción</th>

</tr>

</thead>

<tbody>

<?php while($fila = mysqli_fetch_assoc($resultado)){ ?>

<tr>

<!-- ID -->

<td>

<?php echo $fila['id']; ?>

</td>

<!-- NOMBRE -->

<td>

<?php
echo $fila['nombres']." ".
$fila['apellidos'];
?>

</td>

<!-- CEDULA -->

<td>

<?php echo $fila['cedula']; ?>

</td>

<!-- ESTADO -->

<td>

<span class="badge bg-secondary">
Inactivo
</span>

</td>

<!-- ACCIONES -->

<td>

<button
class="btn btn-danger btn-sm"

onclick="confirmarEliminacion(
<?php echo $fila['id']; ?>
)">

<i class="bi bi-trash"></i>
 Eliminar

</button>

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

<!-- CONFIRMAR -->

<script>

function confirmarEliminacion(id){

    Swal.fire({

        title: '¿Eliminar definitivamente?',

        text: 'Esta acción eliminará TODOS los datos del asociado.',

        icon: 'warning',

        showCancelButton: true,

        confirmButtonColor: '#dc3545',

        cancelButtonColor: '#6c757d',

        confirmButtonText: 'Sí, eliminar',

        cancelButtonText: 'Cancelar'

    }).then((result) => {

        if(result.isConfirmed){

            window.location.href =
            'procesar_eliminacion.php?id=' + id;

        }

    });

}

</script>

</body>

</html>