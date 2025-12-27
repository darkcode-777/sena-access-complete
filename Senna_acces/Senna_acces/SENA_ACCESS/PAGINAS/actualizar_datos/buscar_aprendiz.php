<?php
$servername = "localhost";
$username   = "root";
$password   = "";
$dbname     = "sena_access";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) { die("Error: " . $conn->connect_error); }

$ficha          = $_GET['ficha'];
$tipo_documento = $_GET['tipo_documento'];
$documento      = $_GET['documento'];

$sql = "SELECT * FROM aprendices WHERE ficha='$ficha' AND tipo_documento='$tipo_documento' AND documento='$documento'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $aprendiz = $result->fetch_assoc();
    ?>
    <!DOCTYPE html>
    <html lang="es">
    <head>
    <meta charset="UTF-8">
    <title>Actualizar Aprendiz</title>
    <link rel="stylesheet" href="../paginas.css">
    </head>
    <body>
    <div class="sidebar">
      <h2>BIENVENIDO</h2>
      <a href="../aprendizes.html">Aprendices</a>
      <a href="../actividad_de_ingresos_salidas.html">Actividad de Ingresos y Salidas</a>
      <a href="../escanear_qr.html">Escanear QR</a>
    </div>

    <div class="content">
      <h3>Actualizar Datos del Aprendiz</h3>
      <form action="actualizar_aprendiz.php" method="POST">
        <input type="hidden" name="id" value="<?php echo $aprendiz['id']; ?>">

        <label>Nombre:</label>
        <input type="text" name="nombre" value="<?php echo $aprendiz['nombre']; ?>" required>

        <label>Apellido:</label>
        <input type="text" name="apellido" value="<?php echo $aprendiz['apellido']; ?>" required>

        <label>Correo:</label>
        <input type="email" name="correo" value="<?php echo $aprendiz['correo']; ?>" required>

        <label>Teléfono:</label>
        <input type="text" name="telefono" value="<?php echo $aprendiz['telefono']; ?>" required>

        <label>Número de Ficha:</label>
        <input type="text" name="ficha" value="<?php echo $aprendiz['ficha']; ?>" required>

        <label>Tipo de Documento:</label>
        <select name="tipo_documento" required>
          <option value="CC" <?php if($aprendiz['tipo_documento']=="CC") echo "selected"; ?>>Cédula de ciudadanía</option>
          <option value="TI" <?php if($aprendiz['tipo_documento']=="TI") echo "selected"; ?>>Tarjeta de identidad</option>
          <option value="CE" <?php if($aprendiz['tipo_documento']=="CE") echo "selected"; ?>>Cédula de extranjería</option>
          <option value="PPT" <?php if($aprendiz['tipo_documento']=="PPT") echo "selected"; ?>>PPT</option>
        </select>

        <label>Número de Documento:</label>
        <input type="text" name="documento" value="<?php echo $aprendiz['documento']; ?>" required>

        <br><br>
        <button type="submit">Guardar Cambios</button>
      </form>
    </div>
    </body>
    </html>
    <?php
} else {
    echo "<script>alert('❌ Aprendiz no encontrado'); window.location.href='actualizar.html';</script>";
}
$conn->close();
?>
