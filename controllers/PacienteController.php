<?php
require_once 'config/database.php';

class PacienteController {
    private $db;

    public function __construct() {
        $database = new Database();
        $this->db = $database->getConnection();
    }

    public function getHorario() {
        
    }
}