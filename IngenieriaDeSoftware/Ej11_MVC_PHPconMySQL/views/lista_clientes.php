<table style="width:90%;margin:30px auto;border-collapse:collapse;background:white;box-shadow:0 2px 8px rgba(0,0,0,0.1);">
    <tr style="background-color:#1e3799;color:white;">
        <th>ID</th>
        <th>Nombre</th>
        <th>Domicilio</th>
        <th>Mail</th>
        <th>Teléfono</th>
        <th>Acciones</th>
    </tr>

    <?php while ($fila = mysqli_fetch_assoc($clientes)): ?>
    <tr>
        <td><?php echo $fila['CLIENTE_ID']; ?></td>
        <td><?php echo $fila['NOMBRE_CLI']; ?></td>
        <td><?php echo $fila['DOMICILIO']; ?></td>
        <td><?php echo $fila['MAIL']; ?></td>
        <td><?php echo $fila['TELEFONO']; ?></td>
        <td style="text-align:center;">
            <form method="post" action="index.php" style="display:inline;">
                <input type="hidden" name="id" value="<?php echo $fila['CLIENTE_ID']; ?>">
                <button type="submit" name="accion" value="seleccionar" style="background-color:#38ada9;">✏️ Editar</button>
            </form>
            <form method="post" action="index.php" style="display:inline;" onsubmit="return confirm('¿Eliminar cliente?');">
                <input type="hidden" name="id" value="<?php echo $fila['CLIENTE_ID']; ?>">
                <button type="submit" name="accion" value="eliminar" style="background-color:#b33939;">🗑️ Eliminar</button>
            </form>
        </td>
    </tr>
    <?php endwhile; ?>
</table>

</body>
</html>
