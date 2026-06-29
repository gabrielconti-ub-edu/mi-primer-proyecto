<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

$conexion = mysqli_connect("localhost", "root", "root", "crud_clientes");
if (!$conexion) {
    die("❌ Error conectando: " . mysqli_connect_error());
}
echo "✅ Conectado correctamente a la base de datos";
?>
