<?php
require_once("conexion.php");
include("verificar_session.php");
// Verificar la conexión
if ($mysqli->connect_error) {
    die("Conexión fallida: " . $mysqli->connect_error);
}

// Cambiar precio de plato
if (isset($_POST["id"]) && is_numeric($_POST["id"]) && isset($_POST["precio"])) {
    $id = $_POST["id"];
    $precio = $_POST["precio"];

    // Preparar la consulta de actualización
    $stmt = $mysqli->prepare("
    UPDATE platos SET precio = ? WHERE id = ?
    ");
    if ($stmt === false) {
        die("Error al preparar la consulta: " . $mysqli->error);
    }

    // Vincular los parámetros
    $stmt->bind_param("di", 
    $precio,
    $id
    
    );

    

    // Ejecutar la consulta
    if ($stmt->execute()) {
        echo "Precio actualizado correctamente";
        header("Location: platos.php");
        exit();
    } else {
        echo "Error al actualizar el precio: " . $stmt->error;
    }

    // Cerrar la declaración y la conexión
    $stmt->close();
    $mysqli->close();
}
else {
    echo "ID o precio no válidos.";
}
?>
