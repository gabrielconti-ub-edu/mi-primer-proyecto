
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
class Database {
    private $host = "localhost";
    private $db_name = "crud_clientes";
    private $username = "root";
    private $password = "root";
    public $conn;

    public function getConnection() {
        $this->conn = null;
        try {
            $this->conn = new PDO(
                "mysql:host={$this->host};dbname={$this->db_name};charset=utf8",
                $this->username,
                $this->password
            );
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo json_encode(["error" => "Error de conexión: " . $e->getMessage()]);
            exit;
        }
        return $this->conn;
    }
}
*/
?>
