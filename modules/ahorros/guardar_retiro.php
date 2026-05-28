<?php

include("../../config/conexion.php");

$id = $_POST['id'];

$asociado_id = $_POST['asociado_id'];

$saldo = $_POST['saldo'];

$valor = $_POST['valor'];

$descripcion = $_POST['descripcion'];

if($saldo >= $valor){

    $sql = "UPDATE ahorros

    SET saldo = saldo - '$valor'

    WHERE id='$id'";

    mysqli_query($conn, $sql);

    $sqlMovimiento = "INSERT INTO movimientos
    (
    asociado_id,
    tipo,
    valor,
    descripcion
    )

    VALUES

    (
    '$asociado_id',
    'retiro',
    '$valor',
    '$descripcion'
    )";

    mysqli_query($conn, $sqlMovimiento);

    header("Location: index.php");
    exit();

}else{

    echo "
    <script>

    alert('Saldo insuficiente');

    window.location='index.php';

    </script>
    ";

}

?>