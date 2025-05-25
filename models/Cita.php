<?php
class Cita {
    private $conn;
    private $table_name = "citas";

    public $id_cita;
    public $id_paciente;
    public $id_enfermera;
    public $fecha;
    public $hora;
    public $motivo;
    public $estado;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function guardar() {
        $query = "INSERT INTO " . $this->table_name . " 
                  (id_paciente, id_enfermera, fecha, hora, motivo, estado) 
                  VALUES (:id_paciente, :id_enfermera, :fecha, :hora, :motivo, :estado)";

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':id_paciente', $this->id_paciente);
        $stmt->bindParam(':id_enfermera', $this->id_enfermera);
        $stmt->bindParam(':fecha', $this->fecha);
        $stmt->bindParam(':hora', $this->hora);
        $stmt->bindParam(':motivo', $this->motivo);
        $stmt->bindParam(':estado', $this->estado);

        $stmt->execute();
    }

    public function getAll() {
        $query = "SELECT * FROM " . $this->table_name;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $citas = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $eventos = [];

        foreach ($citas as $cita) {
            $eventos[] = [
                'title' => 'Paciente ID: ' . $cita['id_paciente'],
                'start' => $cita['fecha'] . 'T' . $cita['hora'],
                'description' => $cita['motivo']
            ];
        }

        return $eventos;
    }

    public function findById($id) {
        $query = "SELECT * FROM $this->table_name WHERE id_cita = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function update() {
        $query = "UPDATE citas SET id_paciente = ?, id_enfermera = ?, fecha = ?, hora = ?, motivo = ? WHERE id_cita = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("iisssi", $this->id_paciente, $this->id_enfermera, $this->fecha, $this->hora, $this->motivo, $this->id_cita);
        $stmt->execute();
    }

    public function delete() {
        $query = "DELETE FROM citas WHERE id_cita = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $this->id_cita);
        $stmt->execute();
    }
}
