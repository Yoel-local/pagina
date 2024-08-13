<?php
 require_once("conexion.php");

 include("verificar_session.php");
function validar($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

if(isset($_POST['usuario'])&& isset($_POST['clave'])){
    $usuario = validar($_POST['usuario']);
    $clave = validar($_POST['clave']);
    $Nombre = validar($_POST['Nombre_Completo']);
}
if(empty($usuario)){
    header("Location: crearcuenta.php?error=Usuario es requerido");
    exit();
}elseif(empty($clave)){
    header("Location: crearcuenta.php?error=Contraseña es requerida");
    exit();
} else {
    $sql ="Insert into root (usuario, clave,Nombre_Completo) values (?, ?, ?)";

    if($stmt = mysqli_prepare($mysqli, $sql)){
        $hash = password_hash($clave, PASSWORD_DEFAULT);
        mysqli_stmt_bind_param($stmt, "sss",$usuario ,$hash,$Nombre);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
        header("Location: login.php");
        exit();
    } else {
        error_log("Error de preparación de consulta: " . mysqli_error($mysqli));
        header("Location: crearcuenta.php?error=Error de conexión");
        exit();
    }
    
}