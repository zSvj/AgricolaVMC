<?php
class Cultivo {
    private $conn;
    private $table_name = "cultivos";

    public $id;
    public $tipo_cultivo;
    public $area_sembrada;
    public $fecha_siembra;
    public $fecha_cosecha_estimada;
    public $insumos_utilizados;
    public $responsable;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function read() {
        $query = "SELECT * FROM " . $this->table_name;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    public function create() {
        $query = "INSERT INTO " . $this->table_name . " SET tipo_cultivo=:tipo_cultivo, area_sembrada=:area_sembrada, fecha_siembra=:fecha_siembra, fecha_cosecha_estimada=:fecha_cosecha_estimada, insumos_utilizados=:insumos_utilizados, responsable=:responsable";
        $stmt = $this->conn->prepare($query);

        $this->tipo_cultivo = htmlspecialchars(strip_tags($this->tipo_cultivo));
        $this->area_sembrada = htmlspecialchars(strip_tags($this->area_sembrada));
        $this->fecha_siembra = htmlspecialchars(strip_tags($this->fecha_siembra));
        $this->fecha_cosecha_estimada = htmlspecialchars(strip_tags($this->fecha_cosecha_estimada));
        $this->insumos_utilizados = htmlspecialchars(strip_tags($this->insumos_utilizados));
        $this->responsable = htmlspecialchars(strip_tags($this->responsable));

        $stmt->bindParam(":tipo_cultivo", $this->tipo_cultivo);
        $stmt->bindParam(":area_sembrada", $this->area_sembrada);
        $stmt->bindParam(":fecha_siembra", $this->fecha_siembra);
        $stmt->bindParam(":fecha_cosecha_estimada", $this->fecha_cosecha_estimada);
        $stmt->bindParam(":insumos_utilizados", $this->insumos_utilizados);
        $stmt->bindParam(":responsable", $this->responsable);

        if($stmt->execute()) {
            return true;
        }
        return false;
    }

    public function update() {
        $query = "UPDATE " . $this->table_name . " SET tipo_cultivo=:tipo_cultivo, area_sembrada=:area_sembrada, fecha_siembra=:fecha_siembra, fecha_cosecha_estimada=:fecha_cosecha_estimada, insumos_utilizados=:insumos_utilizados, responsable=:responsable WHERE id=:id";
        $stmt = $this->conn->prepare($query);

        $this->id = htmlspecialchars(strip_tags($this->id));
        $this->tipo_cultivo = htmlspecialchars(strip_tags($this->tipo_cultivo));
        $this->area_sembrada = htmlspecialchars(strip_tags($this->area_sembrada));
        $this->fecha_siembra = htmlspecialchars(strip_tags($this->fecha_siembra));
        $this->fecha_cosecha_estimada = htmlspecialchars(strip_tags($this->fecha_cosecha_estimada));
        $this->insumos_utilizados = htmlspecialchars(strip_tags($this->insumos_utilizados));
        $this->responsable = htmlspecialchars(strip_tags($this->responsable));

        $stmt->bindParam(":id", $this->id);
        $stmt->bindParam(":tipo_cultivo", $this->tipo_cultivo);
        $stmt->bindParam(":area_sembrada", $this->area_sembrada);
        $stmt->bindParam(":fecha_siembra", $this->fecha_siembra);
        $stmt->bindParam(":fecha_cosecha_estimada", $this->fecha_cosecha_estimada);
        $stmt->bindParam(":insumos_utilizados", $this->insumos_utilizados);
        $stmt->bindParam(":responsable", $this->responsable);

        if($stmt->execute()) {
            return true;
        }
        return false;
    }

    public function delete() {
        $query = "DELETE FROM " . $this->table_name . " WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $this->id = htmlspecialchars(strip_tags($this->id));
        $stmt->bindParam(1, $this->id);

        if($stmt->execute()) {
            return true;
        }
        return false;
    }

    public function readOne() {
        $query = "SELECT * FROM " . $this->table_name . " WHERE id = ? LIMIT 0,1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->id);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        $this->tipo_cultivo = $row['tipo_cultivo'];
        $this->area_sembrada = $row['area_sembrada'];
        $this->fecha_siembra = $row['fecha_siembra'];
        $this->fecha_cosecha_estimada = $row['fecha_cosecha_estimada'];
        $this->insumos_utilizados = $row['insumos_utilizados'];
        $this->responsable = $row['responsable'];
    }
}
?>

