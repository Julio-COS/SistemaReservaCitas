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


    public function view() {
        $idPaciente = $_GET['id'] ?? null;
        $historia = $this->historia->getByPaciente($idPaciente);
        require 'views/historia/view.php';
    }

    public function update() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->historia->id_historia = $_POST['id_historia'];
            $this->historia->descripcion = $_POST['descripcion'];
            $this->historia->diagnostico = $_POST['diagnostico'];
            $this->historia->tratamiento = $_POST['tratamiento'];
            $this->historia->observaciones = $_POST['observaciones'];
            $this->historia->update();
            header("Location: index.php?action=historia_view&id=" . $_POST['id_paciente']);
        }
    }


}
