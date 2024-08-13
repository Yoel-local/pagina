<?php
 require_once("conexion.php");

 include("verificar_session.php");
 $carta = $mysqli->query("SELECT * FROM platos join fotos on platos.foto_id = fotos.id" );
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carta de Platos</title>
    <link rel="stylesheet" href="css/carta.css">
</head>

<body>
    <header>
        <h1>Carta de Platos</h1>
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
        <?php
 
        
        while ($filasCarta = $carta->fetch_assoc()) { ?>
            <div class="div">
                <div class="texto"><?php echo ($filasCarta['nombre']); ?></div>
                <div class="divcentral">
                    <img src="img/platos/<?php echo $filasCarta['ruta'];?>"></div>
                <div class="container3"></div>
                <div class="container2">
                    <div class="div2"></div>
                    <div class="div2"></div>
                    <div class="div2"></div>
                </div>
            </div>
        <?php } ?>
    </div>
</body>

</html>
