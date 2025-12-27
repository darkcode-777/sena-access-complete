<?php
// Datos de conexión a la base de datos
$servername = "localhost";
$username   = "root"; // Por defecto en XAMPP
$password   = "";     // Por defecto en XAMPP
$dbname     = "sena_access";

// Conectar a la base de datos
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("❌ Error de conexión: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    // Escapar datos
    $nombre          = $conn->real_escape_string($_POST['nombre']);
    $apellido        = $conn->real_escape_string($_POST['apellido']);
    $correo          = $conn->real_escape_string($_POST['correo']);
    $ficha           = $conn->real_escape_string($_POST['ficha']);
    $telefono        = $conn->real_escape_string($_POST['telefono']);
    $tipo_documento  = $conn->real_escape_string($_POST['tipo_documento']);
    $documento       = $conn->real_escape_string($_POST['documento']);

    // 📌 Verificar si el documento ya existe
    $check = $conn->query("SELECT id FROM aprendices WHERE documento = '$documento'");
    if ($check->num_rows > 0) {
        echo "<script>alert('⚠️ Este aprendiz ya se encuentra registrado'); window.location.href='moto.html';</script>";
        exit;
    }

    // Carpeta de subida
    $uploadDir = "../../uploads/";
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0777, true);
    }

    // Guardar archivo propiedad moto
    $propiedad_moto = "";
    if (!empty($_FILES['propiedad_moto']['name'])) {
        $propiedad_moto = $uploadDir . time() . "_moto_" . basename($_FILES['propiedad_moto']['name']);
        move_uploaded_file($_FILES['propiedad_moto']['tmp_name'], $propiedad_moto);
    }

    // Insertar datos en la base
    $sql = "INSERT INTO aprendices 
        (nombre, apellido, correo, ficha, telefono, tipo_documento, documento, propiedad_moto) 
        VALUES 
        ('$nombre', '$apellido', '$correo', '$ficha', '$telefono', '$tipo_documento', '$documento', '$propiedad_moto')";

    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('✅ Aprendiz registrado correctamente'); window.location.href='moto.html';</script>";
    } else {
        echo "❌ Error al registrar: " . $conn->error;
    }
}
?>
