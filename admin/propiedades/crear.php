<?php
require './includes/funciones.php';
$auth = estaAutenticado();

if (!$auth) {
    header('Location: /');
}

require './includes/config/database.php';
$db = conectarDB();

// Consultar para obtener los vendedores
$consulta = "SELECT * FROM vendedores";
$resultado = mysqli_query($db, $consulta);

incluirTemplate('header');

//Arreglo con mensajes de errores
$errores = [];

$titulo = '';
$precio = '';
$descripcion = '';
$habitaciones = '';
$wc = '';
$estacionamiento = '';
$creado = date('Y/m/d');
$vendedores_id = '';

// Comprobar si el usuario ha enviado el formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $titulo = mysqli_real_escape_string($db, $_POST['titulo']);
    $precio = mysqli_real_escape_string($db, $_POST['precio']);
    $descripcion = mysqli_real_escape_string($db, $_POST['descripcion']);
    $habitaciones = mysqli_real_escape_string($db, $_POST['habitaciones']);
    $wc = mysqli_real_escape_string($db, $_POST['wc']);
    $estacionamiento = mysqli_real_escape_string($db, $_POST['estacionamiento']);
    $vendedores_id = mysqli_real_escape_string($db, $_POST['vendedores_id']);

    // Asignar files hacia una variable:
    $imagen = $_FILES['imagen'];

    if (!$titulo) {
        $errores[] = "Debes añadir un título";
    }
    if (!$precio) {
        $errores[] = "Debes añadir un precio";
    }
    if (strlen($descripcion) < 30) {
        $errores[] = "Debes añadir una descripción de al menos 30 caracteres";
    }
    if (strlen($descripcion) > 150) {
        $errores[] = "Debes añadir una descripción de máximo 150 caracteres";
    }
    if (!$habitaciones) {
        $errores[] = "Debes añadir el número de habitaciones";
    }
    if (!$wc) {
        $errores[] = "Debes añadir el número de baños";
    }
    if (!$estacionamiento) {
        $errores[] = "Debes añadir el número de lugares de estacionamiento";
    }
    if (!$vendedores_id) {
        $errores[] = "Debes seleccionar un vendedor";
    }
    if (!$imagen['name'] || $imagen['error']) {
        $errores[] = "La imagen es obligatoria";
    }
    // Validar por tamaño(1mb máximo)
    $medida = 1000 * 1000;

    if ($imagen['size'] > $medida) {
        $errores[] = "La imagen es muy pesada";
    }

    if (empty($errores)) {
        // ** SUBIDA DE ARCHIVOS ** //
        // Crear carpeta
        $carpetaImagenes = './imagenes/';
        if (!is_dir($carpetaImagenes)) {
            mkdir($carpetaImagenes);
        }

        // Generar un nombre único
        $nombreImagen = md5("HOLA");
        $nombreImagen = md5(uniqid(rand(), true)) . ".jpg";
        var_dump($nombreImagen);

        // Subir la imagen
        move_uploaded_file($imagen['tmp_name'], $carpetaImagenes . $nombreImagen);


        // Insertar en la base de datos
        $query = "INSERT INTO propiedades (titulo, precio, imagen, descripcion, habitaciones,  wc, estacionamiento, creado, vendedores_id) 
        VALUES ('$titulo', '$precio', '$nombreImagen', '$descripcion', '$habitaciones',  '$wc', '$estacionamiento','$creado', '$vendedores_id')";

        echo $query;

        $resultado = mysqli_query($db, $query);

        if ($resultado) {
            // Redireccionar al usuario
            echo "Se ha insertado correctamente";
            header('Location: /admin?resultado=1');
            // header('Location: /admin?mensaje=Registrado Correctamente&registrado=1');
        } else {
            // Error
            echo "Error, no se pudo insertar";
        }
    }
}

?>
<main class="contenedor seccion">
    <h1>Crear</h1>

    <?php foreach ($errores as $error): ?>
        <div class="alerta error">
            <?php echo $error; ?>
        </div>
    <?php endforeach; ?>

    <form class="formulario" method="POST" action="/admin/propiedades/crear.php" enctype="multipart/form-data">
        <fieldset>
            <legend>Información general</legend>

            <label for="titulo">Título:</label>
            <input type="text" id="titulo" name="titulo" placeholder="Título propiedad" value="<?php echo $titulo; ?>">

            <label for="precio">Precio</label>
            <input type="number" id="precio" name="precio" placeholder="Precio propiedad" value="<?php echo $precio; ?>">

            <label for="imagen">Imagen"></label>
            <input type="file" id="imagen" name="imagen" accept="image/jpeg, image/png, image/webp">

            <label for="descripcion">Descripción</label>
            <textarea id="descripcion" name="descripcion" placeholder="Descripción de la propiedad" value="<?php echo $descripcion; ?>"></textarea>
        </fieldset>
        <fieldset>
            <legend>Información propiedad</legend>

            <label for="habitaciones">Habitaciones</label>
            <input type="number" id="habitaciones" name="habitaciones" placeholder="Ej: 3" min="1" max="9" step="1" value="<?php echo $habitaciones; ?>">

            <label for="wc">Baños</label>
            <input type="number" id="wc" name="wc" placeholder="Ej: 2" min="1" max="9" step="1" value="<?php echo $wc; ?>">

            <label for="estacionamiento">Estacionamiento</label>
            <input type="number" id="estacionamiento" name="estacionamiento" placeholder="Ej: 1" min="1" max="9" step="1" value="<?php echo $estacionamiento; ?>">
        </fieldset>

        <fieldset>
            <legend>Vendedor</legend>
            <select name="vendedores_id" id="vendedores_id">
                <option value="">--Seleccione un vendedor--</option>
                <?php while ($vendedores_id = mysqli_fetch_assoc($resultado)) : ?>
                    <option <?php echo $vendedores_id === $vendedores_id['id'] ? 'selected' : ''; ?> value="<?php echo $vendedores_id['id']; ?>">
                        <?php echo $vendedores_id['nombre'] . " " . $vendedores_id['apellido']; ?> </option>
                <?php endwhile; ?>
            </select>
        </fieldset>

        <div class="forma-contacto botones">
            <input type="submit" value="Crear propiedad" class="boton boton-verde">
            <button onclick="location.href='../index.php'" class="boton boton-rojo">Volver</button>
        </div>
    </form>
</main>

<?php
incluirTemplate('footer');
?>