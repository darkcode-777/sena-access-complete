     document.getElementById('recoveryForm').addEventListener('submit', function(event) {
      event.preventDefault();

      const email = document.getElementById('emailInput').value.trim();

      if (!email || !/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)) {
        alert("Por favor, introduce un correo válido.");
        return;
      }

      const generatedPassword = Math.random().toString(36).slice(-8);

      const templateParams = {
        user_email: email,
        user_password: generatedPassword
      };

      emailjs.send('service_512330c', 'template_7ybibpm', templateParams)
        .then(function(response) {
          window.location.href = "ENVIO/recuperacion.html";
        }, function(error) {
          console.error('❌ Error al enviar:', error);
          alert("❌ Error al enviar el correo:\n" + (error.text || JSON.stringify(error)));
          document.getElementById('mensaje').innerText = "Error al enviar el correo.";
        });
    });