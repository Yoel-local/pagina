<?php
require_once("conexion.php");
include("verificar_session.php");

//LANZO CONSULTA PARA OBTENER LOS ALERGENOS
$misAlergenos = $mysqli->query("SELECT * FROM alergenos");
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="widtd=device-widtd, initial-scale=1.0">
    <title>Listado de alérgenos</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="css/platos.css">
</head>
<body>
    <br>
    <table border="1" cellpadding="8" cellspacing="2">
        <tr>
            <th>Id</th>
            <th>Nombre</th>
            <th>Imagen</th>
        </tr>
        <?php while ($filas = $misAlergenos->fetch_assoc()) {?>
            <tr>
                <td><?php echo $filas['id'] ?></td>
                <td><?php echo $filas['nombre'] ?></td>
                <td><img src="img/alergenos/<?php echo $filas['icono'] ?>" alt="" width="50"></td>
            </tr>
        <?php }?>
        <button class="btn-volver" onclick="self.location.href='index.php'"><i class="fa fa-arrow-left"></i> Volver</button>

    </table>
</body>
</html>