<?php 

// Importar la conexión
require './includes/config/database.php';
$db = conectarDB();

// Crear un email y password 
$email = "alvax@alvax.com";
$password = "123456";

$passwordHash = password_hash($password, PASSWORD_BCRYPT);

var_dump($passwordHash);

// Query para crear el usuario
$query = " INSERT INTO usuarios (email, password )  VALUES ( '{$email}', '{$passwordHash}'); ";
echo $query;

// Agregarlo a la base de datos
mysqli_query($db, $query);

?>