<?php

include("../../config/conexion.php");

# DATOS

$asociado_id = $_POST['asociado_id'];

$tipo = $_POST['tipo'];

# CREAR CUENTA AHORRO

$sql = "INSERT INTO ahorros
(asociado_id,tipo,saldo)

VALUES
('$asociado_id','$tipo',0)";

$resultado = mysqli_query($conn,$sql);

if($resultado){

    header("Location: index.php");

}else{

    echo "Error al crear cuenta";

}

?>