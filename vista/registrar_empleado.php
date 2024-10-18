<?php
require_once '../controlador/EmpleadoControlador.php';

$controlador = new EmpleadoControlador();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $identificacion = $_POST['identificacion'];
    $password = $_POST['password'];

    echo "<script>console.log('Datos recibidos: ', " . json_encode([
        'nombre' => $nombre,
        'apellido' => $apellido,
        'identificacion' => $identificacion,
        'password' => '[OCULTO]'
    ]) . ");</script>";

    // Aqui no habrá generación de hash, lo haremos en el modelo (EmpleadoModelo.php)

    $resultado = $controlador->registrarEmpleado($nombre, $apellido, $identificacion, $password);

    if ($resultado) {
        echo "<script>console.log('Registro exitoso');</script>";
        $mensaje = "Empleado registrado con éxito.";
    } else {
        echo "<script>console.log('Fallo al registrar empleado');</script>";
        $error = "Error al registrar el empleado.";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar Nuevo Empleado</title>
    <link rel="stylesheet" href="/desafio_registro_asistencia_php/css/registrar_empleado.css">
</head>
<body>
    <div class="container">
        <h2>Registrar Nuevo Empleado</h2>
        <?php
        if (isset($mensaje)) {
            echo "<p class='mensaje exito'>$mensaje</p>";
        }
        if (isset($error)) {
            echo "<p class='mensaje error'>$error</p>";
        }
        ?>
        <form method="POST">
            <label for="nombre">Nombre:</label>
            <input type="text" id="nombre" name="nombre" required>
            
            <label for="apellido">Apellido:</label>
            <input type="text" id="apellido" name="apellido" required>
            
            <label for="identificacion">Identificación:</label>
            <input type="number" id="identificacion" name="identificacion" required>
            
            <label for="password">Contraseña:</label>
            <input type="password" id="password" name="password" required>
            
            <button type="submit">Registrar</button>
        </form>
        <a href="/desafio_registro_asistencia_php/vista/login.php">Volver al inicio de sesión</a>
    </div>
</body>
</html>
