<?php
require_once("conexion.php");
include("verificar_session.php");

$accion = isset($_GET['id']) && !empty($_GET['id']) ? 1 : 0;

if ($accion == 1) {
    // Si estamos editando, recuperamos los datos del pedido específico
    $mipedido = $mysqli->query("SELECT * FROM pedidos WHERE id=" . intval($_GET['id']));
    $filamipedido = $mipedido->fetch_assoc();
    // Asignar los valores recuperados del pedido específico a las variables correspondientes
    $nombreAccion = "Editar Pedido";
    $vPedidoID = $filamipedido['id'];
    $vmetodo = $filamipedido['metodo_id'];
    $vpago = $filamipedido['pago_id'];
    $vrepartidor = $filamipedido['repartidor_id'];
    $vusuario = $filamipedido['usuario_id'];
    $vconfirmado = $filamipedido['confirmado'];
    $boton = "Editar Pedido";
} else {
    // Si estamos insertando un nuevo pedido, inicializamos las variables vacías
    $nombreAccion = "Insertar Pedido";
    $vPedidoID = "";
    $vpago = "";
    $vrepartidor = "";
    $vusuario = "";
    $ventrega = "";
    $vmetodo = "";
    $vconfirmado = "";
    $vtotal_pedido = "";
    $boton = "Insertar Pedido";
}


?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $nombreAccion; ?></title>
</head>

<body>
    <h1><?php echo $nombreAccion ." Numero " .$vPedidoID; ?> </h1>
    <form action="finalpedido.php" method="post">

        <!-- Campos ocultos para el control de la acción y el ID del pedido -->
        <input type="hidden" id="accion" name="accion" value="<?php echo ($accion == 1 ? 'editar' : 'insertar'); ?>">
        
        <input type="hidden" id="id" name="id" value="<?php echo $vPedidoID; ?>">
        <!--Campo de metodo -->
        <div>
            <label for="metodo">Método</label>
           <select id="metodo" name="metodo">
                <?php
                $metodos = $mysqli->query("SELECT id, canal FROM metodo");
                if ($metodos->num_rows > 0) {
                    while ($fila = $metodos->fetch_assoc()) {
                        echo "<option value='" . $fila['id'] . "'>" . $fila['canal'] . "</option>";
                    }
                } else {
                    echo "<option value=''>No hay métodos disponibles</option>";
                }
                ?>
            </select>
        <!-- Selector de platos -->
        <div>
    <label for="platos">Platos</label>
    <select id="platos" name="platos">
        <?php
        $platos_query = "SELECT id, nombre FROM platos"; 
        $platos_result = $mysqli->query($platos_query);

        if ($platos_result && $platos_result->num_rows > 0) {
            while ($fila = $platos_result->fetch_assoc()) {
                echo '<option value="' . $fila['id'] . '">' . $fila['nombre'] . '</option>';
            }
        } else {
            echo '<option value="">No hay platos disponibles</option>';
        }
        ?>
    </select>
</div>
        <!-- Selector de métodos de pago -->
        <div>
            <label for="pago">Pago</label>
            <select id="pago" name="pago">
                <?php
                $pagos = $mysqli->query("SELECT id, metodo FROM pago");
                if ($pagos->num_rows > 0) {
                    while ($fila = $pagos->fetch_assoc()) {
                        echo "<option value='"  .$fila['id']. "'>" . $fila['metodo'] . "</option>";
                    }
                } else {
                    echo "<option value=''>No hay métodos de pago disponibles</option>";
                }
                ?>
            </select>
        </div>

        <!-- Selector de repartidores -->
        <div>
            <label for="repartidor">Repartidor</label>
            <select id="repartidor" name="repartidor">
                <?php
                $repartidores = $mysqli->query("SELECT id, nombre FROM repartidor");
                if ($repartidores->num_rows > 0) {
                    while ($fila = $repartidores->fetch_assoc()) {
                        echo "<option value='" . $fila['id'] . "'>" . $fila['nombre'] . "</option>";
                    }
                } else {
                    echo "<option value=''>No hay repartidores disponibles</option>";
                }
                ?>
            </select>
        </div>

        <!-- Campo de usuario -->
        <div>
            <label for="usuario">Usuario</label>
            <input type="text" id="usuario" name="usuario" value="<?php echo $vusuario; ?>">
        </div>

        <!-- Selector de tipo de entrega -->
        <div>
            <label for="entrega">Entrega</label>
            <select id="entrega" name="entrega">
                <?php
                $entregas = $mysqli->query("SELECT id, modo FROM entrega");
                if ($entregas->num_rows > 0) {
                    while ($fila = $entregas->fetch_assoc()) {
                        echo "<option value='" . $fila['id'] . "'>" . $fila['modo'] . "</option>";
                    }
                } else {
                    echo "<option value=''>No hay tipos de entrega disponibles</option>";
                }
                ?>
            </select>
        </div>
    

    
        <!-- Campo de confirmación -->
        <div>
            <label for="confirmado">Confirmado</label>
            <input type="text" id="confirmado" name="confirmado" value="<?php echo $vconfirmado; ?>">
        </div>
        <!-- Botón de enviar formulario -->
        <div>
            <input type="submit" value="<?php echo $boton; ?>">
        </div>

        <!-- Enlace para volver -->
        <div>
            <a href="pedidos.php">Volver</a>
        </div>

    </form>
</body>

</html>
