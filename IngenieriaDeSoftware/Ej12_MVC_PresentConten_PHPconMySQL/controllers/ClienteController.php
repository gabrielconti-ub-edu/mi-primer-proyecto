<?php
require_once __DIR__ . '/../models/ClienteModel.php';

class ClienteController {
    private $model;

    public function __construct() {
        $this->model = new ClienteModel();
    }

    public function index() {
        $clientes = $this->model->obtenerTodos();
        require __DIR__ . '/../views/clientes/index.php';
    }

    public function create() {
        require __DIR__ . '/../views/clientes/create.php';
    }

    public function store() {
        $this->model->crear($_POST['nombre'], $_POST['domicilio'], $_POST['mail'], $_POST['telefono']);
        header("Location: index.php");
    }

    public function edit($id) {
        $cliente = $this->model->obtenerPorId($id);
        require __DIR__ . '/../views/clientes/edit.php';
    }

    public function update($id) {
        $this->model->actualizar($id, $_POST['nombre'], $_POST['domicilio'], $_POST['mail'], $_POST['telefono']);
        header("Location: index.php");
    }

    public function delete($id) {
        $this->model->eliminar($id);
        header("Location: index.php");
    }
}
?>
