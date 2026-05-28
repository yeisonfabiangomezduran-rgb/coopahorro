<?php

require('../../fpdf186/fpdf.php');
include("../../config/conexion.php");

$id = $_GET['id'];

$sql = "SELECT 
movimientos.*, 
asociados.nombres,
asociados.apellidos

FROM movimientos

INNER JOIN asociados 
ON movimientos.asociado_id = asociados.id

WHERE movimientos.id = '$id'";

$resultado = mysqli_query($conn, $sql);

$data = mysqli_fetch_assoc($resultado);

# =========================
# FECHA FORMATO
# =========================

$fecha = date(
'd/m/Y h:i A',
strtotime($data['fecha'])
);

# =========================
# NUMERO RECIBO
# =========================

$recibo = 'REC-'.str_pad(
$data['id'],
6,
'0',
STR_PAD_LEFT
);

# =========================
# PDF
# =========================

$pdf = new FPDF();
$pdf->AddPage();

# =========================
# COLOR VERDE
# =========================

$pdf->SetDrawColor(34,139,34);

# =========================
# LOGO
# =========================

$pdf->Image(
__DIR__ . '/../../assets/img/logo.png',
10,
10,
40
);

# =========================
# TITULO
# =========================

$pdf->Ln(25);

$pdf->SetFont('Arial','B',24);

$pdf->SetTextColor(0,100,0);

$pdf->Cell(
190,
15,
utf8_decode('RECIBO DE DEPOSITO'),
0,
1,
'C'
);

# LINEA TITULO

$pdf->Line(70,50,140,50);

$pdf->Ln(20);

# =========================
# DATOS
# =========================

$pdf->SetTextColor(0,0,0);

# RECIBO
$pdf->SetFont('Arial','B',14);

$pdf->Cell(50,12,'Recibo #:');

$pdf->SetFont('Arial','',14);

$pdf->Cell(
100,
12,
$recibo,
0,
1
);

# FECHA
$pdf->SetFont('Arial','B',14);

$pdf->Cell(50,12,'Fecha:');

$pdf->SetFont('Arial','',14);

$pdf->Cell(
100,
12,
$fecha,
0,
1
);

# ASOCIADO
$pdf->SetFont('Arial','B',14);

$pdf->Cell(50,12,'Asociado:');

$pdf->SetFont('Arial','',14);

$pdf->Cell(
100,
12,
utf8_decode(
$data['nombres'].' '.$data['apellidos']
),
0,
1
);

# TIPO
$pdf->SetFont('Arial','B',14);

$pdf->Cell(50,12,'Tipo:');

$pdf->SetFont('Arial','',14);

$pdf->Cell(
100,
12,
utf8_decode($data['tipo']),
0,
1
);

# VALOR
$pdf->SetFont('Arial','B',14);

$pdf->Cell(50,12,'Valor:');

$pdf->SetFont('Arial','',14);

$pdf->Cell(
100,
12,
'$ '.number_format($data['valor']),
0,
1
);

# DESCRIPCION
$pdf->SetFont('Arial','B',14);

$pdf->Cell(
50,
12,
utf8_decode('Descripcion:')
);

$pdf->SetFont('Arial','',14);

$pdf->Cell(
100,
12,
utf8_decode($data['descripcion']),
0,
1
);

# =========================
# MENSAJE
# =========================

$pdf->Ln(40);

$pdf->SetFont('Arial','B',16);

$pdf->SetTextColor(0,100,0);

$pdf->Cell(
190,
10,
utf8_decode(
'Gracias por confiar en COOPAHORRO'
),
0,
1,
'C'
);

# =========================
# FIRMA
# =========================

$pdf->Ln(30);

# MOVER IZQUIERDA
$pdf->SetX(20);

# LINEA FIRMA
$pdf->SetTextColor(0,0,0);

$pdf->Cell(
70,
10,
'________________________',
0,
1,
'C'
);

# TEXTO FIRMA
$pdf->SetX(20);

$pdf->SetFont('Arial','B',12);

$pdf->Cell(
70,
8,
utf8_decode('Firma autorizada'),
0,
1,
'C'
);

# =========================
# LINEA FOOTER
# =========================

$pdf->Line(10,262,200,262);

# =========================
# FOOTER
# =========================

$pdf->SetY(266);

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

if(isset($pdf_file)){

    $pdf->Output('F', $pdf_file);

}else{

    $pdf->Output();
}

?>