<?php
class Paciente {
    private $conn;
    private $table_name = "pacientes";

    public $id_paciente;
    public $nombre;
    public $apellido_p;
    public $apellido_m;
    public $dni;
    public $fecha_nacimiento;
    public $sexo;
    public $telefono;
    public $email;
    public $direccion;

    public function __construct($db) {
        $this->conn = $db;
    }

    // CREATE
    public function create() {
        $query = "INSERT INTO $this->table_name
                  SET nombre=:nombre, apellido_p=:apellido_p, apellido_m=:apellido_m,
                      dni=:dni, fecha_nacimiento=:fecha_nacimiento, sexo=:sexo,
                      telefono=:telefono, email=:email, direccion=:direccion";

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(":nombre", $this->nombre);
        $stmt->bindParam(":apellido_p", $this->apellido_p);
        $stmt->bindParam(":apellido_m", $this->apellido_m);
        $stmt->bindParam(":dni", $this->dni);
        $stmt->bindParam(":fecha_nacimiento", $this->fecha_nacimiento);
        $stmt->bindParam(":sexo", $this->sexo);
        $stmt->bindParam(":telefono", $this->telefono);
        $stmt->bindParam(":email", $this->email);
        $stmt->bindParam(":direccion", $this->direccion);

        return $stmt->execute();
    }

    // READ ALL (paginado)
    public function readAll($pagina, $limit) {
        $offset = ($pagina - 1) * $limit;
        $query = "SELECT * FROM $this->table_name LIMIT $limit OFFSET $offset";
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

    // READ ONE
    public function readOne($id) {
        $query = "SELECT * FROM $this->table_name WHERE id_paciente = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // UPDATE
    public function update() {
        $query = "UPDATE $this->table_name
                  SET nombre=:nombre, apellido_p=:apellido_p, apellido_m=:apellido_m,
                      dni=:dni, fecha_nacimiento=:fecha_nacimiento, sexo=:sexo,
                      telefono=:telefono, email=:email, direccion=:direccion
                  WHERE id_paciente=:id_paciente";

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(":nombre", $this->nombre);
        $stmt->bindParam(":apellido_p", $this->apellido_p);
        $stmt->bindParam(":apellido_m", $this->apellido_m);
        $stmt->bindParam(":dni", $this->dni);
        $stmt->bindParam(":fecha_nacimiento", $this->fecha_nacimiento);
        $stmt->bindParam(":sexo", $this->sexo);
        $stmt->bindParam(":telefono", $this->telefono);
        $stmt->bindParam(":email", $this->email);
        $stmt->bindParam(":direccion", $this->direccion);
        $stmt->bindParam(":id_paciente", $this->id_paciente);

        return $stmt->execute();
    }

    // DELETE
    public function delete($id) {
        $query = "DELETE FROM $this->table_name WHERE id_paciente = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $id);
        return $stmt->execute();
    }
}
