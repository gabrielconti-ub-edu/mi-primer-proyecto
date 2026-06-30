<?php

// Render te proporcionará una variable llamada DATABASE_URL completa, o datos separados.
// Aquí usamos los datos individuales que configuraremos en la interfaz de Render.
$host = getenv('DB_HOST');
$db   = getenv('DB_DATABASE');
$user = getenv('DB_USER');
$pass = getenv('DB_PASSWORD');
$port = getenv('DB_PORT') ?: "5432";

try {
    $dsn = "pgsql:host=$host;port=$port;dbname=$db;";
    $pdo = new PDO($dsn, $user, $pass, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
    // Tu conexión está lista
} catch (PDOException $e) {
    echo "Error de conexión: " . $e->getMessage();
}

/*
// UniServer se conecta con estos datos.

error_reporting(E_ALL);
ini_set('display_errors', 1);

$conexion = mysqli_connect("localhost", "root", "root", "crud_clientes");
if (!$conexion) {
    die("❌ Error conectando: " . mysqli_connect_error());
}
echo "✅ Conectado correctamente a la base de datos";

*/
?>
