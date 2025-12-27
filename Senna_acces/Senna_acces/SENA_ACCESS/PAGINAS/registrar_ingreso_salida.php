<?php
header("Content-Type: text/plain; charset=UTF-8");

// Datos de conexión
$servername = "localhost";
$username   = "root";
$password   = "";
$dbname     = "sena_access";

// Conectar
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    echo "error: conexion fallida";
    exit;
}

// Validar petición
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['codigo'])) {
    $codigo = $conn->real_escape_string($_POST['codigo']);

    // Buscar aprendiz
    $sql = "SELECT id, nombre FROM aprendices WHERE documento = '$codigo'";
    $result = $conn->query($sql);

    if ($result && $result->num_rows > 0) {
        echo "ok"; // ✅ encontrado
    } else {
        echo "no"; // ❌ no encontrado
    }
} else {
    echo "error: peticion invalida";
}

$conn->close();
?>
