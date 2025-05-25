<?php
class Paciente {
    private $conn;
    private $table_name = "pacientes";

    public $id_paciente;
    public $nombre;
    public $dni;
    public $fecha_nacimiento;
    public $telefono;
    public $email;
    public $direccion;

    public function __construct($db) {
        $this->conn = $db;
    }

    // CREATE
    public function create() {
        $query = "INSERT INTO $this->table_name
                  SET nombre=:nombre, dni=:dni, fecha_nacimiento=:fecha_nacimiento,
                      telefono=:telefono, email=:email, direccion=:direccion";

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(":nombre", $this->nombre);
        $stmt->bindParam(":dni", $this->dni);
        $stmt->bindParam(":fecha_nacimiento", $this->fecha_nacimiento);
        $stmt->bindParam(":telefono", $this->telefono);
        $stmt->bindParam(":email", $this->email);
        $stmt->bindParam(":direccion", $this->direccion);

        return $stmt->execute();
    }

    // READ con paginación
    public function readAll($pagina, $limit) {
        $offset = ($pagina - 1) * $limit;
        $query = "SELECT * FROM " . $this->table_name . " ORDER BY id_paciente DESC
                  LIMIT $limit OFFSET $offset";

        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Total para la paginación
        $countQuery = "SELECT COUNT(*) as total FROM " . $this->table_name;
        $countStmt = $this->conn->prepare($countQuery);
        $countStmt->execute();
        $total = $countStmt->fetch(PDO::FETCH_ASSOC)['total'];

        return [
            'data' => $data,
            'total' => $total,
            'total_pages' => ceil($total / $limit)
        ];
    }

    // GET UNO
    public function findById($id) {
        $query = "SELECT * FROM " . $this->table_name . " WHERE id_paciente = :id LIMIT 1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // UPDATE
    public function update() {
        $query = "UPDATE $this->table_name SET
                  nombre = :nombre,
                  dni = :dni,
                  fecha_nacimiento = :fecha_nacimiento,
                  telefono = :telefono,
                  email = :email,
                  direccion = :direccion
                  WHERE id_paciente = :id";

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(":nombre", $this->nombre);
        $stmt->bindParam(":dni", $this->dni);
        $stmt->bindParam(":fecha_nacimiento", $this->fecha_nacimiento);
        $stmt->bindParam(":telefono", $this->telefono);
        $stmt->bindParam(":email", $this->email);
        $stmt->bindParam(":direccion", $this->direccion);
        $stmt->bindParam(":id", $this->id_paciente);

        return $stmt->execute();
    }

    // DELETE
    public function delete($id) {
        $query = "DELETE FROM " . $this->table_name . " WHERE id_paciente = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $id);
        return $stmt->execute();
    }
}
