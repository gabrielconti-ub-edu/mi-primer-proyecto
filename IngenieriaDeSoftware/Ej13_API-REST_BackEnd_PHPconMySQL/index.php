<?php
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization");

require_once __DIR__ . '/config/database.php';
require_once __DIR__ . '/controllers/ClienteController.php';

$database = new Database();
$db = $database->getConnection();
$controller = new ClienteController($db);

$method = $_SERVER['REQUEST_METHOD'];
$request = explode('/', trim($_SERVER['PATH_INFO'] ?? '', '/'));
$resource = $request[0] ?? '';
$id = $request[1] ?? null;

if ($resource !== 'clientes') {
    http_response_code(404);
    echo json_encode(["error" => "Recurso no encontrado"]);
    exit;
}

switch ($method) {
    case 'GET':
        if ($id) $controller->show($id);
        else $controller->index();
        break;

    case 'POST':
        $data = json_decode(file_get_contents("php://input"), true);
        $controller->store($data);
        break;

    case 'PUT':
        $data = json_decode(file_get_contents("php://input"), true);
        $controller->update($id, $data);
        break;

    case 'DELETE':
        $controller->delete($id);
        break;

    default:
        http_response_code(405);
        echo json_encode(["error" => "Método no permitido"]);
}
?>
