<?php
// Este archivo es para probar la conexión a la base de datos
// Debe ser eliminado en producción

// Incluir el archivo de configuración de la base de datos
require_once 'modelo/db_config.php';

// Incluir el modelo de Empleado
require_once 'modelo/EmpleadoModelo.php';

$modelo = new EmpleadoModelo();
$identificacion = 12345;
$password = 'password';

$resultado = $modelo->iniciarSesion($identificacion, $password);

if ($resultado) {
    echo "Usuario encontrado:<br>";
    print_r($resultado);
} else {
    echo "Usuario no encontrado o contraseña incorrecta.";
}
?>