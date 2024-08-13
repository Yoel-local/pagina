<?php
require_once("conexion.php");

// Definir el usuario y la nueva contraseña
$usuario = 'alan';
$nueva_clave = '1234'; // La contraseña en texto plano
$hashed_password = password_hash($nueva_clave, PASSWORD_DEFAULT);

// Actualizar la contraseña en la base de datos
$sql = "UPDATE root SET clave = ? WHERE usuario = ?";
if ($stmt = mysqli_prepare($mysqli, $sql)) {
    mysqli_stmt_bind_param($stmt, "ss", $hashed_password, $usuario);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    echo "Contraseña actualizada correctamente";
} else {
    echo "Error al actualizar la contraseña: " . mysqli_error($mysqli);
}

mysqli_close($mysqli);
?>
