<?php
// modelo/EmpleadoModelo.php

// Incluimos el archivo de configuración de la base de datos
require_once 'db_config.php';

/**
 * Clase EmpleadoModelo
 * 
 * Esta clase se encarga de manejar todas las operaciones relacionadas con los empleados en la base de datos.
 * Sigue el patrón de diseño Modelo en la arquitectura MVC (Modelo-Vista-Controlador).
 */
class EmpleadoModelo {
    // Propiedad para almacenar la conexión a la base de datos
    private $conexion;

    /**
     * Constructor de la clase
     * Se ejecuta automáticamente al crear una instancia de EmpleadoModelo
     */
    public function __construct() {
        // Creamos una nueva instancia de la clase Conexion
        $this->conexion = new Conexion();
    }

    /**
     * Método para registrar un nuevo empleado en la base de datos
     * 
     * @param string $nombre Nombre del empleado
     * @param string $apellido Apellido del empleado
     * @param int $identificacion Número de identificación único del empleado
     * @param string $password Contraseña del empleado (se hasheará antes de guardarla)
     * @return bool Retorna true si el registro fue exitoso, false en caso contrario
     */
    public function registrarEmpleado($nombre, $apellido, $identificacion, $password) {
        // Preparamos la consulta SQL con marcadores de posición (?)
        $sql = "INSERT INTO empleados (nombre, apellido, identificacion, password) VALUES (?, ?, ?, ?)";
        
        // Preparamos la sentencia
        $stmt = $this->conexion->conexion->prepare($sql);
        
        // Ejecutamos la sentencia con los valores proporcionados
        // Nota: password_hash() se usa para encriptar la contraseña de forma segura
        $resultado = $stmt->execute([$nombre, $apellido, $identificacion, password_hash($password, PASSWORD_DEFAULT)]);
        
        // Retornamos true si se insertó al menos una fila
        return $resultado && $stmt->rowCount() > 0;
    }

    /**
     * Método para verificar las credenciales de un empleado e iniciar sesión
     * 
     * @param int $identificacion Número de identificación del empleado
     * @param string $password Contraseña ingresada por el empleado
     * @return array|bool Retorna los datos del empleado si las credenciales son correctas, false en caso contrario
     */
    public function iniciarSesion($identificacion, $password) {
        // Preparamos la consulta SQL para buscar al empleado por su identificación
        $sql = "SELECT * FROM empleados WHERE identificacion = ?";
        $stmt = $this->conexion->conexion->prepare($sql);
        $stmt->execute([$identificacion]);
        $empleado = $stmt->fetch();
        
        // Verificamos si se encontró el empleado y si la contraseña es correcta
        if ($empleado && password_verify($password, $empleado['password'])) {
            return $empleado;
        }
        return false;
    }

    /**
     * Método para registrar la asistencia de un empleado
     * 
     * @param int $empleado_id ID del empleado
     * @param string $fecha Fecha de la asistencia (formato: YYYY-MM-DD)
     * @param string $hora_entrada Hora de entrada (formato: HH:MM:SS)
     * @param string|null $hora_salida Hora de salida (formato: HH:MM:SS), puede ser null
     * @return bool Retorna true si el registro fue exitoso, false en caso contrario
     */
    public function registrarAsistencia($empleado_id, $fecha, $hora_entrada, $hora_salida = null) {
        $sql = "INSERT INTO asistencias (empleado_id, fecha, hora_entrada, hora_salida) VALUES (?, ?, ?, ?)";
        $stmt = $this->conexion->conexion->prepare($sql);
        $resultado = $stmt->execute([$empleado_id, $fecha, $hora_entrada, $hora_salida]);
        return $resultado && $stmt->rowCount() > 0;
    }

    // Aquí puedes agregar más métodos según sea necesario, por ejemplo:
    // - obtenerEmpleadoPorId($id)
    // - actualizarEmpleado($id, $datos)
    // - eliminarEmpleado($id)
    // - listarEmpleados()
    // - obtenerAsistenciasPorEmpleado($empleado_id)
    // etc.
}
?>
