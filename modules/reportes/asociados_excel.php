<?php

include("../../config/conexion.php");

# =========================
# HEADERS EXCEL
# =========================

header("Content-Type: application/vnd.ms-excel");

header(
"Content-Disposition: attachment; filename=asociados.xls"
);

# =========================
# CONSULTA
# =========================

$sql = "SELECT * FROM asociados";

$resultado = mysqli_query($conn,$sql);

?>

<table border="1">

<tr style="background:#198754; color:white;">

<th>ID</th>
<th>Nombres</th>
<th>Apellidos</th>
<th>Cedula</th>
<th>Telefono</th>
<th>Correo</th>

</tr>

<?php while($row = mysqli_fetch_assoc($resultado)){ ?>

<tr>

<td><?php echo $row['id']; ?></td>

<td><?php echo $row['nombres']; ?></td>

<td><?php echo $row['apellidos']; ?></td>

<td><?php echo $row['cedula']; ?></td>

<td><?php echo $row['telefono']; ?></td>

<td><?php echo $row['correo']; ?></td>

</tr>

<?php } ?>

</table>