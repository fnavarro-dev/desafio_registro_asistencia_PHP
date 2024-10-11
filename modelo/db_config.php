<?php
// modelo/db_config.php

class Conexion {
    private $host = "localhost";
    private $usuario = "root";
    private $contraseña = "";
    private $base_datos = "empresa_xyz";
    private $charset = "utf8mb4";
    public $conexion;

    public function __construct() {
        $dsn = "mysql:host={$this->host};dbname={$this->base_datos};charset={$this->charset}";
        $opciones = [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES   => false,
        ];
        try {
            $this->conexion = new PDO($dsn, $this->usuario, $this->contraseña, $opciones);
            echo "<script>console.log('Conexión a la base de datos establecida');</script>";
        } catch (PDOException $e) {
            echo "<script>console.error('Error de conexión: ' + '" . $e->getMessage() . "');</script>";
            die("Error de conexión: " . $e->getMessage());
        }
    }

    // Método para cerrar la conexión
    public function cerrarConexion() {
        $this->conexion = null;
        echo "<script>console.log('Conexión a la base de datos cerrada');</script>";
    }
}
?>
