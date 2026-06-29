<?php include __DIR__ . '/../layout/header.php'; ?>

<h2>Agregar Cliente</h2>

<form action="index.php?action=store" method="post">
  <label>Nombre:</label><input type="text" name="nombre" required><br>
  <label>Domicilio:</label><input type="text" name="domicilio" required><br>
  <label>Mail:</label><input type="email" name="mail" required><br>
  <label>Teléfono:</label><input type="text" name="telefono" required><br>
  <button type="submit">Guardar</button>
</form>

<?php include __DIR__ . '/../layout/footer.php'; ?>
