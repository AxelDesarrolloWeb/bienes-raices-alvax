<?php
require 'includes/config/database.php';
$db = conectarDB();
$errores = [];

// Autenticar el usuario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $email = mysqli_real_escape_string($db, filter_var($_POST['email'], FILTER_VALIDATE_EMAIL));

    $password = mysqli_real_escape_string($db, $_POST['password']);

    if (!$email) {
        $errores[] = "El email es obligatorio o no es válido";
    };

    if (!$password) {
        $errores[] = "El password es obligatorio";
    };

    if (empty($errores)) {
        $errores[] = "El email y password son obligatorios";

        // Revisar si el usuario existe 
        $query = "SELECT * FROM usuarios WHERE email = '{$email}'";
        $resultado = mysqli_query($db, $query);

        if ($resultado->num_rows) {
            $usuario = mysqli_fetch_assoc($resultado);

            // var_dump($usuario['password']);

            $auth = password_verify($password, $usuario['password']);

            if ($auth) {
                // El usuario está autenticado
                session_start();

                //Llenar el arreglo de la sesión
                $_SESSION['usuario'] = $usuario['email'];
                $_SESSION['login'] = true;

                header('Location: /admin');

            } else {
                $errores[] = "El password es incorrecto";
            }
        } else {
            $errores[] = "El usuario no existe";
        }
    };
}

require 'includes/funciones.php';
incluirTemplate('header');
?>

<main class="contenedor seccion">
    <h1>Iniciar Sesión</h1>

    <?php foreach ($errores as $error) : ?>

        <div class="alerta error">
            <?php echo $error;  ?>
        </div>

    <?php endforeach;  ?>

    <form method="POST" class="formulario">
        <fieldset>
            <legend>Email y Password</legend>
            <label for="email">E-mail:</label>
            <input type="email" id="email" name="email" placeholder="Tu email" required>

            <label for="password">password:</label>
            <input type="password" id="password" name="password" placeholder="Tu password" required>

            <input type="submit" value="Iniciar Sesión" class="boton boton-verde">
        </fieldset>
    </form>
</main>

<?php
// incluirTemplate('footer');   
include 'includes/templates/footer.php';
?>