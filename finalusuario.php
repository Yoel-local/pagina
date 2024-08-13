<?php
 require_once("conexion.php");

 include("verificar_session.php");
if ($mysqli->connect_error) {
    die("Error de conexión: " . $mysqli->connect_error);
}

$accion = isset($_POST['accion']) && $_POST['accion'] === 'editar' ? 1 : 0;
function esCampoVacio($campo)
{
    return empty(trim($campo));
}
if ($accion == 1) {
    if (isset($_POST['id']) && is_numeric($_POST['id'])) {
              // Obtener y verificar datos del formulario
        $id = $_POST['id'];
        $nombre = $_POST['nombre'];
        $apellido = $_POST['apellido'];
        $dni = $_POST['dni'];
        $direccion = $_POST['direccion'];
        $telefono = $_POST['telefono'];
        $correo = $_POST['correo'];
if(esCampoVacio($nombre) || esCampoVacio($apellido) || esCampoVacio($dni) || esCampoVacio($direccion) || esCampoVacio($telefono) || esCampoVacio($correo)){
 die('Todos los campos son requeridos.');     
}
    // Preparar la consulta de actualización
        $stmt = $mysqli->prepare("
            UPDATE usuarios
            SET
                nombre = ?,
                apellido = ?,
                dni = ?,
                direccion = ?,
                telefono = ?,
                correo = ?
            WHERE id = ?
        ");
        $stmt->bind_param("ssssssi",
            $nombre,
            $apellido,
            $dni,
            $direccion,
            $telefono,
            $correo,
            $id
        );

        if ($stmt->execute()) {
            echo "Usuario actualizado correctamente.";
            header("Location: usuarios.php");
        } else {
            echo "Error al actualizar el usuario: " . $stmt->error;
        }

        $stmt->close();
    } else {
        echo "ID de usuario no válido.";
    }
} else {
  // Obtener y verificar datos del formulario
  $nombre = $_POST["nombre"];
  $apellido = $_POST["apellido"];
  $dni = $_POST["dni"];
  $direccion = $_POST["direccion"];
  $telefono = $_POST["telefono"];
  $correo = $_POST["correo"];
     if(esCampoVacio($nombre) || esCampoVacio($apellido) || esCampoVacio($dni) || esCampoVacio($direccion) || esCampoVacio($telefono) || esCampoVacio($correo)){
        die('Todos los campos son requeridos.');
     }

    // Preparar la consulta de inserción
    $stmt = $mysqli->prepare("
        INSERT INTO usuarios (nombre, apellido, dni, direccion, telefono, correo)
        VALUES (?, ?, ?, ?, ?, ?)
    ");

    //vincular parametros
    $stmt->bind_param("ssssss",
        $_POST['nombre'],
        $_POST['apellido'],
        $_POST['dni'],
        $_POST['direccion'],
        $_POST['telefono'],
        $_POST['correo']
    );
  
    if ($stmt->execute()) {
        echo "Usuario insertado correctamente.";
        header("Location: usuarios.php");
    } else {
        echo "Error al insertar el usuario: " . $stmt->error;
    }

    $stmt->close();
}

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
    <a href="usuario.php">Volver</a>
</body>
</html>