<?php if (!isset($inicio)) $inicio = false; ?>

<?php 

if (!isset($_SESSION)) {
    session_start();
}

$auth = $_SESSION['login'] ?? null;
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienes Raíces</title>
    <link rel="stylesheet" href="/build/css/app.css">
</head>

<body>

    <header class="header <?php echo $inicio ? 'inicio' : ''; ?>">
        <div class="contenedor contenido-header">
            <div class="barra">
                <a href="/">
                    <img src="/build/img/logo.svg" alt="Logotipo de Bienes Raíces">
                </a>

                <div class="mobile-menu">
                    <img src="/build/img/barras.svg" alt="Icono Menu" loading="lazy">
                </div>

                <div class="derecha">
                    <img src="/build/img/dark-mode.svg" alt="Modo Oscuro" class="dark-mode-boton">
                    <nav class="navegacion soloIndex">
                        <a href="nosotros.php">Nosotros</a>
                        <a href="anuncios.php">Anuncios</a>
                        <a href="blog.php">Blog</a>
                        <a href="contacto.php">Contacto</a>
                        <?php if ($auth):?>
                            <a href="cerrar-sesion.php">Cerrar sesión</a>
                        <?php endif;?>
                    </nav>
                </div>

            </div><!-- .barra -->

            <?php echo $inicio ? "<h1>Venta de Casas y Departamentos Exclusivos de Lujo</h1>" : ''; ?>
            
        </div>
    </header>