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





<?php include __DIR__ . '/header.php'; ?>





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



<?php include __DIR__ . '/footer.php'; ?>

