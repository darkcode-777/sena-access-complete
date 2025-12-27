<?php
$servername = "localhost";
$username   = "root";
$password   = "";
$dbname     = "sena_access";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) { die("Error: " . $conn->connect_error); }

$id            = $_POST['id'];
$nombre        = $_POST['nombre'];
$apellido      = $_POST['apellido'];
$correo        = $_POST['correo'];
$telefono      = $_POST['telefono'];
$ficha         = $_POST['ficha'];
$tipo_documento= $_POST['tipo_documento'];
$documento     = $_POST['documento'];

$sql = "UPDATE aprendices 
        SET nombre='$nombre', apellido='$apellido', correo='$correo', telefono='$telefono', ficha='$ficha', tipo_documento='$tipo_documento', documento='$documento'
        WHERE id='$id'";

if ($conn->query($sql) === TRUE) {
    echo "<script>alert('✅ Datos actualizados correctamente'); window.location.href='../aprendizes.html';</script>";
} else {
    echo "Error al actualizar: " . $conn->error;
}

$conn->close();
?>
