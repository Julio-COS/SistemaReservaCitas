<?php
require_once 'models/Paciente.php';
require_once 'config/database.php';

class PacienteController {
    private $db;
    private $paciente;

    public function __construct() {
        $database = new Database();
        $this->db = $database->getConnection();
        $this->paciente = new Paciente($this->db);
    }

    public function index() {
        $pagina = isset($_POST['pagina']) ? $_POST['pagina'] : 1;
        $limit = 15;
        $pacientes = $this->paciente->readAll($pagina, $limit);
        require 'views/paciente/index.php';
    }

    public function create() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->paciente->nombre = $_POST['nombre'];
            $this->paciente->apellido_p = $_POST['apellido_p'];
            $this->paciente->apellido_m = $_POST['apellido_m'];
            $this->paciente->dni = $_POST['dni'];
            $this->paciente->fecha_nacimiento = $_POST['fecha_nacimiento'];
            $this->paciente->sexo = $_POST['sexo'];
            $this->paciente->telefono = $_POST['telefono'];
            $this->paciente->email = $_POST['email'];
            $this->paciente->direccion = $_POST['direccion'];

            if ($this->paciente->create()) {
                header('Location: index.php?action=paciente_index');
            } else {
                echo "Error al crear el paciente.";
            }
        } else {
            require 'views/paciente/create.php';
        }
    }

    public function update($id) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->paciente->id_paciente = $id;
            $this->paciente->nombre = $_POST['nombre'];
            $this->paciente->apellido_p = $_POST['apellido_p'];
            $this->paciente->apellido_m = $_POST['apellido_m'];
            $this->paciente->dni = $_POST['dni'];
            $this->paciente->fecha_nacimiento = $_POST['fecha_nacimiento'];
            $this->paciente->sexo = $_POST['sexo'];
            $this->paciente->telefono = $_POST['telefono'];
            $this->paciente->email = $_POST['email'];
            $this->paciente->direccion = $_POST['direccion'];

            if ($this->paciente->update()) {
                header('Location: index.php?action=paciente_index');
            } else {
                echo "Error al actualizar el paciente.";
            }
        } else {
            $paciente = $this->paciente->readOne($id);
            require 'views/paciente/update.php';
        }
    }

    public function delete($id) {
        if ($this->paciente->delete($id)) {
            header('Location: index.php?action=paciente_index');
        } else {
            echo "Error al eliminar el paciente.";
        }
    }
    public function list() {
        $pacientes = $this->paciente->list();

        $resultado = array_map(function($p) {
            return [
                'id' => $p['id_paciente'],
                'nombre' => $p['nombre'] . ' ' . $p['apellido_p'] . ' ' . $p['apellido_m']
            ];
        }, $pacientes);

        header('Content-Type: application/json');
        echo json_encode($resultado);
    }
}