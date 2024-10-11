<!-- vista/ver_asistencia.php -->

<!-- Esta es la Vista para que los administradores vean los registros de asistencia -->
<?php
// Verificar si el administrador ha iniciado sesión
session_start();
// Se asume que hay un mecanismo para verificar si es administrador
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
}
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
        // Incluir el controlador de asistencia
        require_once '../controlador/AsistenciaControlador.php';
        $asistenciaControlador = new AsistenciaControlador();
        $asistencias = $asistenciaControlador->verAsistencias();

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
</body>
</html>
