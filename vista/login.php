<!-- vista/login.php -->
<?php
require_once '../controlador/EmpleadoControlador.php';

echo "<script>console.log('Iniciando proceso de login...');</script>";

$controlador = new EmpleadoControlador();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
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
}
?>

<!-- HTML del formulario de login -->
<!-- Esta es la Vista para el formulario de inicio de sesión -->
<!DOCTYPE html>
<html>
<head>
    <title>Inicio de Sesión</title>
</head>
<body>
    <h2>Iniciar Sesión</h2>
    <?php
    if (isset($error)) {
        echo "<p style='color: red;'>$error</p>";
    }
    ?>
    <form method="POST">
        Identificación: <input type="number" name="identificacion" required><br>
        Contraseña: <input type="password" name="password" required><br>
        <button type="submit">Ingresar</button>
    </form>
</body>
</html>
