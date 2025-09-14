<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.0/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Kreon:wght@300..700&display=swap" rel="stylesheet">
    <title>Logueo</title>
</head>
<body>
    <?php include 'menu.php' ; ?>

<main class="container my-5">
    <?php
    if (isset($_GET['result'])) {
        if ($_GET['result'] === 'regis_ok') {
            echo "<div id='mensaje-alerta' class='alert alert-success'>Registro realizado con éxito.</div>";
        } elseif ($_GET['result'] === 'error') {
            echo "<div id='mensaje-alerta' class='alert alert-danger'>" . $_GET['message'] . "</div>";
        }
    }
    ?>
  <section>
    <div class="card shadow-sm p-4">
      <form action="procesar/procesar_registro.php" method="post">

        <div class="mb-3">
          <label id="correo" for="email" class="form-label"></label>
          <input type="email" id="email" name="email" class="form-control" placeholder="Correo@mail.com" required />
        </div>
        <div class="invalid-feedback">
            Por favor ingresa un correo válido.
        </div>

        <div class="mb-3">
          <label id="contrasena" for="nombre" class="form-label"></label>
          <input type="password" id="password" name="password" class="form-control" placeholder="Contraseña" required />
        </div>

        <div class="mb-3">
          <label id="rep-contrasena" for="nombre" class="form-label"></label>
          <input type="password" id="password" name="password" class="form-control" placeholder="Repetir Contraseña" required />
        </div>

        <div class="mb-3">
          <label for="email" class="form-label"></label>
          <input type="text" id="nombre" name="nombre" class="form-control" placeholder="Nombre" required />
        </div>

        <div class="mb-3">
          <label for="email" class="form-label"></label>
          <input type="text" id="apellido" name="apellido" class="form-control" placeholder="Apellidos" required />
        </div>

        <div class="mb-3">
          <label for="email" class="form-label"></label>
          <input type="number" onkeypress="return soloNumeros(event)" id="ci" name="ci" class="form-control" placeholder="Cédula de identidad (sin guión)" required />
        </div>

        <div class="mb-3">
          <label for="email" class="form-label"></label>
          <input pattern="[0-9]{5}" type="number" onkeypress="return soloNumeros(event)" id="ingresos" name="ingresos" class="form-control" placeholder="Ingresos mensuales" required />
        </div>

        <div class="mb-3">
          <label for="email" class="form-label"></label>
          <input type="number" onkeypress="return soloNumeros(event)" id="cant-nf" name="cant-nf" class="form-control" placeholder="Cantidad de personas del núcleo familiar" required />
        </div>

        <button type="submit" class="btn btn-primary w-100">Registrarme</button>
      </form>
    </div>
  </section>
</main>

    <footer>

    </footer>
    <script>


        function soloNumeros(e) {
            var key = e.keyCode || e.which;
            if (key < 48 || key > 57) { // Códigos ASCII para 0-9
                return false;
            }
            return true;
        }

        document.addEventListener("DOMContentLoaded", function () {
        const emailInput = document.getElementById("email");

        emailInput.addEventListener("input", function () {
        const email = emailInput.value;
        const regex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

        if (!regex.test(email)) {
            emailInput.classList.add("is-invalid");
            emailInput.classList.remove("is-valid");
        } else {
            emailInput.classList.remove("is-invalid");
            emailInput.classList.add("is-valid");
        }
        });
    });

</script>

<script>
  // Espera 5 segundos y desvanece el mensaje
  setTimeout(() => {
    const alerta = document.getElementById('mensaje-alerta');
    if (alerta) {
      alerta.style.transition = 'opacity 1s ease';
      alerta.style.opacity = '0';
      setTimeout(() => alerta.remove(), 1000); // Elimina el div después de desvanecer
    }
  }, 5000);
</script>
</body>
</html>
