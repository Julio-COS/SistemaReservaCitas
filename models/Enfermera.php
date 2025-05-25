<?php
class Enfermera {
    private $conn;
    private $table_name = "enfermeras";

    public $id_enfermera;
    public $nombre;
    public $especialidad;
    public $telefono;
    public $email;

    public function __construct($db) {
        $this->conn = $db;
    }

    // CREATE
    public function create() {
        $query = "INSERT INTO $this->table_name
                  SET nombre=:nombre, especialidad=:especialidad, telefono=:telefono, email=:email";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(":nombre", $this->nombre);
        $stmt->bindParam(":especialidad", $this->especialidad);
        $stmt->bindParam(":telefono", $this->telefono);
        $stmt->bindParam(":email", $this->email);

        return $stmt->execute();
    }

    // READ ONE
    public function readOne() {
        $query = "SELECT * FROM " . $this->table_name . " WHERE id_enfermera = ? LIMIT 0,1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->id_enfermera);
        $stmt->execute();
        return $stmt;
    }

    // READ ALL
    public function readAll($pagina,$limit) {
        $offset= ($pagina-1) * $limit;
        $query = "SELECT * FROM " . $this->table_name . " ORDER BY id_enfermera DESC 
        LIMIT $limit OFFSET $offset";

        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

        //paginacion
        $countQuery= "SELECT COUNT(*) as total FROM ". $this->table_name;
        $countStmt = $this->conn->prepare($countQuery);
        $countStmt->execute();
        $total = $countStmt->fetch(PDO::FETCH_ASSOC)['total'];

        return [
            'data' => $data,
            'total' => $total,
            'total_pages' => ceil($total / $limit)
        ];
    }

    // UPDATE
    public function update() {
        $query = "UPDATE $this->table_name
                  SET nombre=:nombre, especialidad=:especialidad, telefono=:telefono, email=:email
                  WHERE id_enfermera = :id";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(":nombre", $this->nombre);
        $stmt->bindParam(":especialidad", $this->especialidad);
        $stmt->bindParam(":telefono", $this->telefono);
        $stmt->bindParam(":email", $this->email);
        $stmt->bindParam(":id", $this->id_enfermera);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    // DELETE
    public function delete() {
        $query = "DELETE FROM $this->table_name WHERE id_enfermera = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $this->id_enfermera);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }
}
?>
