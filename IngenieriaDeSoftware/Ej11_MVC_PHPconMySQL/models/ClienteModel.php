<?php
function obtenerClientes($conn) {
    $sql = "SELECT * FROM clientes ORDER BY CLIENTE_ID ASC";
    return mysqli_query($conn, $sql);
}

function obtenerClientePorId($conn, $id) {
    $sql = "SELECT * FROM clientes WHERE CLIENTE_ID=$id";
    $resultado = mysqli_query($conn, $sql);
    return mysqli_fetch_assoc($resultado);
}

function agregarCliente($conn, $nombre, $domicilio, $mail, $telefono) {
    $sql = "INSERT INTO clientes (NOMBRE_CLI, DOMICILIO, MAIL, TELEFONO)
            VALUES ('$nombre', '$domicilio', '$mail', '$telefono')";
    return mysqli_query($conn, $sql);
}

function actualizarCliente($conn, $id, $nombre, $domicilio, $mail, $telefono) {
    $sql = "UPDATE clientes 
            SET NOMBRE_CLI='$nombre', DOMICILIO='$domicilio', MAIL='$mail', TELEFONO='$telefono'
            WHERE CLIENTE_ID=$id";
    return mysqli_query($conn, $sql);
}

function eliminarCliente($conn, $id) {
    $sql = "DELETE FROM clientes WHERE CLIENTE_ID=$id";
    return mysqli_query($conn, $sql);
}
?>
