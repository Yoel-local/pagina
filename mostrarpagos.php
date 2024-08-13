<?php
require_once("conexion.php"); // Asegúrate de que esta ruta sea correcta

// Habilitar la visualización de errores
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Verificar la sesión
include("verificar_session.php");

// Ejecutar el procedimiento almacenado
$sql = "CALL Procedimiento_Ventas_Por_Forma_Pago()";
$resultado = $mysqli->query($sql);

if (!$resultado) {
    echo "Error al ejecutar el procedimiento: " . $mysqli->error;
    exit();
}

// Inicializar arrays para almacenar resultados
$datos = [];
$total_dinero = 0;

// Procesar el primer conjunto de resultados
if ($resultado) {
    while ($row = $resultado->fetch_assoc()) {
        if (!isset($row['total_pedidos'])) {
            // Asumimos que este es el primer conjunto de resultados (pagos)
            $datos[] = $row;
        } else {
            // Si existe total_pedidos, es el segundo conjunto de resultados
            $total_dinero = $row['total_pedidos'];
        }
    }
    $resultado->free(); // Liberar el primer conjunto de resultados

    // Verificar y procesar el segundo conjunto de resultados, si existe
    if ($mysqli->more_results()) {
        // Llamar a next_result() para avanzar al siguiente conjunto de resultados
        if ($mysqli->next_result()) {
            // Obtener el siguiente conjunto de resultados
            if ($resultado2 = $mysqli->store_result()) {
                if ($resultado2->num_rows > 0) {
                    // Solo debe haber una fila en este conjunto de resultados
                    $total_row = $resultado2->fetch_assoc();
                    $total_dinero = $total_row['total'];
                }
                $resultado2->free(); // Liberar el segundo conjunto de resultados
            }
        }
    }
}

// Realizar una consulta adicional para obtener el total de pedidos
$sql2 = "SELECT SUM(TOTAL_PEDIDO) AS total_pedidos FROM pedidos";
$resultado2 = $mysqli->query($sql2);

if ($resultado2) {
    $total_row = $resultado2->fetch_assoc();
    $total_dinero = $total_row['total_pedidos'];
    $resultado2->free(); // Liberar el resultado de la consulta adicional
} else {
    echo "Error al ejecutar la consulta adicional: " . $mysqli->error;
}

// Cerrar la conexión
$mysqli->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mostrar Pagos</title>
    <link rel="stylesheet" href="css/platos.css">
</head>
<body>
    <h1>Mostrar Pagos</h1>
    
    <!-- Tabla con los detalles de los pagos -->
    <table border="1">
        <thead>
            <tr>
                <th>Metodo de Pago</th>
                <th>Total</th>
                <th>Porcentaje</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($datos)) { ?>
                <?php foreach ($datos as $row) { ?>
                    <tr>
                        <td><?php echo htmlspecialchars($row['metodo'], ENT_QUOTES, 'UTF-8'); ?></td>
                        <td><?php echo number_format($row['total_metodo'], 2  ); ?> $</td>
                        <td><?php echo number_format($row['porcentaje_total'], 2); ?>%</td>
                    </tr>
                <?php } ?>
            <?php } ?>
        </tbody>
    </table>

    <!-- Mostrar el total de pedidos -->
    <h2> Dinero Total de Pedidos: <?php echo number_format($total_dinero, 2); ?> $</h2>

    <button onclick="window.location.href='index.php'">Volver</button>
</body>
</html>
