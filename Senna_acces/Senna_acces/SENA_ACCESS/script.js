    // Define las credenciales válidas
    const CORREO_VALIDO = "ingresosena555@gmail.com";
    const CLAVE_VALIDA = "Sena2025**";

    document.getElementById('loginForm').addEventListener('submit', function(event) {
      event.preventDefault(); // Evita que se envíe el formulario

      const email = event.target.email.value;
      const password = event.target.password.value;

      if (email === CORREO_VALIDO && password === CLAVE_VALIDA) {
        localStorage.setItem("logueado", "true"); // Guardar estado de login (no seguro en producción)
        window.location.href = "PAGINAS/aprendizes.html"; // Redirección correcta
      } else {
        alert("Correo o contraseña incorrectos.");
      }
    });