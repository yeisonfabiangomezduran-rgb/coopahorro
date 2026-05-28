<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require __DIR__ . '/../../phpmailer/src/Exception.php';
require __DIR__ . '/../../phpmailer/src/PHPMailer.php';
require __DIR__ . '/../../phpmailer/src/SMTP.php';

include("../../config/conexion.php");

$id = $_GET['id'];

# =========================
# CONSULTA MOVIMIENTO
# =========================

$sql = "SELECT 
movimientos.*,
asociados.nombres,
asociados.apellidos,
asociados.correo

FROM movimientos

INNER JOIN asociados
ON movimientos.asociado_id = asociados.id

WHERE movimientos.id = '$id'";

$resultado = mysqli_query($conn, $sql);

$asociado = mysqli_fetch_assoc($resultado);

# =========================
# GENERAR PDF
# =========================

$pdf_file = "../../temp/recibo_$id.pdf";

include("recibo.php");

# =========================
# ENVIAR CORREO
# =========================

$mail = new PHPMailer(true);

try {

    # SMTP

    $mail->isSMTP();

    $mail->Host = 'smtp.gmail.com';

    $mail->SMTPAuth = true;

    $mail->Username = 'yeisonfabiangomezduran@gmail.com';

    $mail->Password = 'ixki ydxp yhmu oluk';

    $mail->SMTPSecure = 'tls';

    $mail->Port = 587;

    # =========================
    # REMITENTE
    # =========================

    $mail->setFrom(
        'yeisonfabiangomezduran@gmail.com',
        'COOPAHORRO'
    );

    # =========================
    # DESTINO
    # =========================

    $correo = trim(strtolower($asociado['correo']));

    $mail->addAddress($correo);

    # =========================
    # ADJUNTAR PDF
    # =========================

    $mail->addAttachment($pdf_file);

    # =========================
    # CONTENIDO
    # =========================

    $mail->isHTML(true);

    $mail->Subject = 'Recibo de deposito COOPAHORRO';

    $mail->Body = '

    <h2>Hola '.$asociado['nombres'].' '.$asociado['apellidos'].'</h2>

    <p>Adjuntamos su recibo de depósito.</p>

    <p>Gracias por confiar en COOPAHORRO.</p>

    ';

    # =========================
    # ENVIAR
    # =========================

    $mail->send();

    echo "
<script>
    alert('Correo enviado correctamente');
    window.location='../ahorros/movimientos.php';
</script>
";

} catch (Exception $e) {

    echo 'Error al enviar correo: ' . $mail->ErrorInfo;
}
?>