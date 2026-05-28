<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

include("../../config/conexion.php");

# =========================
# DATOS
# =========================

$asociado_id = $_POST['asociado_id'];

$valor = $_POST['valor'];

$descripcion = $_POST['descripcion'];

# =========================
# TIPO AUTOMATICO
# =========================

$tipo = "Deposito";

# =========================
# INSERT MOVIMIENTO
# =========================

$sql = "INSERT INTO movimientos
(asociado_id,tipo,valor,descripcion)

VALUES
('$asociado_id','$tipo','$valor','$descripcion')";

$resultado = mysqli_query($conn, $sql);

# =========================
# VALIDAR
# =========================

if($resultado){

    # =========================
    # ULTIMO ID
    # =========================

    $movimiento_id = mysqli_insert_id($conn);

    # =========================
    # ACTUALIZAR AHORRO
    # =========================

    $sql_ahorro = "UPDATE ahorros

    SET saldo = saldo + '$valor'

    WHERE asociado_id = '$asociado_id'";

    mysqli_query($conn, $sql_ahorro);

    # =========================
    # ENVIAR CORREO
    # =========================

    file_get_contents(
    "http://localhost/coopahorro/modules/reportes/enviar_correo.php?id=".$movimiento_id
    );

    # =========================
    # ABRIR RECIBO
    # =========================

    echo "

    <script>

    var url = '/coopahorro/modules/reportes/recibo.php?id=".$movimiento_id."';

    window.open(url, '_blank', 'noopener,noreferrer');

    window.location.href='/coopahorro/modules/movimientos/';

    </script>

    ";

}else{

    echo 'Error al guardar depósito';

}

?>