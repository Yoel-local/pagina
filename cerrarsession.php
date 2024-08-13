<?php 
 require_once("conexion.php");

 include("verificar_session.php");
session_start();
session_unset();
session_destroy();
header("Location: login.php");