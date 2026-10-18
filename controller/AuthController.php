<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

class AuthController {
    public function procesarLogin() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            include_once __DIR__ . '/../config/Database.php';
            include_once __DIR__ . '/../model/Usuario.php';

            $database = new Database();
            $db = $database->getConnection();

            $usuario = new Usuario($db);
            $usuario->correo = $_POST['correo'] ?? '';
            $usuario->clave = $_POST['clave'] ?? '';

            if($usuario->login()) {
                $_SESSION['user_id'] = $usuario->id_usuario;
                $_SESSION['user_name'] = $usuario->nombre;
                header("Location: ../views/home.php");
                exit();
            } else {
                header("Location: ../views/login.php?error=datos_incorrectos");
                exit();
            }
        }
    }
}

// Ejecutar si se llama directamente por POST desde el formulario
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $auth = new AuthController();
    $auth->procesarLogin();
}
?>