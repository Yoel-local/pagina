<?php
 require_once("conexion.php");

 include("verificar_session.php");

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $usuario_id =  $_GET['id'];

   //Eliminar usuario llamando a procedimiento
 $stmt = $mysqli->prepare("CALL 	Procedimiento_Eliminar_Usuario(?)");
 $stmt->bind_param("i", $usuario_id);
 if( $stmt->execute() ) {
     echo "Usuario eliminado correctamente";
     header("Location: usuarios.php");
     exit();
 } else {
     echo "Error al eliminar usuario";
 } 
  
    $stmt->close();
    

}
 $mysqli->close();
?>
