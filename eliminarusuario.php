<?php
 require_once("conexion.php");

 include("verificar_session.php");

// Verificar la conexión
if ($mysqli->connect_error) {
    die("Error de conexión: " . $mysqli->connect_error);
}

// Validar la entrada
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $usuario_id = intval($_GET['id']);

    // Preparar la consulta para evitar inyección SQL
    if ($stmt = $mysqli->prepare("CALL Procedimiento_Eliminar_Usuario(?)")) {
        $stmt->bind_param("i", $usuario_id);
        $stmt->execute();

        if ($stmt->affected_rows > 0) {
            echo "Se ha borrado el Usuario Correctamente";
        } else {
            echo "NO SE HA BORRADO EL USUARIO";
        }

        $stmt->close();
    } else {
        echo "Error en la preparación de la consulta: " . $mysqli->error;
    }
} else {
    echo "ID de usuario no válido.";
}

// Cerrar la conexión a la base de datos
$mysqli->close();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <button onclick="self.location.href='usuario.php'">Volver</button>
</body>
</html>
