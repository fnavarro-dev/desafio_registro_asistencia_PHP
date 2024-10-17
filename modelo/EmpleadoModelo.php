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
        try {
            $db = new Conexion();
            $this->conexion = $db->conexion;
            echo "<script>console.log('Conexión establecida en EmpleadoModelo');</script>";
        } catch (Exception $e) {
            echo "<script>console.error('Error al establecer conexión en EmpleadoModelo: ' + " . json_encode($e->getMessage()) . ");</script>";
            error_log("Error al establecer conexión en EmpleadoModelo: " . $e->getMessage());
        }
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
        echo "<script>console.log('Intentando registrar empleado en la base de datos...');</script>";
        try {
            $sql = "INSERT INTO empleados (nombre, apellido, identificacion, password) VALUES (?, ?, ?, ?)";
            $stmt = $this->conexion->prepare($sql);
            $passwordHash = password_hash($password, PASSWORD_DEFAULT);
            echo "<script>console.log('Hash generado: ', '" . $passwordHash . "');</script>";
            
            $stmt->bindParam(1, $nombre, PDO::PARAM_STR);
            $stmt->bindParam(2, $apellido, PDO::PARAM_STR);
            $stmt->bindParam(3, $identificacion, PDO::PARAM_STR);
            $stmt->bindParam(4, $passwordHash, PDO::PARAM_STR);
            
            $resultado = $stmt->execute();
            
            if ($resultado) {
                echo "<script>console.log('Empleado registrado exitosamente');</script>";
                return true;
            } else {
                echo "<script>console.log('No se pudo registrar el empleado');</script>";
                return false;
            }
        } catch (PDOException $e) {
            echo "<script>console.error('Error al registrar empleado: ' + " . json_encode($e->getMessage()) . ");</script>";
            error_log("Error al registrar empleado: " . $e->getMessage());
            return false;
        }
    }

    /**
     * Método para verificar las credenciales de un empleado e iniciar sesión
     * 
     * @param int $identificacion Número de identificación del empleado
     * @param string $password Contraseña ingresada por el empleado
     * @return array|bool Retorna los datos del empleado si las credenciales son correctas, false en caso contrario
     */
    public function iniciarSesion($identificacion, $password) {
        echo "<script>console.log('Intentando iniciar sesión...');</script>";
        try {
            // Usamos directamente $this->conexion, no $this->conexion->conexion
            $sql = "SELECT * FROM empleados WHERE identificacion = ?";
            $stmt = $this->conexion->prepare($sql);
            $stmt->execute([$identificacion]);
            $empleado = $stmt->fetch(PDO::FETCH_ASSOC);
            
            echo "<script>console.log('Empleado encontrado: ', " . json_encode($empleado ? 'Sí' : 'No') . ");</script>";
            
            if ($empleado) {
                echo "<script>console.log('Hash almacenado: ', '" . $empleado['password'] . "');</script>";
                echo "<script>console.log('Contraseña ingresada: ', '" . $password . "');</script>";
                
                $esValido = password_verify($password, $empleado['password']);
                echo "<script>console.log('¿Contraseña válida? ', " . ($esValido ? 'Sí' : 'No') . ");</script>";
                
                if ($esValido) {
                    return $empleado;
                }
            }
            return false;
        } catch (PDOException $e) {
            echo "<script>console.error('Error al iniciar sesión: ' + " . json_encode($e->getMessage()) . ");</script>";
            error_log("Error al iniciar sesión: " . $e->getMessage());
            return false;
        }
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

    // Aquí se pueden agregar más métodos según sea necesario, por ejemplo:
    // - obtenerEmpleadoPorId($id)
    // - actualizarEmpleado($id, $datos)
    // - eliminarEmpleado($id)
    // - listarEmpleados()
    // - obtenerAsistenciasPorEmpleado($empleado_id)
    // etc.
}
?>
