
<?php 
session_start();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tienda Online</title>
    <link rel="stylesheet" href="../css/estilo.css">
</head>
<body>
    <h1>TIENDA ONLINE HARDWARE</h1>
    <h2>Bienvenido <?php echo $_SESSION['nombre']; ?> </h2>
    <p><a href="iniciarSesion.php">Iniciar sesión</a></p>
    <p><a href="registro.php">Registrarse</a></p>
</body>
</html>