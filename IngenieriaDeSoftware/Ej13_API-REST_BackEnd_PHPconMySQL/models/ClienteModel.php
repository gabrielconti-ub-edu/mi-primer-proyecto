<?php
class ClienteModel {
    private $conn;
    private $table = "clientes";

    public function __construct($db) {
        $this->conn = $db;
    }

    public function obtenerTodos() {
        $query = "SELECT * FROM {$this->table}";
        return $this->conn->query($query);
    }

    public function obtenerPorId($id) {
        $query = "SELECT * FROM {$this->table} WHERE CLIENTE_ID = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        return $stmt;
    }

    public function crear($data) {
        $query = "INSERT INTO {$this->table} (NOMBRE_CLI, DOMICILIO, MAIL, TELEFONO)
                  VALUES (:nombre, :domicilio, :mail, :telefono)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":nombre", $data["nombre"]);
        $stmt->bindParam(":domicilio", $data["domicilio"]);
        $stmt->bindParam(":mail", $data["mail"]);
        $stmt->bindParam(":telefono", $data["telefono"]);
        return $stmt->execute();
    }

    public function actualizar($id, $data) {
        $query = "UPDATE {$this->table}
                  SET NOMBRE_CLI=:nombre, DOMICILIO=:domicilio, MAIL=:mail, TELEFONO=:telefono
                  WHERE CLIENTE_ID=:id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $id);
        $stmt->bindParam(":nombre", $data["nombre"]);
        $stmt->bindParam(":domicilio", $data["domicilio"]);
        $stmt->bindParam(":mail", $data["mail"]);
        $stmt->bindParam(":telefono", $data["telefono"]);
        return $stmt->execute();
    }

    public function eliminar($id) {
        $query = "DELETE FROM {$this->table} WHERE CLIENTE_ID = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $id);
        return $stmt->execute();
    }
}
?>
