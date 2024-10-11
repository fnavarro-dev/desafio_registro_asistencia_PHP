-- Creamos la base de datos si no existe
CREATE DATABASE IF NOT EXISTS empresa_xyz;

-- Seleccionamos la base de datos para usar
USE empresa_xyz;

-- Creamos la tabla de empleados
CREATE TABLE empleados (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    apellido VARCHAR(100) NOT NULL,
    identificacion INT UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL
);

-- Creamos la tabla de asistencias
CREATE TABLE asistencias (
    id INT AUTO_INCREMENT PRIMARY KEY,
    empleado_id INT,
    fecha DATE NOT NULL,
    hora_entrada TIME NOT NULL,
    hora_salida TIME,
    FOREIGN KEY (empleado_id) REFERENCES empleados(id)
);