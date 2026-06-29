<?php
require_once __DIR__ . '/../models/ClienteModel.php';

class ClienteController {
    private $model;

    public function __construct($db) {
        $this->model = new ClienteModel($db);
    }

    public function index() {
        $stmt = $this->model->obtenerTodos();
        $clientes = $stmt->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($clientes);
    }

    public function show($id) {
        $stmt = $this->model->obtenerPorId($id);
        $cliente = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($cliente) {
            echo json_encode($cliente);
        } else {
            http_response_code(404);
            echo json_encode(["mensaje" => "Cliente no encontrado"]);
        }
    }

    public function store($data) {
        if ($this->model->crear($data)) {
            http_response_code(201);
            echo json_encode(["mensaje" => "Cliente creado"]);
        } else {
            http_response_code(400);
            echo json_encode(["error" => "Error al crear cliente"]);
        }
    }

    public function update($id, $data) {
        if ($this->model->actualizar($id, $data)) {
            echo json_encode(["mensaje" => "Cliente actualizado"]);
        } else {
            http_response_code(400);
            echo json_encode(["error" => "Error al actualizar cliente"]);
        }
    }

    public function delete($id) {
        if ($this->model->eliminar($id)) {
            echo json_encode(["mensaje" => "Cliente eliminado"]);
        } else {
            http_response_code(400);
            echo json_encode(["error" => "Error al eliminar cliente"]);
        }
    }
}
?>
