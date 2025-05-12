# 🛡️ Cotizador de Seguros de Automóviles

Este proyecto es una prueba técnica de desarrollo **Full Stack** utilizando **PHP nativo**, **JavaScript**, y **Bootstrap**, implementando el patrón de diseño **MVC**.

## 📦 Estructura del Proyecto

/** 
/
├── cliente/                # Front-End con HTML, Bootstrap y JS
├── api_sga/                # API Intermediaria (SGA)
├── api_aseguradora/        # API con BD que retorna las cotizaciones
└── aseguradora.sql         # Script SQL para la base de datos
*/

## 🚀 Tecnologías Usadas
PHP Nativo (7.4+)

JavaScript / Fetch API

HTML5 + Bootstrap 5

MySQL MariaDB

Apache o XAMPP/Laragon

## ⚙️ Requisitos Previos
PHP 7.4+

MySQL/MariaDB

Servidor local (Apache con XAMPP, Laragon o similar)

Git (opcional)

## 🧰 Instalación y Configuración

1. Clonar el repositorio
git clone https://github.com/j05hg1/cotizador-seguros.git

2. Configurar la base de datos
Importa el archivo aseguradora.sql en tu gestor de base de datos (phpMyAdmin, DBeaver, etc.)

Asegúrate de que la base se llame aseguradora.

3. Verifica configuración de conexión en:
📄 api_aseguradora/config/database.php
private $host = "localhost";
private $db_name = "aseguradora";
private $username = "root";
private $password = "";
Ajusta el usuario y contraseña según tu entorno.

4. Coloca los proyectos en tu servidor local
Copia las carpetas /api_sga, /api_aseguradora y /cliente dentro de htdocs/ (XAMPP) o www/ (Laragon).

Asegúrate de que los siguientes endpoints estén accesibles:
http://localhost/api_sga/index.php/cotizar
http://localhost/api_aseguradora/index.php/cotizar
http://localhost/cliente/index.html

## ✅ Cómo Probar
1.Accede a http://localhost/cliente/index.html.
en caso de haber asignado un puerto (ej: 8085) acceder a http://localhost:8085/cliente/index.html

2.Llena el formulario con los datos requeridos.

3.Haz clic en "Cotizar".

4.Si todo es correcto, verás las 3 ofertas en la tabla.

5.Si hay errores (como placa inválida o campos vacíos), se mostrarán en pantalla.

## 📋 Validaciones
Placa: formato ABC123 (3 letras + 3 números)

Todos los campos son obligatorios

El formulario no se envía si hay errores

## 📁 Estructura del Código
MVC básico: separados los modelos, controladores y vistas.

AJAX/Fetch: usado para enviar datos desde el Front-End a la API SGA.

API intermediaria (SGA): recibe datos, los valida, y reenvía a la API aseguradora.

API aseguradora: consulta una base de datos y devuelve 3 planes como cotizaciones.

