<?php
 require_once("conexion.php");

 include("verificar_session.php");

$accion = (isset($_POST['accion']) && $_POST['accion'] === 'editar') ? 1 : 0;
function esCampoVacio($campo)
{
    return empty(trim($campo));
}
if ($accion == 1) {
    if (isset($_POST['id']) && is_numeric($_POST['id'])) {
        // Obtener y verificar datos del formulario
        $id = $_POST['id'];
        $nombre = $_POST['nombre'];
        $precio = $_POST['precio'];
        $descripcion = $_POST['descripcion'];
        $picor = $_POST['picor'];

        if (esCampoVacio($nombre) || esCampoVacio($precio) || esCampoVacio($descripcion) || esCampoVacio($picor)) {
            die('Todos los campos son requeridos.');
        }
        // Preparar la consulta de actualizacion
        $stmt = $mysqli->prepare("
            UPDATE platos
            SET
                nombre = ?,
                precio = ?,
                descripcion = ?,
                picor = ?
            WHERE id = ?
        ");

        // Verificar si la preparación de la consulta fue exitosa
        if ($stmt === false) {
            die('Error al preparar la consulta: ' . $mysqli->error);
        }

        // Vincular parámetros
        $stmt->bind_param("ssssi", $nombre, $precio, $descripcion, $picor, $id);

        // Ejecutar la consulta
        if ($stmt->execute()) {
            header("Location: platos.php");
            exit();
            
        } else {
            echo "Error al actualizar el plato: " . $stmt->error;
        }

        // Cerrar la declaración
        $stmt->close();
    } else {
        echo "ID de plato no válido";
    }
} else {
    // Obtener y verificar datos del formulario
    $nombre = $_POST['nombre'];
    $precio = $_POST['precio'];
    $descripcion = $_POST['descripcion'];
    $picor = $_POST['picor'];

    if (esCampoVacio($nombre) || esCampoVacio($precio) || esCampoVacio($descripcion) || esCampoVacio($picor)) {
        die('Todos los campos son requeridos.');
    }


    // Preparo la consulta de insercion para un nuevo plato
    $stmt = $mysqli->prepare("
        INSERT INTO platos (nombre, precio, descripcion, picor, foto_id, categoria_id)
        VALUES (?,?,?,?,1,1)
    ");

    // Verificar si la preparación de la consulta fue exitosa
    if ($stmt === false) {
        die('Error al preparar la consulta: ' . $mysqli->error);
    }

    // Vincular parámetros
    $stmt->bind_param(
        "sdsi",
        $_POST['nombre'],
        $_POST['precio'],
        $_POST['descripcion'],
        $_POST['picor']
    );

    // Ejecutar la consulta
    if ($stmt->execute()) {
        echo "Plato insertado correctamente";
        header("Location: nuevoplato.php");
        exit();
    } else {
        echo "Error al insertar el plato: " . $stmt->error;
    }

    // Cerrar la declaración
    $stmt->close();
}

// Cerrar la conexión
$mysqli->close();
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nuevo Plato Creado</title>
</head>

<body>
    <br><br>
    <a href="platos.php">
        <h2><- Ver Platos</h2>
    </a>
</body>

</html>