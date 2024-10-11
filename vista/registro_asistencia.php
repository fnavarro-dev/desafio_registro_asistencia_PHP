<!-- vista/registro_asistencia.php -->

<!-- Esta es la Vista para registrar la entrada y salida del empleado -->
<?php
// Verificar si el empleado ha iniciado sesión
session_start();
if (!isset($_SESSION['empleado_id'])) {
    header("Location: login.php");
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Registro de Asistencia</title>
</head>
<body>
    <h2>Registrar Asistencia</h2>
    <form method="POST" action="registro_asistencia.php">
        <button type="submit" name="entrada">Registrar Entrada</button>
        <button type="submit" name="salida">Registrar Salida</button>
    </form>
</body>
</html>

<?php
// Incluir el controlador de asistencia
require_once '../controlador/AsistenciaControlador.php';
$asistenciaControlador = new AsistenciaControlador();
$empleado_id = $_SESSION['empleado_id'];

// Manejar las acciones de entrada y salida
if (isset($_POST['entrada'])) {
    $asistenciaControlador->registrarEntrada($empleado_id);
}

if (isset($_POST['salida'])) {
    $asistenciaControlador->registrarSalida($empleado_id);
}
?>
