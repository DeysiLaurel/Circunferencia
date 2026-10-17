<?php
include_once __DIR__ . '/../config/Database.php';
include_once __DIR__ . '/../model/Circunferencia.php';

class CircunferenciaController {
    private $db;
    private $circunferencia;

    public function __construct() {
        $database = new Database();
        $this->db = $database->getConnection();
        $this->circunferencia = new Circunferencia($this->db);
    }

    public function listar() {
        return $this->circunferencia->leerTodos();
    }

    public function registrar() {
        if ($_POST) {
            $this->circunferencia->detalle = $_POST['detalle'];
            $this->circunferencia->radio = $_POST['radio'];

            if($this->circunferencia->crear()) {
                header("Location: ../views/home.php?exito=registrado");
            } else {
                header("Location: ../views/home.php?error=fallo_registro");
            }
        }
    }
}
?>