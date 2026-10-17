<?php
session_start();
require_once_config_or_db_here; // Ajustar según ruta relativa de conexión

class AuthController {
    public function procesarLogin() {
        if ($_POST) {
            include_once '../config/Database.php';
            include_once '../model/Usuario.php';

            $database = new Database();
            $db = $database->getConnection();

            $usuario = new Usuario($db);
            $usuario->correo = $_POST['correo'];
            $usuario->clave = $_POST['clave'];

            if($usuario->login()) {
                $_SESSION['user_id'] = $usuario->id_usuario;
                $_SESSION['user_name'] = $usuario->nombre;
                header("Location: ../views/home.php");
            } else {
                header("Location: ../views/login.php?error=datos_incorrectos");
            }
        }
    }
}
?>