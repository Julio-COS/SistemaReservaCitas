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

    public function create() {
        $query = "INSERT INTO $this->table_name
                  SET id_paciente=:id_paciente, id_enfermera=:id_enfermera,
                      fecha=:fecha, hora=:hora, motivo=:motivo, estado=:estado";

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(":id_paciente", $this->id_paciente);
        $stmt->bindParam(":id_enfermera", $this->id_enfermera);
        $stmt->bindParam(":fecha", $this->fecha);
        $stmt->bindParam(":hora", $this->hora);
        $stmt->bindParam(":motivo", $this->motivo);
        $stmt->bindParam(":estado", $this->estado);

        return $stmt->execute();
    }

    public function readAll($pagina, $limit) {
        $offset = ($pagina - 1) * $limit;
        $query = "SELECT * FROM $this->table_name ORDER BY fecha DESC LIMIT $limit OFFSET $offset";
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
        $query = "SELECT * FROM $this->table_name WHERE id_cita = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function update() {
        $query = "UPDATE $this->table_name SET
                  id_paciente=:id_paciente,
                  id_enfermera=:id_enfermera,
                  fecha=:fecha,
                  hora=:hora,
                  motivo=:motivo,
                  estado=:estado
                  WHERE id_cita=:id_cita";

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(":id_paciente", $this->id_paciente);
        $stmt->bindParam(":id_enfermera", $this->id_enfermera);
        $stmt->bindParam(":fecha", $this->fecha);
        $stmt->bindParam(":hora", $this->hora);
        $stmt->bindParam(":motivo", $this->motivo);
        $stmt->bindParam(":estado", $this->estado);
        $stmt->bindParam(":id_cita", $this->id_cita);

        return $stmt->execute();
    }

    public function delete($id) {
        $query = "DELETE FROM $this->table_name WHERE id_cita = ?";
        $stmt = $this->conn->prepare($query);
        return $stmt->execute([$id]);
    }
}
