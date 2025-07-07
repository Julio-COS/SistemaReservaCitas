<?php
require_once 'models/Home.php';
require_once 'config/database.php';

class HomeController {
    private $db;
    private $home;

    public function __construct() {
        $database = new Database();
        $this->db = $database->getConnection();
        $this->home = new Home($this->db);
    }

    public function index() {
        $id_paciente = $_SESSION['id_paciente'] ?? null;

        $bonificacionModel = new Home($this->db);
        $bonificaciones = $bonificacionModel->bonificacionesDelDia();

        require 'views/home/index.php';
    }
}
