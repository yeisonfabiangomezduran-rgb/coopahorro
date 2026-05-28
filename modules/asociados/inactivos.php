<?php

session_start();

if(!isset($_SESSION['usuario'])){
    header("Location: ../../auth/login.php");
    exit();
}

include("../../config/conexion.php");

$sql = "SELECT * FROM asociados

WHERE estado='inactivo'

ORDER BY id DESC";

$resultado = mysqli_query($conn, $sql);

?>

<!DOCTYPE html>
<html lang="es">

<head>

<meta charset="UTF-8">

<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Asociados Inactivos | CoopAhorro</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<link rel="stylesheet" href="../../assets/css/dashboard.css">

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

</head>

<body>

<?php include("../../layouts/sidebar.php"); ?>

<div class="main-content">

<div class="d-flex justify-content-between align-items-center mb-4">

<div>

<h2 class="fw-bold">
🚫 Asociados Inactivos
</h2>

<p class="text-muted">
Asociados deshabilitados del sistema.
</p>

</div>

<a href="index.php" class="btn btn-primary">

<i class="bi bi-arrow-left"></i>
 Volver

</a>

</div>

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
<th>Estado</th>
<th>Acciones</th>

</tr>

</thead>

<tbody>

<?php while($fila = mysqli_fetch_assoc($resultado)){ ?>

<tr class="fila-inactiva">

<td><?php echo $fila['id']; ?></td>

<td><?php echo $fila['nombres']; ?></td>

<td><?php echo $fila['apellidos']; ?></td>

<td><?php echo $fila['cedula']; ?></td>

<td>

<span class="badge bg-secondary">
Inactivo
</span>

</td>

<td>

<button 
class="btn btn-success btn-sm"
onclick="cambiarEstado(<?php echo $fila['id']; ?>,'activar')">

<i class="bi bi-person-check"></i>
 Activar

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

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>

function cambiarEstado(id,accion){

    Swal.fire({

        title: '¿Activar asociado?',

        text: 'El asociado podrá operar nuevamente.',

        icon: 'question',

        showCancelButton: true,

        confirmButtonColor: '#10b981',

        cancelButtonColor: '#6b7280',

        confirmButtonText: 'Sí, activar',

        cancelButtonText: 'Cancelar'

    }).then((result) => {

        if(result.isConfirmed){

            window.location.href =
            'estado.php?id=' + id + '&accion=' + accion;
        }

    });

}

</script>

</body>

</html>