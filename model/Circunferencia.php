<?php
class Circunferencia {
    private $conn;
    private $table_name = "circunferencia";

    public $id_circunferencia;
    public $detalle;
    public $radio;
    public $diametro;
    public $area;
    public $longitud;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function leerTodos() {
        $query = "SELECT id_circunferencia, detalle, radio, diametro, area, longitud, fecha_registro FROM " . $this->table_name . " ORDER BY fecha_registro DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    public function crear() {
        // Cálculos matemáticos corregidos con los operadores '*' correspondientes
        $this->diametro = $this->radio * 2;
        $this->area = pi() * pow($this->radio, 2);
        $this->longitud = 2 * pi() * $this->radio;

        $query = "INSERT INTO " . $this->table_name . " SET detalle=:detalle, radio=:radio, diametro=:diametro, area=:area, longitud=:longitud";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(":detalle", $this->detalle);
        $stmt->bindParam(":radio", $this->radio);
        $stmt->bindParam(":diametro", $this->diametro);
        $stmt->bindParam(":area", $this->area);
        $stmt->bindParam(":longitud", $this->longitud);

        if($stmt->execute()) {
            return true;
        }
        return false;
    }
}
?>