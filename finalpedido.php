<?php
 require_once("conexion.php");

 include("verificar_session.php");
// Verificar si se está editando un pedido existente o insertando uno nuevo
$accion = (isset($_POST['accion']) && $_POST['accion'] === 'editar') ? 1 : 0;

if ($accion == 1) {
    // Verificar si se proporcionó un ID válido para la edición
    if (isset($_POST['id']) && is_numeric($_POST['id'])) {
        // Obtener y validar todos los datos del formulario
        $id = $_POST['id'];
        $metodo_id = $_POST['metodo'];
        $pago_id = $_POST['pago'];
        $repartidor_id = $_POST['repartidor'];
        $usuario_id = $_POST['usuario'];
        $confirmado = $_POST['confirmado'];
        $idplatos = $_POST['platos'];
        // Preparar la consulta de actualización
        $stmt = $mysqli->prepare("
            UPDATE pedidos
            SET
                metodo_id = ?,
                pago_id = ?,
                repartidor_id = ?,
                usuario_id = ?,
                confirmado = ?
            WHERE id = ?
            ");
        if ($stmt === false) {
            die('Error al preparar la consulta: ' . $mysqli->error);
        }

            $stmt->bind_param("iiiiii", $metodo_id, $pago_id, $repartidor_id, $usuario_id, $confirmado, $id);

        if ($stmt->execute()) {
            echo "Pedido actualizado correctamente";
        } else {
            echo "Error al actualizar el pedido: " . $stmt->error;
        }
        $stmt->close();
    } else {
        echo "ID de pedido no válido.";
    }

} else { 
    $stmt = $mysqli->prepare("
        INSERT INTO pedidos (metodo_id, pago_id, repartidor_id, usuario_id, entrega_id, confirmado)
        VALUES (?, ?, ?, ?, ?, ?)");


    // Vincular parámetros
    $stmt->bind_param("siiiii",
        $_POST['canal'],
        $_POST['pago'],
        $_POST['repartidor'],
        $_POST['usuario'],
        $_POST['entrega'],
        $_POST['confirmado']
    );


    if ($stmt->execute()) {
        echo "Pedido insertado correctamente.";
        $pedido_id = $mysqli->insert_id; // Obtener el ID del pedido recién insertado
    } else {
        echo "Error al insertar el pedido: " . $stmt->error;
    }
    $stmt->close();
}

// Obtener el ID del pedido (si es un nuevo pedido o un pedido existente)
$pedido_id = $accion == 1 ? intval($_POST['id']) : $pedido_id;

// Preparar la consulta de inserción en pedidos_platos
$stmt = $mysqli->prepare("INSERT INTO pedidos_platos (pedidos_id, platos_id) VALUES (?, ?)");
if ($stmt === false) {
    die('Error al preparar la consulta: ' . $mysqli->error);
}

// Obtener los platos seleccionados (puede ser un array si se seleccionan múltiples platos)
$platos = is_array($_POST['platos']) ? $_POST['platos'] : array($_POST['platos']);

// Vincular y ejecutar la consulta para cada plato
foreach ($platos as $plato_id) {
    $stmt->bind_param("ii", $pedido_id, intval($plato_id));
    if ($stmt->execute()) {
        echo "Plato añadido al pedido correctamente.";
    } else {
        echo "Error al añadir el plato al pedido: " . $stmt->error;
    }
}

$stmt->close();
$mysqli->close();
?>

