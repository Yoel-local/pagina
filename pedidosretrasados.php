<?php
 require_once("conexion.php");

 include("verificar_session.php");
$pedidosatrasados = $mysqli->query("CALL Procedimiento_Pedidos_Tarde()");
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pedidos con retraso de más de 1 hora</title>
    <link rel="stylesheet" href="css/platos.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    
</head>
<body>
    <h2>Pedidos con retraso de más de 1 hora</h2>

    <table border="1">
        <thead>
            <tr>
                <th>ID</th>
                <th>Fecha entrega</th>
                <th>Fecha Pedido</th>
                <th>Importe</th>
                <th>Nombre</th>
                <th>Retraso (minutos)</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($fila = $pedidosatrasados->fetch_assoc()) { ?>
                <tr>
                    <td><?php echo $fila['id']?></td>
                    <td><?php echo date("d-m-Y", strtotime($fila['fecha_entrega'])) ?></td>
                    <td><?php echo date("d-m-Y", strtotime($fila['fecha_pedido'])) ?></td>
                    <td><?php echo $fila['TOTAL_PEDIDO']?></td>
                    <td><?php echo $fila['nombre']   ?>
                    </td>
                    <td><?php
                        // Calcular el retraso en minutos entre fecha_entrega y fecha_pedido
                        $fechaEntrega = new DateTime($fila['fecha_entrega']);
                        $fechaPedido = new DateTime($fila['fecha_pedido']);
                        $diferencia = $fechaEntrega->diff($fechaPedido);
                        $retrasoEnMinutos = $diferencia->h * 60 + $diferencia->i; // Horas * 60 + Minutos
                        echo $retrasoEnMinutos;
                    ?></td>
                </tr>
            <?php } ?>
        </tbody>
        <button class="btn-volver" onclick="self.location.href='index.php'"><i class="fa fa-arrow-left"></i> Volver</button>

    </table>
    <a href="platos.php"><h2><- Ver Platos</h2></a>
</body>
</html>



