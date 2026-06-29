<?php
class Database {
    private static $host = "localhost";
    private static $user = "root";
    private static $pass = "root";
    private static $dbname = "crud_clientes";
    private static $conn;

    public static function connect() {
        if (!self::$conn) {
            self::$conn = new mysqli(self::$host, self::$user, self::$pass, self::$dbname);
            if (self::$conn->connect_error) {
                die("Error de conexión: " . self::$conn->connect_error);
            }
        }
        return self::$conn;
    }
}
?>
