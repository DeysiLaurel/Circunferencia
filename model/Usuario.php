<?php
class Usuario {
    private $conn;
    private $table_name = "usuario";

    public $id_usuario;
    public $nombre;
    public $correo;
    public $clave;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function login() {
        $query = "SELECT id_usuario, nombre, correo, clave FROM " . $this->table_name . " WHERE correo = :correo LIMIT 0,1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':correo', $this->correo);
        $stmt->execute();

        if($stmt->rowCount() > 0) {
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            if(password_verify($this->clave, $row['clave']) || $this->clave === $row['clave']) {
                $this->id_usuario = $row['id_usuario'];
                $this->nombre = $row['nombre'];
                return true;
            }
        }
        return false;
    }
}
?>