<?php
date_default_timezone_set('America/Bogota');

require('../../fpdf186/fpdf.php');

include("../../config/conexion.php");

/* =========================
   INGRESOS
========================= */

$ingresos = mysqli_query($conn,

"SELECT SUM(valor) total

FROM movimientos

WHERE tipo='deposito'

AND MONTH(fecha)=MONTH(CURDATE())

AND YEAR(fecha)=YEAR(CURDATE())");

$totalIngresos =
mysqli_fetch_assoc($ingresos)['total'];

/* =========================
   RETIROS
========================= */

$retiros = mysqli_query($conn,

"SELECT SUM(valor) total

FROM movimientos

WHERE tipo='retiro'

AND MONTH(fecha)=MONTH(CURDATE())

AND YEAR(fecha)=YEAR(CURDATE())");

$totalRetiros =
mysqli_fetch_assoc($retiros)['total'];

/* =========================
   PRESTAMOS
========================= */

$prestamos = mysqli_query($conn,

"SELECT SUM(monto) total

FROM prestamos

WHERE MONTH(fecha)=MONTH(CURDATE())

AND YEAR(fecha)=YEAR(CURDATE())");

$totalPrestamos =
mysqli_fetch_assoc($prestamos)['total'];

/* =========================
   NUEVOS ASOCIADOS
========================= */

$asociados = mysqli_query($conn,

"SELECT COUNT(*) total

FROM asociados

WHERE MONTH(fecha_registro)=MONTH(CURDATE())

AND YEAR(fecha_registro)=YEAR(CURDATE())");

$totalAsociados =
mysqli_fetch_assoc($asociados)['total'];

/* =========================
   CAPITAL ACTUAL
========================= */

$capital = mysqli_query($conn,

"SELECT SUM(saldo) total

FROM ahorros");

$totalCapital =
mysqli_fetch_assoc($capital)['total'];

/* =========================
   PDF
========================= */

$pdf = new FPDF();

$pdf->AddPage();

$pdf->SetTitle(
'Resumen Financiero Mensual'
);

/* =========================
   TITULO
========================= */

$pdf->SetFont('Arial','B',20);

$pdf->Cell(
0,
15,
utf8_decode('COOPAHORRO'),
0,
1,
'C'
);

$pdf->SetFont('Arial','',12);

$pdf->Cell(
0,
8,
utf8_decode('Resumen Financiero Mensual'),
0,
1,
'C'
);

$pdf->Ln(10);

/* =========================
   FECHA
========================= */

$pdf->SetFont('Arial','',11);

$pdf->Cell(
0,
8,
utf8_decode(
'Fecha de generación: '
.date('d/m/Y H:i')
),
0,
1
);

$pdf->Ln(5);

/* =========================
   TABLA
========================= */

$pdf->SetFillColor(17,24,39);

$pdf->SetTextColor(255,255,255);

$pdf->SetFont('Arial','B',12);

$pdf->Cell(100,12,'Indicador',1,0,'C',true);

$pdf->Cell(80,12,'Valor',1,1,'C',true);

/* =========================
   DATOS
========================= */

$pdf->SetTextColor(0,0,0);

$pdf->SetFont('Arial','',11);

$pdf->Cell(
100,
12,
utf8_decode('Ingresos del mes'),
1
);

$pdf->Cell(
80,
12,
'$ '.number_format($totalIngresos),
1,
1
);

$pdf->Cell(
100,
12,
utf8_decode('Retiros del mes'),
1
);

$pdf->Cell(
80,
12,
'$ '.number_format($totalRetiros),
1,
1
);

$pdf->Cell(
100,
12,
utf8_decode('Préstamos otorgados'),
1
);

$pdf->Cell(
80,
12,
'$ '.number_format($totalPrestamos),
1,
1
);

$pdf->Cell(
100,
12,
utf8_decode('Nuevos asociados'),
1
);

$pdf->Cell(
80,
12,
number_format($totalAsociados),
1,
1
);

$pdf->Cell(
100,
12,
utf8_decode('Capital actual'),
1
);

$pdf->Cell(
80,
12,
'$ '.number_format($totalCapital),
1,
1
);

$pdf->Ln(15);

/* =========================
   PIE
========================= */

$pdf->SetFont('Arial','I',10);

$pdf->Cell(
0,
10,
utf8_decode(
'Documento generado automáticamente por CoopAhorro'
),
0,
1,
'C'
);

$pdf->Output();

?>