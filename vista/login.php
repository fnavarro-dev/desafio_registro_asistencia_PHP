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

<!-- HTML del formulario de login -->
<!-- Esta es la Vista para el formulario de inicio de sesión -->
<!DOCTYPE html>
   <html>
   <head>
       <meta charset="UTF-8">
       <title>Sistema de Asistencia</title>
   </head>
<body>
    <h2>Sistema de Asistencia</h2>
    <?php
    if (isset($error)) {
        echo "<p style='color: red;'>$error</p>";
    }
    ?>
    <h3>Iniciar Sesión como Empleado</h3>
    <form method="POST">
        Identificación: <input type="number" name="identificacion" required><br>
        Contraseña: <input type="password" name="password" required><br>
        <button type="submit" name="login">Ingresar</button>
    </form>

    <h3>Iniciar Sesión como Administrador</h3>
    <form method="POST" action="/desafio_registro_asistencia_php/vista/ver_asistencia.php">
        <button type="submit" name="admin_login">Acceso Administrador</button>
    </form>

    <h3>Registrar Nuevo Empleado</h3>
    <a href="/desafio_registro_asistencia_php/vista/registrar_empleado.php">Registrar Nuevo Empleado</a>
</body>
</html>
