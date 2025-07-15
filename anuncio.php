<?php 
$id = $_GET['id'];
$id = filter_var($id, FILTER_VALIDATE_INT);

if (!$id) {
    header('Location: /');
}

// Importar la conexión
    require 'includes/config/database.php';
    $db = conectarDB();

    // consultar
    $query = "SELECT * FROM propiedades WHERE id = {$id}";

    // Obtener resultado
    $resultado = mysqli_query($db, $query);

    if (!$resultado -> num_rows) {
        header('Location: /');
    }
    $propiedad = mysqli_fetch_assoc($resultado);
    
    include 'includes/templates/header.php';
    require 'includes/funciones.php';
?>


<main class="contenedor seccion contenido-centrado">
    <h1><?php echo $propiedad['titulo'];?></h1>

        <img src="/imagenes/<?php echo $propiedad['imagen']; ?>" alt="Imagen destacada de la propiedad" loading="lazy">    

    <div class="resumen-propiedad">
        <p class="precio">$<?php echo $propiedad['precio']; ?></p>
        <ul class="iconos-caracteristicas">
            <li>
                <img class="icono" src="build/img/icono_wc.svg" alt="Icono wc" loading="lazy">
                <p><?php echo $propiedad['wc']; ?></p>
            </li>
            <li>
                <img class="icono" src="build/img/icono_estacionamiento.svg" alt="Icono Estacionamiento"
                    loading="lazy">
                <p><?php echo $propiedad['estacionamiento']; ?></p>
            </li>
            <li>
                <img class="icono" src="build/img/icono_dormitorio.svg" alt="Icono Habitaciones" loading="lazy">
                <p><?php echo $propiedad['habitaciones']; ?></p>
            </li>
        </ul>

        <p><?php echo $propiedad['descripcion']; ?></p>

    </div> <!-- .contenido-anuncio -->
</main>

<?php 
mysqli_close($db);
include 'includes/templates/footer.php'; ?>