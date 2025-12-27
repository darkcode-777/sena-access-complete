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
    $serial_portatil = $conn->real_escape_string($_POST['serial_portatil']);

    // 📌 Verificar si el documento ya existe
    $check = $conn->query("SELECT id FROM aprendices WHERE documento = '$documento'");
    if ($check->num_rows > 0) {
        echo "<script>alert('⚠️ Este aprendiz ya se encuentra registrado'); window.location.href='portatil.html';</script>";
        exit;
    }

    // Carpeta de subida
    $uploadDir = "../../uploads/";
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0777, true);
    }

    // Guardar imagen del portátil
    $imagen_portatil = "";
    if (!empty($_FILES['imagen_portatil']['name'])) {
        $imagen_portatil = $uploadDir . time() . "_portatil_" . basename($_FILES['imagen_portatil']['name']);
        move_uploaded_file($_FILES['imagen_portatil']['tmp_name'], $imagen_portatil);
    }

    // Insertar datos en la base
    $sql = "INSERT INTO aprendices 
        (nombre, apellido, correo, ficha, telefono, tipo_documento, documento, imagen_portatil, serial_portatil) 
        VALUES 
        ('$nombre', '$apellido', '$correo', '$ficha', '$telefono', '$tipo_documento', '$documento', '$imagen_portatil', '$serial_portatil')";

    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('✅ Aprendiz registrado correctamente'); window.location.href='portatil.html';</script>";
    } else {
        echo "❌ Error al registrar: " . $conn->error;
    }
}
?>
