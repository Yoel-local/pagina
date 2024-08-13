<?php
 require_once("conexion.php");

 include("verificar_session.php");

if (isset($_GET['id'])) {
    $plato_id = $_GET['id'];

    // eliminar platos_alergenos
    $consulta_eliminar_platos_alergenos = $mysqli->query("DELETE FROM platos_alergenos WHERE plato_id=  $plato_id");
    if(!$consulta_eliminar_platos_alergenos){
        echo "NO SE HA BORRADO EL PLATO ALERGENOS";
    }
    $consulta_elmininar_platos_categorias = $mysqli->query("DELETE FROM platos_categorias Where plato_id =  $plato_id");
    if(!$consulta_elmininar_platos_categorias){
        echo "NO SE HA BORRADO EL PLATO CATEGORIAS";
    }
    $consulta_eliminar_platos_relacionados = $mysqli->query("DELETE FROM platos_relacionados WHERE plato_id_1=  $plato_id");
    if(!$consulta_eliminar_platos_relacionados){
        echo "NO SE HA BORRADO EL PLATO RELACIONADOS";
    }
    $consulta_eliminar_pedidos_platos = $mysqli->query("DELETE FROM pedidos_platos WHERE platos_id=  $plato_id");
    if(!$consulta_eliminar_pedidos_platos){
        echo "NO SE HA BORRADO EL PLATO PEDIDOS";
    }
    $consulta_eliminar_platos = $mysqli->query("DELETE FROM platos WHERE id= $plato_id");
    if($consulta_eliminar_platos){
        header("Location: platos.php");
        echo "Se ha borrado el Plato Correctamente";
    }
    else{
        echo "NO SE HA BORRADO EL PLATO";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<a href="platos.php"><h2><- Ver Platos</h2></a>
</body>
</html>
