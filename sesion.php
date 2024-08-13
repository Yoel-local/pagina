<?php
session_start();
require_once("conexion.php");

// Function to sanitize user input
function validar($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

// Check if the form is submitted
if (isset($_POST['usuario']) && isset($_POST['clave'])) {
    $usuario = validar($_POST['usuario']);
    $contraseña = validar($_POST['clave']);

    // Validate user input
    if (empty($usuario)) {
        header("Location: login.php?error=Usuario es requerido");
        exit();
    } elseif (empty($contraseña)) {
        header("Location: login.php?error=Contraseña es requerida");
        exit();
    } else {
        // Prepare and execute the SQL query using prepared statements
        $sql = "SELECT * FROM root WHERE usuario = ?";
        if ($stmt = mysqli_prepare($mysqli, $sql)) {
            mysqli_stmt_bind_param($stmt, "s", $usuario);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);

            if (mysqli_num_rows($result) === 1) {
                $row = mysqli_fetch_assoc($result);
            
                // Verify the password
                if (password_verify($contraseña, $row['clave'])) {
                    // Set session variables
                    $_SESSION['usuario'] = $row['usuario'];
                    $_SESSION['usuario_id'] = $row['id'];
                    $_SESSION['Nombre_Completo'] = $row['Nombre_Completo'];

                    // Redirect to the index page
                    header("Location: index.php");
                    exit();
                } else {
                    error_log("Contraseña incorrecta: Usuario '$usuario'");
                    header("Location: login.php?error=Usuario o Contraseña incorrectos");
                    exit();
                }
            } else {
                error_log("Usuario no encontrado: '$usuario'");
                header("Location: login.php?error=Usuario o Contraseña incorrectos");
                exit();
            }
            mysqli_stmt_close($stmt);
        } else {
            error_log("Error de preparación de consulta: " . mysqli_error($mysqli));
            header("Location: login.php?error=Error de conexión");
            exit();
        }
    }
} else {
    header("Location: login.php?error=Acceso no autorizado");
    exit();
}

// Close database connection
mysqli_close($mysqli);

// Debugging output
error_log("Usuario: $usuario");
error_log("Contraseña: $contraseña");
?>
