<?php
class AuthController {
    public function login($email, $password) {
        // Esto debería validarse contra la base de datos
        if ($email === "admin@demo.com" && $password === "1234") {
            $_SESSION['user_id'] = 1;
            $_SESSION['user_role'] = 'admin';
            header("Location: index.php?action=panel");
        } else {
            echo "Credenciales inválidas.";
        }
    }

    public function logout() {
        session_destroy();
        header("Location: index.php");
    }
}
