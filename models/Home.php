<?php

class Home {
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function esAdultoMayor($id_paciente) {
        $sql = "SELECT fecha_nacimiento FROM paciente WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$id_paciente]);
        $fecha_nacimiento = $stmt->fetchColumn();

        if (!$fecha_nacimiento) return false;

        $edad = date_diff(date_create($fecha_nacimiento), date_create('today'))->y;
        return $edad >= 60;
    }

    public function getBonificacionActiva($id_paciente) {
        $sql = "SELECT * FROM bonificado
                WHERE id_paciente = ? AND estado = 'activo' AND fecha_limite = CURDATE()";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$id_paciente]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getNombrePaciente($id_paciente) {
        $sql = "SELECT nombre FROM paciente WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$id_paciente]);
        return $stmt->fetchColumn();
    }

    public function bonificacionesDelDia() {
    $sql = "SELECT b.*, p.nombre, p.apellido_p, p.apellido_m 
            FROM bonificado b 
            JOIN pacientes p ON b.id_paciente = p.id_paciente
            WHERE b.fecha_inicio = CURDATE() AND b.estado = 'activo'";
    $stmt = $this->conn->query($sql);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
}
