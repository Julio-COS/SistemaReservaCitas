<?php
class Cita {
    private $conn;
    private $table_name = "citas";

    public $id_cita;
    public $id_paciente;
    public $id_enfermera;
    public $fecha;
    public $hora;
    public $hora_fin;
    public $motivo;
    public $estado;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function guardar() {
        if ($this->id_cita) {
            $campos = [];
            $valores = [];

            if (isset($this->id_paciente)) {
                $campos[] = "id_paciente = ?";
                $valores[] = $this->id_paciente;
            }
            if (isset($this->id_enfermera)) {
                $campos[] = "id_enfermera = ?";
                $valores[] = $this->id_enfermera;
            }
            if (isset($this->fecha)) {
                $campos[] = "fecha = ?";
                $valores[] = $this->fecha;
            }
            if (isset($this->hora)) {
                $campos[] = "hora = ?";
                $valores[] = $this->hora;
            }
            if (isset($this->hora_fin)) {
                $campos[] = "hora_fin = ?";
                $valores[] = $this->hora_fin;
            }
            if (isset($this->motivo)) {
                $campos[] = "motivo = ?";
                $valores[] = $this->motivo;
            }

            $valores[] = $this->id_cita;

            $query = "UPDATE citas SET " . implode(", ", $campos) . " WHERE id_cita = ?";
            $stmt = $this->conn->prepare($query);
            return $stmt->execute($valores);
        } else {
            $query = "INSERT INTO citas (id_paciente, id_enfermera, fecha, hora, hora_fin, motivo) VALUES (?, ?, ?, ?, ?, ?)";
            $stmt = $this->conn->prepare($query);
            return $stmt->execute([$this->id_paciente, $this->id_enfermera, $this->fecha, $this->hora, $this->hora_fin, $this->motivo]);
        }
    }

    public function obtenerTodas() {
        $query = "SELECT * FROM citas";
        return $this->conn->query($query)->fetchAll(PDO::FETCH_ASSOC);
    }

    public function eliminar($id) {
        $stmt = $this->conn->prepare("DELETE FROM citas WHERE id_cita = ?");
        return $stmt->execute([$id]);
    }

    public function cargar($id) {
        $stmt = $this->conn->prepare("SELECT * FROM citas WHERE id_cita = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
