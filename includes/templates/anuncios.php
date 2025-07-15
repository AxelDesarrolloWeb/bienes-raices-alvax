<?php 
    // Importar la conexión
    require 'includes/config/database.php';
    $db = conectarDB();

    // consultar
    $query = "SELECT * FROM propiedades LIMIT {$limite}";

    // Obtener resultado
    $resultado = mysqli_query($db, $query);
?>

<div class="contenedor-anuncios">
    <?php while($propiedad = mysqli_fetch_assoc($resultado)) :?>
            <div class="anuncio">
                <picture>
                    <img src="/imagenes/<?php echo $propiedad['imagen']; ?>" alt="Anuncio" loading="lazy">
                </picture>

                <div class="contenido-anuncio">
                    <h3><?php echo $propiedad['titulo']; ?></h3>
                    <p><?php echo $propiedad['descripcion']; ?></p>
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
                    <a href="anuncio.php?id=<?php echo $propiedad['id']; ?>" class="boton-amarillo-block">Ver Propiedad</a>

                </div> <!-- .contenido-anuncio -->
            </div> <!-- .anuncio -->
    <?php endwhile; ?>

</div> <!-- .contenedor-anuncio -->

        <?php 
            // Cerrar la conexión
            mysqli_close($db);
        ?>