<?php
 require_once("conexion.php");

 include("verificar_session.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Comida Rápida / Scripts Ejemplo</title>
	<link rel="stylesheet" href="css/index.css">
</head>
<body>
<header>
        <h1>Inicio</h1>
<div class="contenedor_menu">
	<div class="div_menu"><a href="index.php">Inicio</a></div>
	<div class="div_menu"><a href="alergenos.php">Listado de Alérgenos</a></div>
	<div class="div_menu"><a href="pedidosretrasados.php">Pedidos Retraso 1h</a></div>
	<div class="div_menu"><a href="carta.php">Carta</a></div>
	<div class="div_menu"><a href="platos.php">Listado de Platos</a></div>
	<div class="div_menu"><a href="cerrarsession.php">cerrar session</a></div>

</div>
    </header>
<div class="container">
<ul>
	<li><a href="alergenos.php">Listado de Alérgenos</a></li>
	<li><a href="pedidosretrasados.php">Pedidos Retraso 1h</a></li>
	<li><a href="carta.php">Carta</a></li>
	<li><a href="platos.php">Listado de Platos</a></li>
	<li><a href="precios.php">Cambio de Precios</a></li>
	<li><a href="nuevoplato.php">Nuevo Plato</a></li>
    <li><a href="usuarios.php"> Usuarios</a></li>
	<li><a href="mostrarpagos.php">Pagos</a> </li>
	
</ul>


</div>
</body>
</html>