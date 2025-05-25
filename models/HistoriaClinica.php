<?php
class HistoriaClinica {
    private $conn;
    private $table_name = "historias_clinicas";

    public $id_historia;
    public $id_paciente;
    public $diagnostico;
    public $tratamiento;
    public $fecha_registro;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function create() {
        $query = "INSERT INTO $this->table_name
                  SET id_paciente=:id_paciente, diagnostico=:diagnostico,
                      tratamiento=:tratamiento, fecha_registro=:fecha_registro";

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(":id_paciente", $this->id_paciente);
        $stmt->bindParam(":diagnostico", $this->diagnostico);
        $stmt->bindParam(":tratamiento", $this->tratamiento);
        $stmt->bindParam(":fecha_registro", $this->fecha_registro);

        return $stmt->execute();
    }

    public function readAll($pagina, $limit) {
        $offset = ($pagina - 1) * $limit;
        $query = "SELECT * FROM $this->table_name ORDER BY fecha_registro DESC LIMIT $limit OFFSET $offset";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $countQuery = "SELECT COUNT(*) as total FROM $this->table_name";
        $countStmt = $this->conn->prepare($countQuery);
        $countStmt->execute();
        $total = $countStmt->fetch(PDO::FETCH_ASSOC)['total'];

        return [
            'data' => $data,
            'total' => $total,
            'total_pages' => ceil($total / $limit)
        ];
    }

    public function findById($id) {
        $query = "SELECT * FROM $this->table_name WHERE id_historia = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function update() {
        $query = "UPDATE $this->table_name SET
                  id_paciente=:id_paciente,
                  diagnostico=:diagnostico,
                  tratamiento=:tratamiento,
                  fecha_registro=:fecha_registro
                  WHERE id_historia=:id_historia";

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(":id_paciente", $this->id_paciente);
        $stmt->bindParam(":diagnostico", $this->diagnostico);
        $stmt->bindParam(":tratamiento", $this->tratamiento);
        $stmt->bindParam(":fecha_registro", $this->fecha_registro);
        $stmt->bindParam(":id_historia", $this->id_historia);

        return $stmt->execute();
    }

    public function delete($id) {
        $query = "DELETE FROM $this->table_name WHERE id_historia = ?";
        $stmt = $this->conn->prepare($query);
        return $stmt->execute([$id]);
    }
}
