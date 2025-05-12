<?php
require_once __DIR__ . '/../controllers/CotizarController.php';

$uri = $_SERVER['REQUEST_URI'];

if ($uri === '/cotizar' || strpos($uri, '/cotizar') !== false) {
    $controller = new CotizarController();
    $controller->cotizar();
} else {
    http_response_code(404);
    echo json_encode(["error" => "Ruta no encontrada"]);
}
