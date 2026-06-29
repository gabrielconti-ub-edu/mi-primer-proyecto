<?php
require_once("config/conexion.php");
require_once("models/ClienteModel.php");

$accion = isset($_POST['accion']) ? $_POST['accion'] : '';

if ($accion == 'agregar') {
    agregarCliente($conn, $_POST['nombre'], $_POST['domicilio'], $_POST['mail'], $_POST['telefono']);
}

if ($accion == 'editar') {
    actualizarCliente($conn, $_POST['id'], $_POST['nombre'], $_POST['domicilio'], $_POST['mail'], $_POST['telefono']);
}

if ($accion == 'eliminar') {
    eliminarCliente($conn, $_POST['id']);
}

$cliente_editar = null;
if ($accion == 'seleccionar') {
    $cliente_editar = obtenerClientePorId($conn, $_POST['id']);
}

// Cargar la vista
$clientes = obtenerClientes($conn);
require("views/form_cliente.php");
require("views/lista_clientes.php");
?>
