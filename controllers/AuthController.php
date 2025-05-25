<?php
require_once 'config/database.php';
require_once 'models/Auth.php';

class AuthController {
    private $db;
    private $user;

    public function __construct() {
        $database = new Database();
        $this->db = $database->getConnection();
        $this->user = new Auth($this->db);
    }

    // Mostrar formulario de login
    public function showLoginForm() {
        include 'views/auth/login.php';
    }

    // Mostrar formulario de registro
    public function showRegisterForm() {
        include 'views/auth/register.php';
    }

    // Login de usuarios
    public function login() {
        $this->user->username = $_POST['username'];
        $this->user->password = $_POST['password'];

        if ($this->user->login()) {
            session_start();
            $_SESSION['username'] = $this->user->username;
            $_SESSION['user_id'] = $this->user->id;
            $_SESSION['user_role'] = $this->user->getRole();
            header('Location: index.php');
        } else {
            echo "Usuario o contraseña incorrectos.";
        }
    }

    // Registro de nuevos usuarios
    public function register() {
        $this->user->nombres = $_POST['nombres'];
        $this->user->apellidos = $_POST['apellidos'];
        $this->user->username = $_POST['username'];
        $this->user->password = $_POST['password'];
        $this->user->correo = $_POST['correo'];
        $this->user->role_id = $_POST['role_id'];
        
        if(isAdmin()){ //esta logeado
            $this->user->register();
            header('Location: index.php?action=index_user');
            $this->indexUser();
        }else if($this->user->register()) {
            header('Location: index.php?action=login');
        } else {
            echo "Error al registrar el usuario.";
        }       
    }

    // Logout de usuarios
    public function logout() {
        session_start();
        session_destroy();
        header('Location: index.php?action=login');
    }



    
    public function indexUser(){
        $pagina = isset($_POST['pagina']) ? $_POST['pagina'] : 1;
        $limit= 15;
        $usuarios = $this->user->getUsuarios($pagina,$limit);
        include 'views/auth/index.php';
    }

    public function createUser(){
        include 'views/auth/create.php';
    }

    public function editUser($id){
        $this->user->id = $id;
        $usuario=$this->user= $this->user->getUsuario($id)[0];

        require 'views/auth/edit.php';
    }
    public function updateUser($id){
        $this->user->id = $id;
        $this->user->nombres = $_POST['nombres'];
        $this->user->apellidos = $_POST['apellidos'];
        $this->user->username = $_POST['username'];
        $this->user->password = $_POST['password'];
        $this->user->correo = $_POST['correo'];
        $this->user->role_id = $_POST['role_id'];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if ($this->user->update()) {
                header('Location: index.php?action=index_user');
            } else {
                echo "Error al actualizar el usuario.";
            }
        }
    }


    public function deleteUser($id){
        if (!isAdmin()) {
            echo "No tienes permiso para realizar esta acción.";
            return;
        }

        $this->user->id = $id;
        if(isAdmin()){
            $this->user->delete();
            header('Location: index.php?action=index_user');
        }else {
            echo "Error al eliminar el usuario.";
        }
    }
}
?>
