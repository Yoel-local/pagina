<?php
require_once("conexion.php");
require_once("añadirpedidos.php");

// conseguir el id del pedido y el plato

$pedido_id = $_POST['id'];
$plato_id = $_POST['platos'];

// Preparar la consulta de inserción
$stmt = $mysqli->prepare("INSERT INTO pedidos_platos (pedido_id, plato_id) VALUES (?, ?)");

// Verificar si la preparación de la consulta fue exitosa
if ($stmt === false) {
    die('Error al preparar la consulta: ' . $mysqli->error);
}
$stmt = bind_param("ii", $pedido_id, $plato_id);

// Ejecutar la consulta
if ($stmt->execute()) {
    echo "Plato añadido al pedido correctamente";
} else {
    echo "Error al añadir el plato al pedido: " . $stmt->error;
}

// Cerrar la declaración
$stmt->close();
$mysqli->close();





