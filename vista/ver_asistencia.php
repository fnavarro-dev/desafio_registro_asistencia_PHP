<!-- vista/ver_asistencia.php -->

<!-- Esta es la Vista para que los administradores vean los registros de asistencia -->
<?php
// Comentamos o eliminamos la verificación de administrador
// session_start();
// if (!isset($_SESSION['admin'])) {
//     header("Location: login.php");
//     exit;
// }

require_once '../controlador/AsistenciaControlador.php';
$asistenciaControlador = new AsistenciaControlador();

if (isset($_POST['descargar_informe'])) {
    $asistenciaControlador->descargarInforme();
    exit;
}

$asistencias = $asistenciaControlador->verAsistencias();
echo "<script>console.log('Registros de asistencia obtenidos:', " . json_encode($asistencias) . ");</script>";
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registros de Asistencia</title>
</head>
<body>
    <h2>Registros de Asistencia</h2>
    <table border="1">
        <tr>
            <th>Nombre</th>
            <th>Apellido</th>
            <th>Fecha</th>
            <th>Hora de Entrada</th>
            <th>Hora de Salida</th>
        </tr>
        <?php
        if ($asistencias && is_array($asistencias)) {
            foreach ($asistencias as $asistencia) {
                echo "<tr>";
                echo "<td>" . htmlspecialchars($asistencia['nombre']) . "</td>";
                echo "<td>" . htmlspecialchars($asistencia['apellido']) . "</td>";
                echo "<td>" . htmlspecialchars($asistencia['fecha']) . "</td>";
                echo "<td>" . htmlspecialchars($asistencia['hora_entrada']) . "</td>";
                echo "<td>" . htmlspecialchars($asistencia['hora_salida']) . "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='5'>No hay registros de asistencia disponibles.</td></tr>";
        }
        ?>
    </table>

    <form method="POST">
        <button type="submit" name="descargar_informe">Descargar Informe</button>
    </form>
</body>
</html>
