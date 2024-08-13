<?php
require_once("conexion.php");
$carta = $mysqli->query("SELECT * FROM platos join fotos on platos.foto_id = fotos.id" );
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carta de Platos</title>
    <link rel="stylesheet" href="css/carta2.css">
</head>

<body>
    <div class="container">
        <?php while ($filasCarta = $carta->fetch_assoc()) { ?>
            <div class="div">
                <div class="texto"><?php echo htmlspecialchars($filasCarta['nombre']); ?></div>
                <div class="divcentral"><img src="img/platos/<?php echo htmlspecialchars($filasCarta['ruta']); ?>"></div>
             
            </div>
        <?php } ?>
    </div>
</body>

</html>
