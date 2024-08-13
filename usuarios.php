<?php
require_once("conexion.php");
include("verificar_session.php");


$usuarios = $mysqli->query("SELECT * FROM usuarios");
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Usuarios</title>
    <link rel="stylesheet" href="css/usuarios.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
    <h1>Usuarios</h1>

 
    <table border="1">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Apellido</th>
                <th>DNI</th>
                <th>Dirección</th>
                <th>Teléfono</th>
                <th>Correo</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($fila = $usuarios->fetch_assoc()) { ?>
                <tr>
                    <td><?php echo $fila['id']; ?></td>
                    <td><?php echo $fila['nombre']; ?></td>
                    <td><?php echo $fila['apellido']; ?></td>
                    <td><?php echo $fila['dni']; ?></td>
                    <td><?php echo $fila['direccion']; ?></td>
                    <td><?php echo $fila['telefono']; ?></td>
                    <td><?php echo $fila['correo']; ?></td>
                    <td aling="center">
            <a href="eliminar_usuario.php?id=<?php echo $fila['id'];?>"><i class="fa-solid fa-trash-can iconoRojo"></i></a>
            <a href="editarusuario.php?id=<?php echo $fila['id'];?>"><i class="fa-solid fa-pen-to-square iconoVerde"></i></a>
        </td>
                </tr>
            <?php } ?>
        </tbody>
        <button class="btn-volver" onclick="self.location.href='index.php'"><i class="fa fa-arrow-left"></i> Volver</button>
        <button class="btn-nuevo-usuario"onclick="self.location.href='editarusuario.php'">Nuevo Usuario <i class="fa fa-plus-square"></i></button>
    </table>
  

</body>
</html>
<?php 
$mysqli->close();
?>