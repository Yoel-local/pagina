<?php
require_once("conexion.php");
include("verificar_session.php");
if ($mysqli->connect_error) {
    die("Error de conexión: " . $mysqli->connect_error);
}

// 1 edit, 0 insert
$accion = (empty($_GET['id']) ? 0 : 1);
if($accion == 1){
    $miUsuario = $mysqli->query("SELECT * FROM usuarios WHERE id=" . $_GET['id']);
    $filaMiUsuario = $miUsuario->fetch_assoc();

    $nombreAccion = "Editar Usuario";
    $vUsuarioID = $_GET['id'];
    $vNombreUsuario = $filaMiUsuario['nombre'];
    $vApellidoUsuario = $filaMiUsuario['apellido'];
    $vDniUsuario = $filaMiUsuario['dni'];
    $vDireccionUsuario = $filaMiUsuario['direccion'];
    $vTelefonoUsuario = $filaMiUsuario['telefono'];
    $vCorreoUsuario = $filaMiUsuario['correo'];

    $boton = "Editar Usuario";
} else { 
    $nombreAccion = "Insertar Usuario";
    $vUsuarioID = "";
    $vNombreUsuario = "";
    $vApellidoUsuario = "";
    $vDniUsuario = "";
    $vDireccionUsuario = "";
    $vTelefonoUsuario = "";
    $vCorreoUsuario = "";

    $boton = "Insertar Usuario";
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $nombreAccion ?></title>
    <link rel="stylesheet" href="css/nuevoplato.css">
</head>
<body>
    <h2><?php echo $nombreAccion ?></h2>
    <form action="finalusuario.php" method="post">
    <input type="hidden" id="accion" name="accion" value="<?php echo ($accion == 1 ? 'editar' : 'insertar'); ?>">
        <input type="hidden" id="id" name="id" value="<?php echo $vUsuarioID; ?>">
      
        <div><label for="nombre">Nombre</label></div>
        <div><input type="text" size="30" id="nombre" name="nombre" required value="<?php  echo  $accion==1 ? $vNombreUsuario: '' ;?>" placeholder="EJ : Juan"></div>


        <div><label for="apellido">Apellido</label></div>
        <div><input type="text" size="30" id="apellido" name="apellido" value="<?php echo $accion==1 ? $vApellidoUsuario :'';?>" placeholder="EJ: Gallardo"></div>
        <div><label for="dni">DNI</label></div>
        <div><input type="text" size="30" id="dni" name="dni" value="<?php echo $accion==1 ? $vDniUsuario:''; ?>" placeholder="25554658P"></div>
        <div><label for="direccion">Dirección</label></div>
        <div><input type="text" size="30" id="direccion" name="direccion" value="<?php echo $accion==1 ? $vDireccionUsuario:'' ;?>" placeholder="Ej Calle"></div>
        <div><label for="telefono">Teléfono</label></div>
        <div><input type="text" size="30" id="telefono" name="telefono" value="<?php echo $accion==1 ? $vTelefonoUsuario:''; ?>"placeholder="65445858"></div>
        <div><label for="correo">Correo</label></div>
        <div><input type="text" size="30" id="correo" name="correo" value="<?php echo $accion==1 ? $vCorreoUsuario :'';?>" placeholder="Juan@gmail.com"></div>
        <br>
      
        <div><input type="submit" value="<?php echo $boton ?>"></div>
        <button class="btn-volver" onclick="self.location.href='usuarios.php'"><i class="fa fa-arrow-left"></i> Volver</button>

    </form>
</body>
</html>
