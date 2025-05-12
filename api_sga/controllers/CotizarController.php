<?php
class CotizarController {
    public function cotizar() {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            http_response_code(405);
            echo json_encode(["error" => "Método no permitido"]);
            return;
        }

        // Obtener datos del cliente
        $data = json_decode(file_get_contents("php://input"), true);

        // Validaciones
        $requiredFields = ['nombre', 'apellidos', 'fechaNacimiento', 'placa'];
        foreach ($requiredFields as $field) {
            if (empty($data[$field])) {
                http_response_code(400);
                echo json_encode(["error" => "El campo '$field' es requerido"]);
                return;
            }
        }

        // Validación de placa
        if (!preg_match('/^[A-Z]{3}[0-9]{3}$/', $data['placa'])) {
            http_response_code(400);
            echo json_encode(["error" => "Placa inválida. Formato correcto: ABC123"]);
            return;
        }

        // Preparar solicitud a la API aseguradora
        $payload = json_encode(["placa" => strtoupper($data['placa'])]);

        $ch = curl_init('http://localhost/api_aseguradora/index.php/cotizar'); // Ruta a tu API aseguradora

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Content-Type: application/json',
            'Content-Length: ' . strlen($payload)
        ]);
        curl_setopt($ch, CURLOPT_POST, true);

        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

        if (curl_errno($ch)) {
            http_response_code(500);
            echo json_encode(["error" => "Error al conectar con el servicio externo"]);
            return;
        }

        curl_close($ch);

        // Responder al cliente
        http_response_code($httpCode);
        echo $response;
    }
}
