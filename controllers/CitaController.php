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
        $cita = new Cita($this->db);
        $citas = $cita->obtenerTodas();

        $eventos = array_map(function ($c) {
            return [
                'id' => $c['id_cita'],
                'title' => 'Paciente: ' . $c['id_paciente'],
                'start' => $c['fecha'] . 'T' . $c['hora'],
                'end' => $c['fecha'] . 'T' . $c['hora_fin'],
                'extendedProps' => [
                    'id_paciente' => $c['id_paciente'],
                    'id_enfermera' => $c['id_enfermera'],
                    'motivo' => $c['motivo']
                ]
            ];
        }, $citas);

        echo json_encode($eventos);
    }

    public function create() {
        $cita = new Cita($this->db);
        $cita->id_paciente = $_POST['id_paciente'];
        $cita->id_enfermera = $_POST['id_enfermera'];
        $cita->fecha = $_POST['fecha'];
        $cita->hora = $_POST['hora'];
        $cita->hora_fin = $_POST['hora_fin'];
        $cita->motivo = $_POST['motivo'];
        $cita->guardar();
        header("Location: index.php?action=cita_index");
    }

    public function update($id) {
        $data = $_POST;

        $cita = new Cita($this->db);
        $cita->id_cita = $id;

        // Solo actualizar si los campos están definidos
        if (isset($data['fecha'])) $cita->fecha = $data['fecha'];
        if (isset($data['hora'])) $cita->hora = $data['hora'];
        if (isset($data['hora_fin'])) $cita->hora_fin = $data['hora_fin'];

        // Opcional: si se están enviando los demás campos
        if (isset($data['id_paciente'])) $cita->id_paciente = $data['id_paciente'];
        if (isset($data['id_enfermera'])) $cita->id_enfermera = $data['id_enfermera'];
        if (isset($data['motivo'])) $cita->motivo = $data['motivo'];

        $cita->guardar();

    }

    public function delete($id) {
        $cita = new Cita($this->db);
        $success = $cita->eliminar($id);
        echo json_encode(['success' => $success]);
    }
}
