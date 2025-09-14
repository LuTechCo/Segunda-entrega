<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/styles.css">
    <link rel="icon" type="image/png" href="imagenes/Untitled.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.0/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Kreon:wght@300..700&display=swap" rel="stylesheet">
    <title>Logueo</title>
</head>
<body>
  <?php include 'menu.php' ; ?>
<main class="container my-5">

  <section>
    <div class="card shadow-sm p-4 mx-auto" style="max-width: 400px;">
      <form action="procesar/procesar_login.php" method="post">

        <!-- Campo correo -->
        <div class="mb-3">
          <label id="correo" for="email" class="form-label"></label>
          <input type="email" id="email" name="email" class="form-control" placeholder="Correo@gmail.com" required />
        </div>

        <!-- Campo contraseña -->
        <div class="mb-3">
          <label id="contraseña" for="password" class="form-label"></label>
          <input type="password" id="password" name="password" class="form-control" placeholder="Contraseña" required />
        </div>

        <!-- Botón login -->
        <div class="d-grid mb-2">
          <button type="submit" class="btn btn-primary">Log in</button>
        </div>

        <!-- Botón login con Google -->
        <div class="d-grid mb-3">
          <a id="boton-google" href="https://accounts.google.com/v3/signin/identifier?continue=https%3A%2F%2Faccounts.google.com%2F&followup=https%3A%2F%2Faccounts.google.com%2F&ifkv=AdBytiM5SajsLxsPORCVNoHMvyA5UFnbIg0UBZ59vj_svhZnp7e-FBGm7eJUA0F35h1uk8yDvPSIUQ&passive=1209600&flowName=GlifWebSignIn&flowEntry=ServiceLogin&dsh=S-1222146421%3A1752188516350311" class="btn btn-outline-danger">
            <i class="bi bi-google"></i> Iniciar sesión con Google
          </a>
        </div>

        <!-- Link registrarme -->
        <div class="text-center">
          <a href="registro.php" class="btn btn-link">Registrarme</a>
        </div>

      </form>

          <?php
            if (isset($_GET['result'])) {
                if ($_GET['result'] === 'login_ok') {
                    echo "<div id='mensaje-alerta' class='alert alert-success'>Registro realizado con éxito.</div>";
                } elseif ($_GET['result'] === 'error') {
                    echo "<div id='mensaje-alerta' class='alert alert-danger'>" . $_GET['message'] . "</div>";
                }
            }
            ?>
    </div>
  </section>
</main>

    <footer>

    </footer>


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
