<?php include __DIR__ . '/../layout/header.php'; ?>

<h2>Listado de Clientes</h2>

<table>
  <thead>
    <tr>
      <th>ID</th><th>Nombre</th><th>Domicilio</th><th>Mail</th><th>Teléfono</th><th>Acciones</th>
    </tr>
  </thead>
  <tbody>
    <?php while ($row = $clientes->fetch_assoc()): ?>
      <tr>
        <td><?= $row['CLIENTE_ID'] ?></td>
        <td><?= htmlspecialchars($row['NOMBRE_CLI']) ?></td>
        <td><?= htmlspecialchars($row['DOMICILIO']) ?></td>
        <td><?= htmlspecialchars($row['MAIL']) ?></td>
        <td><?= htmlspecialchars($row['TELEFONO']) ?></td>
        <td>
          <a href="index.php?action=edit&id=<?= $row['CLIENTE_ID'] ?>">Editar</a> |
          <a href="index.php?action=delete&id=<?= $row['CLIENTE_ID'] ?>" onclick="return confirmarEliminar()">Eliminar</a>
        </td>
      </tr>
    <?php endwhile; ?>
  </tbody>
</table>

<?php include __DIR__ . '/../layout/footer.php'; ?>
