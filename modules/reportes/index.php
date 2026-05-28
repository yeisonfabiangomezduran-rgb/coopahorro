<?php

include("../../config/conexion.php");

$asociados = mysqli_query(
$conn,
"SELECT * FROM asociados
WHERE estado='activo'"
);

?>

<!DOCTYPE html>
<html lang="es">

<head>

<meta charset="UTF-8">

<meta name="viewport"
content="width=device-width, initial-scale=1.0">

<title>Reportes | CoopAhorro</title>

<!-- BOOTSTRAP -->

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
rel="stylesheet">

<!-- CSS -->

<link rel="stylesheet"
href="../../assets/css/dashboard.css">

<!-- ICONOS -->

<link rel="stylesheet"
href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

<style>

/* =========================
   CONTENEDOR
========================= */

.container-reportes{

    margin-left:260px;

    padding:35px;
}

/* =========================
   HEADER
========================= */

.report-header{

    margin-bottom:40px;
}

.report-header h1{

    font-size:30px;

    font-weight:800;

    color:#111827;

    margin-bottom:10px;

    letter-spacing:-1px;
}

.report-header p{

    color:#6b7280;

    font-size:18px;

    margin:0;
}

/* =========================
   TARJETAS
========================= */

.report-card{

    background:#ffffff;

    border-radius:28px;

    padding:40px;

    margin-bottom:35px;

    border:1px solid #e5e7eb;

    box-shadow:
    0 10px 30px rgba(0,0,0,.04);
}

/* =========================
   CONTENIDO CARD
========================= */

.report-content{

    display:flex;

    justify-content:space-between;

    align-items:center;

    gap:30px;
}

/* =========================
   ICONOS
========================= */

.report-icon{

    width:90px;

    height:90px;

    border-radius:24px;

    background:#f3f4f6;

    display:flex;

    align-items:center;

    justify-content:center;

    font-size:40px;

    color:#111827;

    flex-shrink:0;
}

/* =========================
   TITULOS
========================= */

.report-title{

    font-size:22px;

    font-weight:700;

    color:#111827;

    margin-bottom:10px;
}

.report-text{

    color:#6b7280;

    font-size:17px;

    line-height:1.7;

    max-width:650px;
}

/* =========================
   BOTONES
========================= */

.report-buttons{

    display:flex;

    gap:18px;

    margin-top:30px;

    flex-wrap:wrap;
}

.btn-report{

    background:#111827;

    color:white;

    border:none;

    padding:16px 28px;

    border-radius:16px;

    text-decoration:none;

    display:inline-flex;

    align-items:center;

    gap:10px;

    font-weight:600;

    transition:.3s ease;
}

.btn-report:hover{

    background:#000000;

    color:white;

    transform:translateY(-2px);
}

/* =========================
   ILUSTRACIONES
========================= */

.report-illustration{

    font-size:120px;

    color:#e5e7eb;
}

/* =========================
   FORMULARIOS
========================= */

.form-label{

    font-weight:600;

    color:#111827;

    margin-bottom:12px;
}

.form-select{

    border-radius:18px;

    border:1px solid #d1d5db;

    padding:18px;

    font-size:16px;

    box-shadow:none;
}

.form-select:focus{

    border-color:#111827;

    box-shadow:none;
}

/* =========================
   RESPONSIVE
========================= */

@media(max-width:992px){

.report-content{

    flex-direction:column;

    align-items:flex-start;
}

.report-illustration{

    display:none;
}

.container-reportes{

    margin-left:0;

    padding:20px;
}

.report-header h1{

    font-size:34px;
}

}

</style>

</head>

<body>

<!-- SIDEBAR -->

<?php include("../../layouts/sidebar.php"); ?>

<!-- CONTENIDO -->

<div class="container-reportes">

<!-- HEADER -->

<div class="report-header">

<h1>

<i class="bi bi-file-earmark-bar-graph"></i>
 Reportes COOPAHORRO

</h1>

<p>
Genera y exporta reportes del sistema
</p>

</div>

<!-- =========================
     REPORTE GENERAL
========================= -->

<div class="report-card">

<div class="report-content">

<div>

<div class="d-flex align-items-center gap-4 mb-4">

<div class="report-icon">

<i class="bi bi-people-fill"></i>

</div>

<div>

<h2 class="report-title">
Reporte General de Asociados
</h2>

<p class="report-text">

Obtén un listado completo de todos los asociados registrados en el sistema.

</p>

</div>

</div>

<div class="report-buttons">

<a
href="asociados_pdf.php"
target="_blank"
class="btn-report">

<i class="bi bi-file-earmark-pdf"></i>
 Generar PDF

</a>

<a
href="asociados_excel.php"
class="btn-report">

<i class="bi bi-file-earmark-excel"></i>
 Exportar Excel

</a>

</div>

</div>

<div class="report-illustration">

<i class="bi bi-file-earmark-bar-graph"></i>

</div>

</div>

</div>

<!-- =========================
     RESUMEN FINANCIERO
========================= -->

<div class="report-card">

<div class="report-content">

<div>

<div class="d-flex align-items-center gap-4 mb-4">

<div class="report-icon">

<i class="bi bi-bar-chart-line"></i>

</div>

<div>

<h2 class="report-title">
Resumen Financiero Mensual
</h2>

<p class="report-text">

Consulta los indicadores financieros más importantes del mes actual.

</p>

</div>

</div>

<div class="report-buttons">

<!-- VER RESUMEN -->

<a
href="resumen_mensual.php"
class="btn-report">

<i class="bi bi-graph-up-arrow"></i>
 Ver Resumen

</a>

<!-- GENERAR PDF -->

<a
href="resumen_mensual_pdf.php"
target="_blank"
class="btn-report">

<i class="bi bi-file-earmark-pdf"></i>
 Generar PDF

</a>

</div>

</div>

<div class="report-illustration">

<i class="bi bi-graph-up"></i>

</div>

</div>

</div>

<!-- =========================
     ESTADO DE CUENTA
========================= -->

<div class="report-card">

<div class="report-content">

<div style="width:100%;">

<div class="d-flex align-items-center gap-4 mb-4">

<div class="report-icon">

<i class="bi bi-receipt"></i>

</div>

<div>

<h2 class="report-title">
Estado de Cuenta
</h2>

<p class="report-text">

Consulta el estado de cuenta detallado de un asociado.

</p>

</div>

</div>

<form action="estado_cuenta.php"
method="GET">

<div class="mb-4">

<label class="form-label">

Seleccione Asociado

</label>

<select
name="id"
class="form-select"
required>

<option value="">
Seleccione un asociado
</option>

<?php while($a = mysqli_fetch_assoc($asociados)){ ?>

<option value="<?php echo $a['id']; ?>">

<?php
echo $a['nombres'].' '.
$a['apellidos'];
?>

</option>

<?php } ?>

</select>

</div>

<button
class="btn-report"
type="submit">

<i class="bi bi-file-earmark-pdf"></i>
 Generar Estado de Cuenta

</button>

</form>

</div>

</div>

</div>

</div>

</body>

</html>