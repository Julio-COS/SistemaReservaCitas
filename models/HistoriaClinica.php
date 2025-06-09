<?php
class HistoriaClinica {
    private $conn;
    private $table_name = "historias_clinicas";

    public $id_historia;
    public $id_paciente;
    public $fecha_registro;
    public $descripcion;
    public $diagnostico;
    public $tratamiento;
    public $observaciones;
    

    public function __construct($db) {
        $this->conn = $db;
    }

    public function getByPaciente($idPaciente) {
        $query = "SELECT * FROM $this->table_name WHERE id_paciente = :id LIMIT 1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $idPaciente);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function update() {
        $query = "UPDATE $this->table_name SET
                    descripcion = :descripcion,
                    diagnostico = :diagnostico,
                    tratamiento = :tratamiento,
                    observaciones = :observaciones
                  WHERE id_historia = :id_historia";

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':descripcion', $this->descripcion);
        $stmt->bindParam(':diagnostico', $this->diagnostico);
        $stmt->bindParam(':tratamiento', $this->tratamiento);
        $stmt->bindParam(':observaciones', $this->observaciones);
        $stmt->bindParam(':id_historia', $this->id_historia);

        return $stmt->execute();
    }


}
