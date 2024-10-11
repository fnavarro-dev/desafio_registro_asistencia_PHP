<?php
// controlador/AsistenciaControlador.php

require_once '../modelo/AsistenciaModelo.php';

// Clase controlador para manejar acciones relacionadas con asistencia
class AsistenciaControlador {
    private $modelo;

    public function __construct() {
        $this->modelo = new AsistenciaModelo();
    }

    // Método para registrar entrada
    public function registrarEntrada($empleado_id) {
        $this->modelo->registrarEntrada($empleado_id);
        echo "Entrada registrada exitosamente.";
    }

    // Método para registrar salida
    public function registrarSalida($empleado_id) {
        $this->modelo->registrarSalida($empleado_id);
        echo "Salida registrada exitosamente.";
    }

    // Método para mostrar registros de asistencia
    public function verAsistencias() {
        return $this->modelo->obtenerAsistencias();
    }

    // Otros métodos necesarios...
}
?>
