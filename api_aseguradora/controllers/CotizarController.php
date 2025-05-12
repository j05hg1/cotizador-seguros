<?php
require_once __DIR__ . '/../models/PlanModel.php';
require_once __DIR__ . '/../config/database.php';

class CotizarController {
    public function cotizar() {
        // Validar método
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            http_response_code(405);
            echo json_encode(["error" => "Método no permitido"]);
            return;
        }

        // Leer body JSON
        $data = json_decode(file_get_contents("php://input"), true);

        if (!isset($data['placa']) || !preg_match('/^[A-Z]{3}[0-9]{3}$/', $data['placa'])) {
            http_response_code(400);
            echo json_encode(["error" => "Placa inválida"]);
            return;
        }

        $placa = strtoupper($data['placa']);

        // Obtener planes
        $database = new Database();
        $db = $database->getConnection();
        $planModel = new PlanModel($db);
        $planes = $planModel->obtenerPlanes();

        // Preparar respuesta
        $respuestas = [];
        foreach ($planes as $plan) {
            $respuestas[] = [
                "noCotizacion" => strtoupper(uniqid($placa)),
                "placa" => $placa,
                "valor" => "$" . number_format($plan['valor'], 0, ',', '.'),
                "nombreProducto" => $plan['nombre_producto']
            ];
        }

        // Enviar respuesta
        http_response_code(200);
        header('Content-Type: application/json');
        echo json_encode($respuestas);
    }
}
