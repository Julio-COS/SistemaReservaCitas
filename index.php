<?php
include('./config/session.php');
require_once 'config/database.php';
require_once 'config/helpers.php';

// Carga tus controladores
require_once 'controllers/AuthController.php';
require_once 'controllers/EnfermeraController.php';
require_once 'controllers/CitaController.php';
require_once 'controllers/HistoriaClinicaController.php';
require_once 'controllers/PacienteController.php';

$authController = new AuthController();
$enfermeraController = new EnfermeraController();
$citaController = new CitaController();
$historiaController = new HistoriaClinicaController();
$pacienteController = new PacienteController();

$action = isset($_GET['action']) ? $_GET['action'] : '';

if (!isset($_SESSION['user_id']) && $action != 'login' && $action != 'logout') {
    $action = 'login';
}

// Lógica de enrutamiento
switch ($action) {
    case 'login':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $authController->login();
        } else {
            $authController->showLoginForm();
        }
        break;

    case 'logout':
        $authController->logout();
        break;

    // citas

    case 'cita_index':
        $citaController->index();
        break;
    case 'cita_create':
        $citaController->create();
        break;
    case 'cita_update':
        $id = isset($_GET['id']) ? $_GET['id'] : 0;
        $citaController->update($id);
        break;
    case 'cita_delete':
        $id = isset($_GET['id']) ? $_GET['id'] : 0;
        $citaController->delete($id);
        break;

    case 'cita_get_all':
        $citaController->getAll();
        break;
        
    // enfermera
    case 'enfermera_index':
        $enfermeraController->index();
        break;
    case 'enfermera_create':
        $enfermeraController->create();
        break;
    case 'enfermera_update':
        $id = isset($_GET['id']) ? $_GET['id'] : 0;
        $enfermeraController->update($id);
        break;
    case 'enfermera_delete':
        $id = isset($_GET['id']) ? $_GET['id'] : 0;
        $enfermeraController->delete($id);
        break;


    // paciente
    case 'paciente_index':
        $pacienteController->index();
        break;
    case 'paciente_create':
        $pacienteController->create();
        break;
    case 'paciente_update':
        $id = isset($_GET['id']) ? $_GET['id'] : 0;
        $pacienteController->update($id);
        break;
    case 'paciente_delete':
        $id = isset($_GET['id']) ? $_GET['id'] : 0;
        $pacienteController->delete($id);
        break;

    // HISTORIA CLINICA
    case 'historia_view':
        $historiaController->view();
    break;

    case 'historia_update':
        $id = isset($_GET['id']) ? $_GET['id'] : 0;
        $historiaController->update($id);
        break;
    

    default:
        if (isset($_SESSION['user_id'])) {
            header("Location: index.php?action=enfermera_index"); 
        } else {
            echo "Página no encontrada";
        }
        break;
}
?>
