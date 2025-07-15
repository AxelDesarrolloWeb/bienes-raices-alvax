<?php
function conectarDB() : mysqli {
    $db = mysqli_connect('localhost:3306', 'root', 'root', 'bienes_raices_alvax_2');

    if( !$db) {
        echo "Error de conexión";
        exit;
    } 
    $msj = "Conexión exitosa";
    // echo $msj;
    return $db;
}