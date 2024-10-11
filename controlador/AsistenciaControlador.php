<?php
// controlador/AsistenciaControlador.php

require_once '../modelo/AsistenciaModelo.php';

echo "<script>console.log('Cargando AsistenciaControlador...');</script>";

class AsistenciaControlador {
    private $modelo;

    public function __construct() {
        echo "<script>console.log('Creando instancia de AsistenciaControlador...');</script>";
        $this->modelo = new AsistenciaModelo();
        echo "<script>console.log('AsistenciaControlador: Modelo instanciado');</script>";
    }

    // Método para registrar entrada
    public function registrarEntrada($empleado_id) {
        echo "<script>console.log('Intentando registrar entrada para empleado ID: ' + '$empleado_id');</script>";
        $resultado = $this->modelo->registrarEntrada($empleado_id);
        if ($resultado) {
            echo "Entrada registrada exitosamente.";
            echo "<script>console.log('Entrada registrada exitosamente.');</script>";
        } else {
            echo "Error al registrar entrada.";
            echo "<script>console.log('Error al registrar entrada.');</script>";
        }
    }

    // Método para registrar salida
    public function registrarSalida($empleado_id) {
        echo "<script>console.log('Intentando registrar salida para empleado ID: ' + '$empleado_id');</script>";
        $resultado = $this->modelo->registrarSalida($empleado_id);
        if ($resultado) {
            echo "Salida registrada exitosamente.";
            echo "<script>console.log('Salida registrada exitosamente.');</script>";
        } else {
            echo "Error al registrar salida.";
            echo "<script>console.log('Error al registrar salida.');</script>";
        }
    }

    // Método para mostrar registros de asistencia
    public function verAsistencias() {
        echo "<script>console.log('AsistenciaControlador: Solicitando asistencias al modelo...');</script>";
        $asistencias = $this->modelo->obtenerAsistencias();
        echo "<script>console.log('AsistenciaControlador: Asistencias recibidas del modelo');</script>";
        return $asistencias;
    }

    // Método para descargar informe
    public function descargarInforme() {
        echo "<script>console.log('Iniciando descarga de informe...');</script>";
        
        // Obtener los datos de asistencia
        $asistencias = $this->modelo->obtenerAsistencias();
        
        // Nombre del archivo
        $filename = 'informe_asistencia_' . date('Y-m-d') . '.csv';
        
        // Cabeceras para forzar la descarga
        header('Content-Type: text/csv');
        header('Content-Disposition: attachment; filename="' . $filename . '"');
        
        // Abrir el output stream
        $output = fopen('php://output', 'w');
        
        // Añadir BOM para UTF-8
        fprintf($output, chr(0xEF).chr(0xBB).chr(0xBF));
        
        // Escribir la cabecera del CSV
        fputcsv($output, array('ID', 'Nombre', 'Apellido', 'Fecha', 'Hora Entrada', 'Hora Salida'));
        
        // Escribir los datos
        while ($fila = $asistencias->fetch_assoc()) {
            fputcsv($output, array(
                $fila['id'],
                $fila['nombre'],
                $fila['apellido'],
                $fila['fecha'],
                $fila['hora_entrada'],
                $fila['hora_salida']
            ));
        }
        
        // Cerrar el stream
        fclose($output);
        
        echo "<script>console.log('Informe generado y descargado.');</script>";
        exit;
    }
}

echo "<script>console.log('AsistenciaControlador cargado completamente.');</script>";
?>
