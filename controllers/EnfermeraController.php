<?php
require_once 'config/database.php';
require_once 'models/Enfermera.php';

class EnfermeraController {
    private $db;
    private $enfermera;

    public function __construct() {
        $database = new Database();
        $this->db = $database->getConnection();
        $this->enfermera = new Enfermera($this->db);
    }

    public function index() {
        $pagina = isset($_POST['pagina']) ? $_POST['pagina'] : 1;
        $limit = 15;
        $enfermeras = $this->enfermera->readAll($pagina, $limit);
        require 'views/enfermera/index.php';
    }

    public function create() {
        require 'views/enfermera/create.php';
    }

    public function store() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->enfermera->nombre = $_POST['nombre'];
            $this->enfermera->especialidad = $_POST['especialidad'];
            $this->enfermera->telefono = $_POST['telefono'];
            $this->enfermera->email = $_POST['email'];

            if ($this->enfermera->create()) {
                header('Location: index.php?action=index_enfermera');
            } else {
                echo "Error al registrar la enfermera.";
            }
        }
    }

    public function update($id) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->enfermera->id_enfermera = $id;
            $this->enfermera->nombre = $_POST['nombre'];
            $this->enfermera->especialidad = $_POST['especialidad'];
            $this->enfermera->telefono = $_POST['telefono'];
            $this->enfermera->email = $_POST['email'];

            if ($this->enfermera->update()) {
                header('Location: index.php?action=index_enfermera');
            } else {
                echo "Error al actualizar la enfermera.";
            }
        }
    }

    public function delete($id) {
        if ($this->enfermera->delete($id)) {
            header('Location: index.php?action=index_enfermera');
        } else {
            echo "Error al eliminar la enfermera.";
        }
    }
}
