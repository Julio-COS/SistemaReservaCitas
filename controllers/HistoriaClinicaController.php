<?php
require_once 'config/database.php';
require_once 'models/HistoriaClinica.php';

class HistoriaClinicaController {
    private $db;
    private $historia;

    public function __construct() {
        $database = new Database();
        $this->db = $database->getConnection();
        $this->historia = new HistoriaClinica($this->db);
    }

    //BORRAR
    public function index() {
        $pagina = isset($_POST['pagina']) ? $_POST['pagina'] : 1;
        $limit = 15;
        $result = $this->historia->readAll($pagina, $limit);
        $historias = $result['data'];
        $total = $result['total'];
        $total_pages = $result['total_pages'];
        require 'views/historia_clinica/index.php';
    }

    public function update($id) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->historia->id_historia = $id;
            $this->historia->id_paciente = $_POST['id_paciente'];
            $this->historia->diagnostico = $_POST['diagnostico'];
            $this->historia->tratamiento = $_POST['tratamiento'];
            $this->historia->fecha_registro = $_POST['fecha_registro'];

            if ($this->historia->update()) {
                header('Location: index.php?action=index_historia_clinica');
                exit;
            } else {
                echo "Error al actualizar la historia clínica.";
            }
        }
    }

    //BORRAR
    public function delete($id) {
        if ($this->historia->delete($id)) {
            header('Location: index.php?action=index_historia_clinica');
            exit;
        } else {
            echo "Error al eliminar la historia clínica.";
        }
    }
}
