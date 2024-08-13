<?php
session_start();

if (!isset($_SESSION['usuario_id'])) {
    header("Location: login.php?error=Por favor, inicie sesión para acceder a esta página");
    exit();
}
?>
