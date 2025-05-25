<?php
include('./config/session.php');
require_once 'config/database.php';
require_once 'config/helpers.php';

// Carga tus controladores
require_once 'controllers/AuthController.php';
require_once 'controllers/EnfermeraController.php';
require_once 'controllers/CitaController.php';
require_once 'controllers/HistoriaClinicaController.php';

$authController = new AuthController();
$enfermeraController = new EnfermeraController();
$citaController = new CitaController();
$historiaController = new HistoriaClinicaController();

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

    case 'listar_enfermeras':
        $enfermeraController->index();
        break;

    case 'nueva_cita':
        $citaController->create();
        break;

    case 'ver_historias':
        $historiaController->index();
        break;

    

    default:
        if (isset($_SESSION['user_id'])) {
            header("Location: index.php?action=listar_enfermeras");
        } else {
            echo "Página no encontrada";
        }
        break;
}
?>
