<?php
$servername = "localhost";
$username   = "root"; // Usuario por defecto de XAMPP
$password   = "";     // Contraseña por defecto vacía
$dbname     = "sena_access"; // Cambia por el nombre de tu base de datos

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}
?>