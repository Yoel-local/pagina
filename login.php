<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio sesión</title>
    <link rel="stylesheet" href="css/loginn.css">
</head>
<body>
    <form action="sesion.php" method="POST">
        <h1>Iniciar sesión</h1>
    
        
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
              
        <label for="usuario">Usuario</label>
        <input type="text" name="usuario" id="usuario" placeholder="Nombre de usuario">
     
        <label for="clave">Contraseña</label>
        
        <input type="password" name="clave" id="clave" placeholder="Contraseña">
   
        <input type="submit" value="Iniciar sesión">
        <button type="button" onclick="self.location.href='crearcuenta.php'">Crear Cuenta</button>
        </div>
        
    </form>
    <!--<script>
        // Seleccionar el formulario
        const form = document.querySelector('form');

        // Agregar el evento de movimiento del ratón
        document.addEventListener('mousemove', (e) => {
            const x = (window.innerWidth / 2 - e.pageX) / 25;
            const y = (window.innerHeight / 2 - e.pageY) / 25;

            // Aplicar la transformación al formulario
            form.style.transform = `rotateY(${x}deg) rotateX(${y}deg)`;
        });

        // Resetear la posición al salir del área del formulario
        form.addEventListener('mouseleave', () => {
            form.style.transform = `rotateY(0deg) rotateX(0deg)`;
        });
    </script>
    -->
</body>
</html>
