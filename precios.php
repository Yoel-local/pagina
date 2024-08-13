<?php
 require_once("conexion.php");

 include("verificar_session.php");

// Consulta para obtener el plato y su precio
$consulta = $mysqli->query("SELECT id, nombre, precio FROM platos");

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cambiar Precios</title>
    <link rel="stylesheet" href="css/cambio-precios.css">
</head>
<body>
    <h1>Cambiar Precios</h1>
    <form action="Cambiarprecios.php" method="post">
        <table border="1">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Precio Actual</th>
                    <th>Nuevo Precio</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                    while ($fila = $consulta->fetch_assoc()) { ?>
                        <tr>
                            <td><?php echo $fila['id']; ?></td>
                            <td><?php echo $fila['nombre']; ?></td>
                            <td><?php echo $fila['precio']; ?></td>
                            <td>
                                <input type="hidden" name="ids[]" value="<?php echo htmlspecialchars($fila['id']); ?>">
                                <input type="text" name="precios[]" value="<?php echo htmlspecialchars($fila['precio']); ?>" placeholder="Nuevo precio">
                            </td>
                        </tr>
                    <?php } 
            
                   
             ?>
            </tbody>
        </table>
        <div>
            <input type="submit" value="Cambiar Precios">
        </div>
        <button class="btn-volver" onclick="self.location.href='index.php'"><i class="fa fa-arrow-left"></i> Volver</button>
    </form>
</body>
</html>
