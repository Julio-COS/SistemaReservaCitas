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
        $pagina = isset($_POST['pagina']) ? $_POST['pagina'] : 1;
        $limit = 15;
        $citas = $this->cita->readAll($pagina, $limit);
        require 'views/cita/index.php';
    }

    public function create() {
        require 'views/cita/create.php';
    }

    public function update($id) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->cita->id_cita = $id;
            $this->cita->id_paciente = $_POST['id_paciente'];
            $this->cita->id_enfermera = $_POST['id_enfermera'];
            $this->cita->fecha = $_POST['fecha'];
            $this->cita->hora = $_POST['hora'];
            $this->cita->motivo = $_POST['motivo'];

            if ($this->cita->update()) {
                header('Location: index.php?action=index_cita');
            } else {
                echo "Error al actualizar la cita.";
            }
        }
    }

    public function delete($id) {
        if ($this->cita->delete($id)) {
            header('Location: index.php?action=index_cita');
        } else {
            echo "Error al eliminar la cita.";
        }
    }
}
