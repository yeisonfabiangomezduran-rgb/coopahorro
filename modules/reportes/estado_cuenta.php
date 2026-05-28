<?php

require('../../fpdf186/fpdf.php');

include("../../config/conexion.php");

$asociado_id = $_GET['id'];

# =========================
# DATOS ASOCIADO
# =========================

$sql_asociado = "SELECT * FROM asociados
WHERE id = '$asociado_id'";

$resultado_asociado = mysqli_query(
$conn,
$sql_asociado
);

$asociado = mysqli_fetch_assoc(
$resultado_asociado
);

# =========================
# MOVIMIENTOS
# =========================

$sql_movimientos = "SELECT * FROM movimientos
WHERE asociado_id = '$asociado_id'
ORDER BY fecha DESC";

$resultado_movimientos = mysqli_query(
$conn,
$sql_movimientos
);

# =========================
# PDF
# =========================

$pdf = new FPDF();

$pdf->AddPage();

# =========================
# LOGO
# =========================

$pdf->Image(
__DIR__ . '/../../assets/img/logo.png',
10,
10,
35
);

# =========================
# TITULO
# =========================

$pdf->SetFont('Arial','B',22);

$pdf->SetTextColor(0,100,0);

$pdf->Cell(
190,
20,
utf8_decode('ESTADO DE CUENTA'),
0,
1,
'C'
);

$pdf->Ln(10);

# =========================
# DATOS ASOCIADO
# =========================

$pdf->SetTextColor(0,0,0);

$pdf->SetFont('Arial','B',13);

$pdf->Cell(45,10,'Asociado:');

$pdf->SetFont('Arial','',13);

$pdf->Cell(
100,
10,
utf8_decode(
$asociado['nombres'].' '.$asociado['apellidos']
),
0,
1
);

$pdf->SetFont('Arial','B',13);

$pdf->Cell(45,10,'Cedula:');

$pdf->SetFont('Arial','',13);

$pdf->Cell(
100,
10,
$asociado['cedula'],
0,
1
);

$pdf->SetFont('Arial','B',13);

$pdf->Cell(45,10,'Telefono:');

$pdf->SetFont('Arial','',13);

$pdf->Cell(
100,
10,
$asociado['telefono'],
0,
1
);

$pdf->Ln(10);

# =========================
# TABLA
# =========================

$pdf->SetFillColor(34,139,34);

$pdf->SetTextColor(255,255,255);

$pdf->SetFont('Arial','B',12);

$pdf->Cell(50,10,'Fecha',1,0,'C',true);

$pdf->Cell(50,10,'Tipo',1,0,'C',true);

$pdf->Cell(90,10,'Valor',1,1,'C',true);

# =========================
# DATOS TABLA
# =========================

$pdf->SetTextColor(0,0,0);

$pdf->SetFont('Arial','',11);

$total = 0;

while($mov = mysqli_fetch_assoc($resultado_movimientos)){

    $fecha = date(
    'd/m/Y',
    strtotime($mov['fecha'])
    );

    $pdf->Cell(
    50,
    10,
    $fecha,
    1,
    0,
    'C'
    );

    $pdf->Cell(
    50,
    10,
    utf8_decode($mov['tipo']),
    1,
    0,
    'C'
    );

    $pdf->Cell(
    90,
    10,
    '$ '.number_format($mov['valor']),
    1,
    1,
    'C'
    );

    $total += $mov['valor'];
}

# =========================
# TOTAL
# =========================

$pdf->SetFont('Arial','B',14);

$pdf->Ln(10);

$pdf->Cell(
100,
10,
'SALDO TOTAL:',
0,
0
);

$pdf->Cell(
50,
10,
'$ '.number_format($total),
0,
1
);

# =========================
# FOOTER
# =========================

$pdf->Line(10,250,200,250);

$pdf->SetY(252);

$pdf->SetFont('Arial','',10);

$pdf->Cell(
60,
10,
utf8_decode('La Union - Narino'),
0,
0,
'C'
);

$pdf->Cell(
60,
10,
'Tel: 316 123 4567',
0,
0,
'C'
);

$pdf->Cell(
60,
10,
'www.coopahorro.com',
0,
1,
'C'
);

# =========================
# OUTPUT
# =========================

$pdf->Output();

?>