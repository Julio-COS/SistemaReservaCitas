<?php
require_once 'config/database.php';
require_once 'models/Cita.php';

class CitaController {
    private $db;
    private $cita;

    public function __construct() {
        $database = new Database();
        $this->db = $database->getConnection();
        $this->cita = new Cita($this->db);
    }

    public function index() {
        include 'views/cita/index.php';
    }

    public function getAll() {
        header('Content-Type: application/json');
        echo json_encode($this->cita->getAll());
    }

    public function create() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->cita->id_paciente = $_POST['id_paciente'];
            $this->cita->id_enfermera = $_POST['id_enfermera'];
            $this->cita->fecha = $_POST['fecha'];
            $this->cita->hora = $_POST['hora'];
            $this->cita->motivo = $_POST['motivo'];

            if ($this->cita->guardar()) {
                echo json_encode(["status" => "success"]);
            } else {
                echo json_encode(["status" => "error", "message" => "Error al guardar la cita."]);
            }
        }
    }

    public function delete($id) {
        if ($this->cita->delete($id)) {
            echo json_encode(['status' => 'success']);
        } else {
            echo json_encode(['status' => 'error']);
        }
    }

    public function update($id) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->cita->id_cita = $id;
            $this->cita->id_paciente = $_POST['id_paciente'];
            $this->cita->id_enfermera = $_POST['id_enfermera'];
            $this->cita->fecha = $_POST['fecha'];
            $this->cita->hora = $_POST['hora'];
            $this->cita->motivo = $_POST['motivo'];
            
            $this->cita->update();
            echo json_encode(["status" => "updated"]);
        }
    }
}
