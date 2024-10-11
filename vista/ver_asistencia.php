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
?>

<!DOCTYPE html>
<html>
<head>
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
        while ($fila = $asistencias->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $fila['nombre'] . "</td>";
            echo "<td>" . $fila['apellido'] . "</td>";
            echo "<td>" . $fila['fecha'] . "</td>";
            echo "<td>" . $fila['hora_entrada'] . "</td>";
            echo "<td>" . $fila['hora_salida'] . "</td>";
            echo "</tr>";
        }
        ?>
    </table>

    <form method="POST">
        <button type="submit" name="descargar_informe">Descargar Informe</button>
    </form>
</body>
</html>
