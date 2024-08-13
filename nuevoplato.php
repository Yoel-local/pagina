<?php
 require_once("conexion.php");

 include("verificar_session.php");
// Controlar si inserto o edito
// Accion=1 -> Edito, Accion=0 -> Inserto
$accion = (empty($_GET['id']) ?0 : 1);

// Acciones en función de editar o insertar
if ($accion == 1) {
    $miPlato = $mysqli->query("SELECT * FROM platos WHERE id=" . $_GET['id']);
    $filaMiPlato = $miPlato->fetch_assoc();

    $nombreAccion = "Editar Plato";
    $vPlatoID = $_GET['id'];
    $vNombrePlato = $filaMiPlato['nombre'];
    $vPrecioPlato = $filaMiPlato['precio'];
    $vDescripcionPlato = $filaMiPlato['descripcion'];
    $vPicorPlato = $filaMiPlato['picor'];

    $boton = "Editar Plato";
} else {
    $nombreAccion = "Insertar Plato";
    $vPlatoID = "";
    $vNombrePlato = "";
    $vPrecioPlato = "0.00";
    $vDescripcionPlato = "";
    $vPicorPlato = "0";

    $boton = "Insertar Plato";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $nombreAccion ?></title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    <link rel="stylesheet"href="css/nuevoplato.css">
</head>
<body>
    <h2><?php echo $nombreAccion ?></h2>

    <form action="editplatofinal.php" method="post">
        <input type="hidden" id="accion" name="accion" value="<?php echo $accion ==1 ? 'editar':'insertar' ?>">
        <input type="hidden" id="id" name="id" value="<?php echo $vPlatoID ?>">
        <div><label for="nombre">Nombre</label></div>
        <div><input type="text" size="30" id="nombre" name="nombre" required value="<?php echo $accion==1 ? $vNombrePlato : ''; ?>" placeholder="EJ:Pizza"></div>


        <div><label for="precio">Precio</label></div>
        <div><input type="text" size="20" id="precio" name="precio" value="<?php echo $accion==1 ? $vPrecioPlato:''; ?>" placeholder="Ej: 10.00"></div>



        <div><label for="descripcion">Descripción</label></div>
        <div><input type="text" size="50" id="descripcion" name="descripcion" value="<?php echo $accion ==1 ? $vDescripcionPlato :'';?>"placeholder="Ej: Pizza con ...."></div>


        <div><label for="picor">Picor</label></div>
        <div><input type="text" size="10" id="picor" name="picor" value="<?php echo $accion==1 ?$vPicorPlato :'';?>" placeholder="Ej : 1"></div>
        <br>
        <div><input type="submit" value="<?php echo $boton ?>"></div>
        <button class="btn-volver" onclick="self.location.href='platos.php'"><i class="fa fa-arrow-left"></i> Volver</button>

    </form>

    <br><br>


</body>
</html>


