<?php

session_start();

include("../../config/conexion.php");

/* =========================
   OBTENER DATOS
========================= */

$usuario = trim($_POST['usuario']);

$password = trim($_POST['password']);

/* =========================
   VALIDAR CAMPOS
========================= */

if(empty($usuario) || empty($password)){

    echo "

    <script>

    alert('Completa todos los campos');

    window.location='index.php';

    </script>

    ";

    exit();
}

/* =========================
   CONSULTAR USUARIO
========================= */

$sql = "SELECT *

FROM usuarios

WHERE nombre='$usuario'
AND password='$password'";

$resultado = mysqli_query($conn, $sql);

/* =========================
   VALIDAR LOGIN
========================= */

if(mysqli_num_rows($resultado) > 0){

    $_SESSION['admin_bd'] = true;

    header("Location: eliminar_definitivo.php");
    exit();

}else{

    echo "

    <script>

    alert('Credenciales incorrectas');

    window.location='index.php';

    </script>

    ";

    exit();
}

?>