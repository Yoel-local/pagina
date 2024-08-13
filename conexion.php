<?php
// Datos de conexión
$servername = "localhost"; // Reemplaza con tu servidor
$database = "restaurante_f"; // Reemplaza con el nombre de tu base de datos
$username = "root"; // Reemplaza con tu usuario
$password = "1234"; // Reemplaza con tu contraseña

// Crea una conexión
$mysqli = new mysqli('localhost', 'root', '1234', 'restaurante_f');
// Verifica la conexión
if ($mysqli->connect_error) {
    die("Error de conexión: " . $mysqli->connect_error);
}



?>
