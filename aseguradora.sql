-- Crear base de datos
DROP DATABASE IF EXISTS aseguradora;
CREATE DATABASE aseguradora;
USE aseguradora;

-- Tabla de planes disponibles
CREATE TABLE planes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre_producto VARCHAR(100) NOT NULL,
    valor INT NOT NULL
);

-- Insertar 3 planes de ejemplo
INSERT INTO planes (nombre_producto, valor) VALUES
('Plan Básico', 500000),
('Plan Estándar', 750000),
('Plan Premium', 1000000);

-- Tabla de cotizaciones realizadas
CREATE TABLE cotizaciones (
    id INT AUTO_INCREMENT PRIMARY KEY,
    no_cotizacion VARCHAR(20) NOT NULL UNIQUE,
    nombre VARCHAR(100) NOT NULL,
    apellidos VARCHAR(100) NOT NULL,
    fecha_nacimiento DATE NOT NULL,
    placa VARCHAR(6) NOT NULL,
    fecha_cotizacion TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Relación cotizaciones con planes (una cotización tiene 3 planes)
CREATE TABLE cotizacion_planes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    cotizacion_id INT NOT NULL,
    plan_id INT NOT NULL,
    FOREIGN KEY (cotizacion_id) REFERENCES cotizaciones(id) ON DELETE CASCADE,
    FOREIGN KEY (plan_id) REFERENCES planes(id) ON DELETE CASCADE
);
