<?php
    require_once("conexion.php");

    include("verificar_session.php");
// verificar_sesion.php

session_start();



   
    $misPlatos=$mysqli->query("SELECT * FROM platos");

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listado de platos</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="css/platos.css">

</head>
<body>

    <table border="1">
    <tr>
          <th>id</th>
          <th>nombre</th>
          <th>descripcion</th>
          <th>precio</th>
          <th>picor</th>
          <th>Acciones</th>
    </tr>

    <?php while ($filasMisPlatos = $misPlatos ->fetch_assoc()){ ?>
    <tr>
        <td><?php echo $filasMisPlatos['id']?></td>
        <td><?php echo $filasMisPlatos['nombre']?></td>
        <td><?php echo $filasMisPlatos['descripcion']?></td>
        <td><?php echo $filasMisPlatos['precio']?></td>
        <td><?php echo $filasMisPlatos['picor']?></td>
        <td aling="center">
            <a href="eliminarPlato.php?id=<?php echo $filasMisPlatos['id']?>"><i class="fa-solid fa-trash-can iconoRojo"></i></a>
            <a href="nuevoplato.php?id=<?php echo $filasMisPlatos['id']?>"><i class="fa-solid fa-pen-to-square iconoVerde"></i></a>
        </td>
    </tr>
        <?php } ?>
    <button class="btn-volver" onclick="self.location.href='index.php'"><i class="fa fa-arrow-left"></i> Volver</button>
    <button class="btn-nuevo-plato"onclick="self.location.href='nuevoplato.php'">Nuevo Plato <i class="fa fa-plus-square"></i></button>




</table>
</body>
</html>