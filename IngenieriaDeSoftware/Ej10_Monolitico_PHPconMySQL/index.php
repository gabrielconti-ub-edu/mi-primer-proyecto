<?php
// =============================================
// CONFIGURACIÓN DE CONEXIÓN A BASE DE DATOS
// =============================================
$host = "localhost";
$user = "root";
$pass = "root";
$dbname = "crud_clientes";

$conn = mysqli_connect($host, $user, $pass, $dbname);

if (!$conn) {
    die("Error de conexión: " . mysqli_connect_error());
}

// =============================================
// MANEJO DE ACCIONES CRUD
// =============================================
$accion = isset($_POST['accion']) ? $_POST['accion'] : '';

if ($accion == 'agregar') {
    $nombre = $_POST['nombre'];
    $domicilio = $_POST['domicilio'];
    $mail = $_POST['mail'];
    $telefono = $_POST['telefono'];

    $sql = "INSERT INTO clientes (NOMBRE_CLI, DOMICILIO, MAIL, TELEFONO) 
            VALUES ('$nombre', '$domicilio', '$mail', '$telefono')";
    mysqli_query($conn, $sql);
}

if ($accion == 'eliminar') {
    $id = $_POST['id'];
    $sql = "DELETE FROM clientes WHERE CLIENTE_ID=$id";
    mysqli_query($conn, $sql);
}

if ($accion == 'editar') {
    $id = $_POST['id'];
    $nombre = $_POST['nombre'];
    $domicilio = $_POST['domicilio'];
    $mail = $_POST['mail'];
    $telefono = $_POST['telefono'];

    $sql = "UPDATE clientes 
            SET NOMBRE_CLI='$nombre', DOMICILIO='$domicilio', MAIL='$mail', TELEFONO='$telefono'
            WHERE CLIENTE_ID=$id";
    mysqli_query($conn, $sql);
}

$cliente_editar = null;
if ($accion == 'seleccionar') {
    $id = $_POST['id'];
    $resultado = mysqli_query($conn, "SELECT * FROM clientes WHERE CLIENTE_ID=$id");
    $cliente_editar = mysqli_fetch_assoc($resultado);
}

// =============================================
// CONSULTA DE LISTADO DE CLIENTES
// =============================================
$resultado = mysqli_query($conn, "SELECT * FROM clientes ORDER BY CLIENTE_ID ASC");
?>

<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>CRUD de Clientes con MySQL</title>
<style>
    body {
        font-family: "Segoe UI", Arial, sans-serif;
        margin: 40px;
        background-color: #f4f6f8;
        color: #333;
    }
    h1 {
        color: #0a3d62;
        text-align: center;
        margin-bottom: 20px;
    }
    form {
        background: white;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        width: 400px;
        margin: auto;
    }
    input[type=text], input[type=email] {
        width: 100%;
        padding: 8px;
        margin-bottom: 10px;
        border: 1px solid #ccc;
        border-radius: 5px;
    }
    button {
        background-color: #0a3d62;
        color: white;
        padding: 8px 12px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
    }
    button:hover {
        background-color: #1e5799;
    }
    table {
        width: 90%;
        margin: 30px auto;
        border-collapse: collapse;
        background-color: white;
        box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    }
    th, td {
        border: 1px solid #ddd;
        padding: 10px;
        text-align: left;
    }
    th {
        background-color: #0a3d62;
        color: white;
    }
    .acciones form {
        display: inline;
    }
    .acciones button {
        background-color: #38ada9;
        margin-right: 4px;
    }
    .acciones button.eliminar {
        background-color: #b33939;
    }
</style>
</head>
<body>

<h1>Gestión de Clientes</h1>

<form method="post">
    <input type="hidden" name="id" value="<?php echo $cliente_editar ? $cliente_editar['CLIENTE_ID'] : ''; ?>">

    <label>Nombre:</label><br>
    <input type="text" name="nombre" required value="<?php echo $cliente_editar ? $cliente_editar['NOMBRE_CLI'] : ''; ?>"><br>

    <label>Domicilio:</label><br>
    <input type="text" name="domicilio" required value="<?php echo $cliente_editar ? $cliente_editar['DOMICILIO'] : ''; ?>"><br>

    <label>Email:</label><br>
    <input type="email" name="mail" required value="<?php echo $cliente_editar ? $cliente_editar['MAIL'] : ''; ?>"><br>

    <label>Teléfono:</label><br>
    <input type="text" name="telefono" required value="<?php echo $cliente_editar ? $cliente_editar['TELEFONO'] : ''; ?>"><br><br>

    <?php if ($cliente_editar): ?>
        <button type="submit" name="accion" value="editar">💾 Guardar Cambios</button>
        <a href="index.php"><button type="button">↩️ Cancelar</button></a>
    <?php else: ?>
        <button type="submit" name="accion" value="agregar">➕ Agregar Cliente</button>
    <?php endif; ?>
</form>

<table>
    <tr>
        <th>ID</th>
        <th>Nombre</th>
        <th>Domicilio</th>
        <th>Mail</th>
        <th>Teléfono</th>
        <th>Acciones</th>
    </tr>

    <?php while ($fila = mysqli_fetch_assoc($resultado)): ?>
    <tr>
        <td><?php echo $fila['CLIENTE_ID']; ?></td>
        <td><?php echo $fila['NOMBRE_CLI']; ?></td>
        <td><?php echo $fila['DOMICILIO']; ?></td>
        <td><?php echo $fila['MAIL']; ?></td>
        <td><?php echo $fila['TELEFONO']; ?></td>
        <td class="acciones">
            <form method="post">
                <input type="hidden" name="id" value="<?php echo $fila['CLIENTE_ID']; ?>">
                <button type="submit" name="accion" value="seleccionar">✏️ Editar</button>
            </form>
            <form method="post" onsubmit="return confirm('¿Desea eliminar este cliente?');">
                <input type="hidden" name="id" value="<?php echo $fila['CLIENTE_ID']; ?>">
                <button type="submit" name="accion" value="eliminar" class="eliminar">🗑️ Eliminar</button>
            </form>
        </td>
    </tr>
    <?php endwhile; ?>
</table>

</body>
</html>
