<?php
class PlanModel {
    private $conn;
    private $table = "planes";

    public function __construct($db) {
        $this->conn = $db;
    }

    public function obtenerPlanes() {
        $query = "SELECT * FROM " . $this->table . " LIMIT 3";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
