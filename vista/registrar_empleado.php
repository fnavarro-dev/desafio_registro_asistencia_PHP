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
<html>
<head>
    <title>Registrar Nuevo Empleado</title>
</head>
<body>
    <h2>Registrar Nuevo Empleado</h2>
    <?php
    if (isset($mensaje)) {
        echo "<p style='color: green;'>$mensaje</p>";
    }
    if (isset($error)) {
        echo "<p style='color: red;'>$error</p>";
    }
    ?>
    <form method="POST">
        Nombre: <input type="text" name="nombre" required><br>
        Apellido: <input type="text" name="apellido" required><br>
        Identificación: <input type="number" name="identificacion" required><br>
        Contraseña: <input type="password" name="password" required><br>
        <button type="submit">Registrar</button>
    </form>
    <br>
    <a href="/desafio_registro_asistencia_php/vista/login.php">Volver al inicio de sesión</a>
</body>
</html>