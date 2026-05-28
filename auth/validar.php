<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();

include("../config/conexion.php");

$correo = $_POST['correo'];
$password = md5($_POST['password']);

$sql = "SELECT * FROM usuarios 
WHERE correo='$correo'
AND password='$password'";

$resultado = mysqli_query($conn, $sql);

if(mysqli_num_rows($resultado) > 0){

    $usuario = mysqli_fetch_assoc($resultado);

    $_SESSION['usuario'] = $usuario['nombre'];

    echo $_SESSION['usuario'];

    header("Location: ../dashboard/");
    exit();

}else{

    echo "
    <script>
        alert('Datos incorrectos');
        window.location='login.php';
    </script>
    ";

}
?>