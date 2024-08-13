<?php
 require_once("conexion.php");

 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Cuenta</title>
    <link rel="stylesheet" href="css/loginn.css">
</head>
<body>
    <form action="registro.php" method="POST">
        <h1>Crear Cuenta</h1>
    
        <?php
        if (isset($_GET['error'])) {
            ?>
            <hr>
            <p class="error">
                <?php echo htmlspecialchars($_GET['error']); ?>
            </p>
            <hr>
        <?php } ?>
        <div>
        <label for="Nombre_Completo">Nombre Completo</label>
        <input type="text" name="Nombre_Completo" id="Nombre_Completo" placeholder="Nombre Completo">      
        <label for="usuario"> Nombre de Usuario</label>
        <input type="text" name="usuario" id="usuario" placeholder="Nombre de usuario">
     
        <label for="clave">Contraseña</label>
        <input type="password" name="clave" id="clave" placeholder="Contraseña">
   
        <input type="submit" value="Crear Cuenta">
    
        </div>
    </form>
</body>
</html>
