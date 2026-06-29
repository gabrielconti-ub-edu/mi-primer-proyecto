<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Gestión de Clientes MVC</title>
<style>
    body {
        font-family: "Segoe UI", Arial;
        background-color: #f5f6fa;
        margin: 30px;
    }
    form {
        background: white;
        padding: 20px;
        width: 400px;
        border-radius: 10px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        margin: auto;
    }
    input[type=text], input[type=email] {
        width: 100%;
        padding: 8px;
        margin-bottom: 8px;
        border: 1px solid #ccc;
        border-radius: 5px;
    }
    button {
        background-color: #1e3799;
        color: white;
        padding: 8px 12px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
    }
    button:hover { background-color: #4a69bd; }
</style>
</head>
<body>

<h1 style="text-align:center;color:#1e3799;">Gestión de Clientes (MVC)</h1>

<form method="post" action="index.php">
    <input type="hidden" name="id" value="<?php echo $cliente_editar ? $cliente_editar['CLIENTE_ID'] : ''; ?>">

    <label>Nombre:</label>
    <input type="text" name="nombre" required value="<?php echo $cliente_editar ? $cliente_editar['NOMBRE_CLI'] : ''; ?>">

    <label>Domicilio:</label>
    <input type="text" name="domicilio" required value="<?php echo $cliente_editar ? $cliente_editar['DOMICILIO'] : ''; ?>">

    <label>Email:</label>
    <input type="email" name="mail" required value="<?php echo $cliente_editar ? $cliente_editar['MAIL'] : ''; ?>">

    <label>Teléfono:</label>
    <input type="text" name="telefono" required value="<?php echo $cliente_editar ? $cliente_editar['TELEFONO'] : ''; ?>">

    <br><br>
    <?php if ($cliente_editar): ?>
        <button type="submit" name="accion" value="editar">💾 Guardar Cambios</button>
        <a href="index.php"><button type="button">↩️ Cancelar</button></a>
    <?php else: ?>
        <button type="submit" name="accion" value="agregar">➕ Agregar Cliente</button>
    <?php endif; ?>
</form>
