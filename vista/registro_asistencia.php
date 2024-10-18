<!-- vista/registro_asistencia.php -->

<!-- Esta es la Vista para registrar la entrada y salida del empleado -->
<?php
// Verificar si el empleado ha iniciado sesión
session_start();
if (!isset($_SESSION['empleado_id'])) {
    header("Location: login.php");
    exit;
}

// Incluir el controlador de asistencia
require_once '../controlador/AsistenciaControlador.php';
$asistenciaControlador = new AsistenciaControlador();
$empleado_id = $_SESSION['empleado_id'];



// Manejar la acción de cerrar sesión
if (isset($_POST['cerrar_sesion'])) {
    session_destroy();
    header("Location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Asistencia</title>
    <link rel="stylesheet" href="/desafio_registro_asistencia_php/css/registro_asistencia.css">
</head>
<body>
    <div class="container">
        <h2>Registrar Asistencia</h2>
        <form method="POST" action="registro_asistencia.php">
            <button type="submit" name="entrada">Registrar Entrada</button>
            <button type="submit" name="salida">Registrar Salida</button>
        </form>
        <form method="POST" action="registro_asistencia.php">
            <button type="submit" name="cerrar_sesion">Cerrar Sesión</button>
        </form>

        <?php
        // Este PHP se puede poner directo en el HTML así el echo que se muestra en el navegador queda dentro del div y con el mismo estilo
        // Manejar las acciones de entrada y salida
        if (isset($_POST['entrada'])) {
            $asistenciaControlador->registrarEntrada($empleado_id);
        }

        if (isset($_POST['salida'])) {
            $asistenciaControlador->registrarSalida($empleado_id);
        }
        ?>
    </div>
</body>
</html>


