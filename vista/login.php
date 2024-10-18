<!-- vista/login.php -->
<?php
require_once __DIR__ . '/../controlador/EmpleadoControlador.php';

echo "<script>console.log('Iniciando proceso de login...');</script>";

$controlador = new EmpleadoControlador();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['login'])) {
        $identificacion = $_POST['identificacion'];
        $password = $_POST['password'];

        echo "<script>console.log('Formulario enviado con identificación: $identificacion');</script>";

        $resultado = $controlador->iniciarSesion($identificacion, $password);
        echo "<script>console.log('Resultado de iniciarSesion: ' + '" . json_encode($resultado) . "');</script>";

        if ($resultado) {
            echo "<script>console.log('Redirigiendo a registro_asistencia.php');</script>";
            header("Location: registro_asistencia.php");
            exit;
        } else {
            $error = "Identificación o contraseña incorrecta.";
            echo "<script>console.log('Error de inicio de sesión: $error');</script>";
        }
    } elseif (isset($_POST['admin_login'])) {
        // Aquí iría la lógica para el inicio de sesión del administrador
        // Por ahora, simplemente redirigimos a ver_asistencia.php
        header("Location: ver_asistencia.php");
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de Asistencia</title>
    <link rel="stylesheet" href="/desafio_registro_asistencia_php/css/login.css">
</head>
<body>
    <div class="container">
        <h2>Sistema de Asistencia</h2>
        <?php
        if (isset($error)) {
            echo "<p class='error'>$error</p>";
        }
        ?>
        <h3>Iniciar Sesión como Empleado</h3>
        <form method="POST">
            <input type="number" name="identificacion" placeholder="Identificación" required>
            <input type="password" name="password" placeholder="Contraseña" required>
            <button type="submit" name="login">Ingresar</button>
        </form>

        <h3>Iniciar Sesión como Administrador</h3>
        <form method="POST" action="/desafio_registro_asistencia_php/vista/ver_asistencia.php">
            <button type="submit" name="admin_login">Acceso Administrador</button>
        </form>

        <h3>Registrar Nuevo Empleado</h3>
        <a href="/desafio_registro_asistencia_php/vista/registrar_empleado.php">Registrar Nuevo Empleado</a>
    </div>
</body>
</html>
