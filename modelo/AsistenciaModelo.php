<?php
// modelo/AsistenciaModelo.php

require_once '../modelo/db_config.php';

// Clase modelo para manejar los datos de asistencia
class AsistenciaModelo {
    private $conexion;

    public function __construct() {
        $db = new Conexion();
        $this->conexion = $db->conexion;
    }

    // Método para registrar la entrada del empleado
    public function registrarEntrada($empleado_id) {
        echo "<script>console.log('Intentando registrar entrada para empleado ID: ' + '$empleado_id');</script>";
        try {
            $sql = "INSERT INTO asistencias (empleado_id, fecha, hora_entrada) VALUES (:empleado_id, CURDATE(), NOW())";
            $stmt = $this->conexion->prepare($sql);
            $stmt->bindParam(':empleado_id', $empleado_id, PDO::PARAM_INT);
            $resultado = $stmt->execute();
            
            echo "<script>console.log('Resultado de registrar entrada: ' + '" . json_encode($resultado) . "');</script>";
            
            return $resultado;
        } catch (PDOException $e) {
            echo "<script>console.error('Error al registrar entrada: ' + '" . $e->getMessage() . "');</script>";
            return false;
        }
    }

    // Método para registrar la salida del empleado
    public function registrarSalida($empleado_id) {
        echo "<script>console.log('Intentando registrar salida para empleado ID: ' + '$empleado_id');</script>";
        try {
            $sql = "UPDATE asistencias SET hora_salida = NOW() WHERE empleado_id = :empleado_id AND fecha = CURDATE() AND hora_salida IS NULL";
            $stmt = $this->conexion->prepare($sql);
            $stmt->bindParam(':empleado_id', $empleado_id, PDO::PARAM_INT);
            $resultado = $stmt->execute();
            
            echo "<script>console.log('Resultado de registrar salida: ' + '" . json_encode($resultado) . "');</script>";
            
            return $resultado;
        } catch (PDOException $e) {
            echo "<script>console.error('Error al registrar salida: ' + '" . $e->getMessage() . "');</script>";
            return false;
        }
    }

    // Método para obtener los registros de asistencia
    public function obtenerAsistencias() {
        $sql = "SELECT e.nombre, e.apellido, a.fecha, a.hora_entrada, a.hora_salida FROM asistencias a JOIN empleados e ON a.empleado_id = e.id";
        $resultado = $this->conexion->conexion->query($sql);
        return $resultado;
    }

    // Otros métodos necesarios...
}
?>
