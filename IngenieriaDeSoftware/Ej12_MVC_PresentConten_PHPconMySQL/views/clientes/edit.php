<?php include __DIR__ . '/../layout/header.php'; ?>

<h2>Editar Cliente</h2>

<form action="index.php?action=update&id=<?= $cliente['CLIENTE_ID'] ?>" method="post">
  <label>Nombre:</label><input type="text" name="nombre" value="<?= $cliente['NOMBRE_CLI'] ?>" required><br>
  <label>Domicilio:</label><input type="text" name="domicilio" value="<?= $cliente['DOMICILIO'] ?>" required><br>
  <label>Mail:</label><input type="email" name="mail" value="<?= $cliente['MAIL'] ?>" required><br>
  <label>Teléfono:</label><input type="text" name="telefono" value="<?= $cliente['TELEFONO'] ?>" required><br>
  <button type="submit">Actualizar</button>
</form>

<?php include __DIR__ . '/../layout/footer.php'; ?>
