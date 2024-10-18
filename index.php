<?php
// Iniciamos la sesión (importante para manejar el estado de login)
session_start();

// Incluir el controlador de empleados
require_once __DIR__ . './controlador/EmpleadoControlador.php';

// Verificar si el usuario ya está logueado
if (isset($_SESSION['usuario_id'])) {
    // Si está logueado, redirigir a la página principal
    header("Location: ./vista/registro_asistencia.php");
    exit();
}

// Procesar el formulario de login si se envía
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['login'])) {
    $identificacion = $_POST['identificacion'];
    $password = $_POST['password'];

    $empleadoControlador = new EmpleadoControlador();
    $resultado = $empleadoControlador->iniciarSesion($identificacion, $password);
    
    if ($resultado) {
        // Si el login es exitoso, redirigir a la página principal
        header("Location: ./vista/registro_asistencia.php");
        exit();
    } else {
        // Si el login falla, redirigir al login con un mensaje de error
        header("Location: ./vista/login.php?error=1");
        exit();
    }
} else {
    // Si no es una solicitud POST de login, mostrar el formulario de inicio de sesión
    include './vista/login.php';
}
?>
