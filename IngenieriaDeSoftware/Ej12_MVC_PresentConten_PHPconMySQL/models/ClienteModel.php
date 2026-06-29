<?php
require_once __DIR__ . '/../config/database.php';

class ClienteModel {
    private $conn;

    public function __construct() {
        $this->conn = Database::connect();
    }

    public function obtenerTodos() {
        $sql = "SELECT * FROM clientes";
        return $this->conn->query($sql);
    }

    public function obtenerPorId($id) {
        $sql = "SELECT * FROM clientes WHERE CLIENTE_ID = $id";
        return $this->conn->query($sql)->fetch_assoc();
    }

    public function crear($nombre, $domicilio, $mail, $telefono) {
        $stmt = $this->conn->prepare("INSERT INTO clientes (NOMBRE_CLI, DOMICILIO, MAIL, TELEFONO) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $nombre, $domicilio, $mail, $telefono);
        return $stmt->execute();
    }

    public function actualizar($id, $nombre, $domicilio, $mail, $telefono) {
        $stmt = $this->conn->prepare("UPDATE clientes SET NOMBRE_CLI=?, DOMICILIO=?, MAIL=?, TELEFONO=? WHERE CLIENTE_ID=?");
        $stmt->bind_param("ssssi", $nombre, $domicilio, $mail, $telefono, $id);
        return $stmt->execute();
    }

    public function eliminar($id) {
        $stmt = $this->conn->prepare("DELETE FROM clientes WHERE CLIENTE_ID=?");
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }
}
?>
