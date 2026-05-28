<?php

$pagina = basename($_SERVER['PHP_SELF']);

?>

<div class="sidebar">

<div class="sidebar-logo">

<div class="logo-icon">
🏦
</div>

<div>

<h3 class="logo-title">
CoopAhorro
</h3>

<p class="logo-subtitle">
Sistema financiero
</p>

</div>

</div>
<a href="/coopahorro/dashboard/index.php"
class="<?php echo ($pagina == 'index.php' && strpos($_SERVER['PHP_SELF'],'dashboard')) ? 'active' : ''; ?>">

    <i class="bi bi-speedometer2"></i>
    Dashboard

</a>

<a href="/coopahorro/modules/asociados/index.php"
class="<?php echo (strpos($_SERVER['PHP_SELF'],'asociados')) ? 'active' : ''; ?>">

    <i class="bi bi-people-fill"></i>
    Asociados

</a>

<a href="/coopahorro/modules/ahorros/index.php"
class="<?php echo (strpos($_SERVER['PHP_SELF'],'ahorros')) ? 'active' : ''; ?>">

    <i class="bi bi-wallet2"></i>
    Ahorros

</a>

<a href="/coopahorro/modules/prestamos/index.php"
class="<?php echo (strpos($_SERVER['PHP_SELF'],'prestamos')) ? 'active' : ''; ?>">

    <i class="bi bi-bank"></i>
    Préstamos

</a>

<a href="/coopahorro/modules/movimientos/index.php"
class="<?php echo (strpos($_SERVER['PHP_SELF'],'movimientos')) ? 'active' : ''; ?>">

    <i class="bi bi-arrow-left-right"></i>
    Movimientos

</a>

<a href="/coopahorro/modules/reportes/index.php"
class="<?php echo (strpos($_SERVER['PHP_SELF'],'reportes')) ? 'active' : ''; ?>">

    <i class="bi bi-file-earmark-pdf"></i>
    Reportes

</a>

<a href="/coopahorro/modules/admin_bd/index.php"
class="<?php echo (strpos($_SERVER['PHP_SELF'],'admin_bd')) ? 'active' : ''; ?>">
     <i class="bi bi-shield-lock"></i>
     Gestion BD
</a>

<a href="/coopahorro/auth/logout.php"
class="text-danger mt-5">

    <i class="bi bi-box-arrow-right"></i>
    Cerrar sesión

</a>

</div>