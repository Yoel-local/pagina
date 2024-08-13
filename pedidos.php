<?php
 require_once("conexion.php");

 include("verificar_session.php");
// Consulta a la base de datos para obtener todos los pedidos
$consulta = "SELECT metodo.canal as metodo, pedidos.id,fecha_entrega,fecha_pedido,pedidos.TOTAL_PEDIDO,usuarios.nombre as nombre_usuario,repartidor.nombre as nombre_repartidor FROM pedidos join usuarios on pedidos.usuario_id=usuarios.id
join repartidor on pedidos.repartidor_id=repartidor.id
join metodo on pedidos.metodo_id=metodo.id";
$pedidos = $mysqli->query("$consulta");
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <title>Listado de Pedidos</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>

    <h1>Listado de Pedidos</h1>
    <button onclick="self.location.href='añadirpedidos.php'">Nuevo Pedido <i class="fa fa-plus-square"></i></button>
    <table border="1">
        <thead>
            <tr>
                <th>ID</th>
                <th>Fecha de Entrega</th>
                <th>Fecha de Pedido</th>
                <th>Método</th>
                <th>Nombre de Usuario</th>
                <th>Repartidor</th>
                <th>Importe Total</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($fila = $pedidos->fetch_assoc()) {?>
                <tr>
                    <td><?php echo $fila['id'] ?></td>
                    <td><?php echo date("d-m-Y", strtotime($fila['fecha_entrega'])) ?></td>
                    <td><?php echo date("d-m-Y", strtotime($fila['fecha_pedido'])) ?></td>
                    <td><?php echo $fila['metodo'] ?></td>
                    <td><?php echo $fila['nombre_usuario'] ?></td>
                    <td><?php echo $fila['nombre_repartidor'] ?></td>
                    <td><?php echo $fila['TOTAL_PEDIDO'] ? number_format($fila['TOTAL_PEDIDO'], 2, ',', '.') : ''; ?></td>
                    <td aling="center">
            <a href="eliminarPlato.php?id=<?php echo $filasMisPlatos['id'] ?>"><i class="fa-solid fa-trash-can iconoRojo"></i></a>
            <a href="añadirpedidos.php?id=<?php echo $fila['id'] ?>"><i class="fa-solid fa-pen-to-square iconoVerde"></i></a>
        </td>
                </tr>
            <?php }?>

        </tbody>
    </table>
    <a href="index.php">Volver</a>

</body>
</html>
