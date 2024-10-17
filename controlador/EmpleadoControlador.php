<?php
// controlador/EmpleadoControlador.php

require_once __DIR__ . '/../modelo/EmpleadoModelo.php';

echo "<script>console.log('Cargando EmpleadoControlador...');</script>";

// Clase controlador para manejar acciones relacionadas con empleados
class EmpleadoControlador {
    private $modelo;

    public function __construct() {
        echo "<script>console.log('Creando instancia de EmpleadoControlador...');</script>";
        $this->modelo = new EmpleadoModelo();
        echo "<script>console.log('EmpleadoModelo instanciado.');</script>";
    }

    // Método para manejar el inicio de sesión
    public function iniciarSesion($identificacion, $password) {
        echo "<script>console.log('Método iniciarSesion llamado con identificación: ' + '$identificacion');</script>";
        try {
            $empleado = $this->modelo->iniciarSesion($identificacion, $password);
            echo "<script>console.log('Resultado de iniciarSesion: ' + '" . json_encode($empleado) . "');</script>";
            
            if ($empleado) {
                echo "<script>console.log('Inicio de sesión exitoso');</script>";
                session_start();
                $_SESSION['empleado_id'] = $empleado['id'];
                echo "<script>console.log('Sesión iniciada. ID de empleado: ' + '" . $empleado['id'] . "');</script>";
                return true;
            } else {
                echo "<script>console.log('Inicio de sesión fallido');</script>";
                return false;
            }
        } catch (Exception $e) {
            echo "<script>console.error('Error en iniciarSesion: ' + '" . $e->getMessage() . "');</script>";
            return false;
        }
    }

    // Otros métodos necesarios...
    public function registrarEmpleado($nombre, $apellido, $identificacion, $password) {
        return $this->modelo->registrarEmpleado($nombre, $apellido, $identificacion, $password);
    }
}

echo "<script>console.log('EmpleadoControlador cargado completamente.');</script>";
?>
