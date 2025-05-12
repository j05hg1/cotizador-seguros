<?php
require_once './controllers/CotizarController.php';

// Ruta simple tipo RESTful
$requestUri = $_SERVER['REQUEST_URI'];
$requestMethod = $_SERVER['REQUEST_METHOD'];

if ($requestUri === '/cotizar' || strpos($requestUri, '/cotizar') !== false) {
    $controller = new CotizarController();
    $controller->cotizar();
} else {
    http_response_code(404);
    echo json_encode(["error" => "Ruta no encontrada"]);
}
