<?php
// Obtiene el directorio donde está ubicado este archivo
$directorio_actual = __DIR__;

// Obtiene todos los archivos y carpetas
$elementos = scandir($directorio_actual);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Índice de directorio</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 0; padding: 20px; background-color: #f9f9f9; }
        .contenedor { background: white; border-radius: 8px; box-shadow: 0 2px 5px rgba(0,0,0,0.1); max-width: 800px; margin: 30px auto; overflow: hidden; }
        .banner { background-color: #1e3a8a; color: white; text-align: center; padding: 20px 10px; font-size: 24px; font-weight: bold; letter-spacing: 0.5px; }
        .contenido-interno { padding: 20px; }
        .controles { margin-bottom: 20px; padding-bottom: 10px; border-bottom: 1px dashed #ccc; display: flex; align-items: center; gap: 10px; }
        .controles input { cursor: pointer; width: 16px; height: 16px; }
        .controles label { cursor: pointer; font-size: 14px; font-weight: bold; color: #444; }
        ul { list-style-type: none; padding: 0; margin: 0; }
        li { padding: 10px 0; border-bottom: 1px solid #eee; display: flex; align-items: center; }
        li:last-child { border-bottom: none; }
        .carpeta { font-weight: bold; color: #0056b3; text-decoration: none; }
        .archivo { color: #333; text-decoration: none; }
        .carpeta::before { content: "📁  "; }
        .archivo::before { content: "📄  "; }
        
        /* Clase para ocultar los archivos dinámicamente */
        .ocultar-archivos .item-archivo { display: none !important; }
    </style>
</head>
<body>

<div class="contenedor">
    <!-- Banner con el mismo ancho y radio del contenedor -->
    <div class="banner">
        Ejemplos de práctica
    </div>

    <div class="contenido-interno">
        <h2>Contenido de la carpeta:</h2>
        <p><em><?php echo $directorio_actual; ?></em></p>
        
        <!-- Checkbox para controlar la visualización -->
        <!-- el checkbox inicia desmarcado y la etiqueta dice Ocultar archivos -->
        <div class="controles">
            <input type="checkbox" id="chk-archivos">
            <label id="lbl-archivos" for="chk-archivos">Ocultar archivos</label>
        </div>

        <!-- Modificado: se añade la clase 'ocultar-archivos' por defecto -->
        <ul id="lista-elementos" class="ocultar-archivos">
            <?php
            foreach ($elementos as $item) {
                // Ignorar los directorios del sistema actual (.) y padre (..)
                if ($item === '.' || $item === '..') {
                    continue;
                }

                // Verificar si es un directorio para asignar la clase CSS correspondiente
                if (is_dir($directorio_actual . '/' . $item)) {
                    echo '<li class="item-carpeta"><a class="carpeta" href="' . $item . '/">' . $item . '</a></li>';
                } else {
                    echo '<li class="item-archivo"><a class="archivo" href="' . $item . '">' . $item . '</a></li>';
                }
            }
            ?>
        </ul>
    </div>
</div>

<script>
    // Script interactivo para ocultar/mostrar elementos sin recargar la página
    document.getElementById('chk-archivos').addEventListener('change', function() {
        const lista = document.getElementById('lista-elementos');
        const etiqueta = document.getElementById('lbl-archivos');
        
        // Modificado: si se marca, se muestran los archivos; si se desmarca, se ocultan
        if (this.checked) {
            lista.classList.remove('ocultar-archivos');
            etiqueta.textContent = 'Mostrar archivos';
        } else {
            lista.classList.add('ocultar-archivos');
            etiqueta.textContent = 'Ocultar archivos';
        }
    });
</script>

</body>
</html>
