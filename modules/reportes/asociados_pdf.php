<?php
date_default_timezone_set('America/Bogota');
require('../../fpdf186/fpdf.php');

include("../../config/conexion.php");

$sql = "SELECT * FROM asociados";

$resultado = mysqli_query($conn, $sql);

$pdf = new FPDF();

$pdf->AddPage();

# LOGO
$pdf->Image(__DIR__ . '/../../assets/img/logo.png', 10, 10, 40);

# TITULO

$pdf->SetFont('Arial','B',20);

$pdf->Cell(190,15,
utf8_decode('COOPAHORRO'),
0,1,'C');

$pdf->SetFont('Arial','B',16);

$pdf->Cell(190,10,
utf8_decode('Reporte de Asociados'),
0,1,'C');

$pdf->Ln(10);
$pdf->SetFont('Arial','',10);

$pdf->Cell(
190,
8,
utf8_decode('Fecha: ' . date('d/m/Y')),
0,
1,
'R'
);

$pdf->Ln(5);
while($fila = mysqli_fetch_assoc($resultado)){

    // Posición inicial
    $y = $pdf->GetY();

    // Caja gris
    $pdf->SetFillColor(240,240,240);

    $pdf->Rect(10, $y, 190, 50, 'F');

    // Margen interno
    $pdf->SetXY(15, $y + 3);

    // ID
    $pdf->SetFont('Arial','B',11);
    $pdf->Cell(30,8,'ID:',0,0);

    $pdf->SetFont('Arial','',11);
    $pdf->Cell(100,8,$fila['id'],0,1);

    // Nombre
    $pdf->SetX(15);

    $pdf->SetFont('Arial','B',11);
    $pdf->Cell(30,8,'Nombre:',0,0);

    $pdf->SetFont('Arial','',11);
    $pdf->Cell(100,8,utf8_decode($fila['nombres']),0,1);

    // Apellido
    $pdf->SetX(15);

    $pdf->SetFont('Arial','B',11);
    $pdf->Cell(30,8,'Apellido:',0,0);

    $pdf->SetFont('Arial','',11);
    $pdf->Cell(100,8,utf8_decode($fila['apellidos']),0,1);

    // Cedula
    $pdf->SetX(15);

    $pdf->SetFont('Arial','B',11);
    $pdf->Cell(30,8,utf8_decode('Cédula:'),0,0);

    $pdf->SetFont('Arial','',11);
    $pdf->Cell(100,8,$fila['cedula'],0,1);

    // Telefono
    $pdf->SetX(15);

    $pdf->SetFont('Arial','B',11);
    $pdf->Cell(30,8,utf8_decode('Teléfono:'),0,0);

    $pdf->SetFont('Arial','',11);
    $pdf->Cell(100,8,$fila['telefono'],0,1);

    // Correo
    $pdf->SetX(15);

    $pdf->SetFont('Arial','B',11);
    $pdf->Cell(30,8,'Correo:',0,0);

    $pdf->SetFont('Arial','',10);

    $pdf->MultiCell(
        140,
        8,
        utf8_decode($fila['correo']),
        0
    );

    // Espacio entre registros
    $pdf->Ln(6);

    // Salto automático de página
    if($pdf->GetY() > 240){
        $pdf->AddPage();
    }
}



$pdf->Output();

?>