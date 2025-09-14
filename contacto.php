<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
          <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/styles.css">
    <link rel="icon" type="image/png" href="imagenes/Untitled.png">

    <title>Contacto</title>
</head>
<body>
           <?php
    // Inicia la sesión si no está iniciada
    session_start();
?>
  <?php include 'menu.php' ; ?>

<main class="container my-5">
  <section>
    <div class="card shadow-sm p-4">
      <h2 class="mb-3">Contáctanos</h2>
      <p class="mb-4">Llena el formulario para ponerte en contacto</p>

      <form>
        <div class="mb-3">
          <label for="nombre" class="form-label">Nombre</label>
          <input type="text" id="nombre" name="nombre" class="form-control" required>
        </div>

        <div class="mb-3">
          <label for="email" class="form-label">Email</label>
          <input type="email" id="email" name="email" class="form-control" required>
        </div>

        <div class="mb-3">
          <label for="mensaje" class="form-label">Mensaje</label>
          <textarea name="mensaje" id="mensaje" rows="5" class="form-control" required></textarea>
        </div>

        <button type="submit" class="btn btn-success w-100">Enviar mensaje</button>
      </form>
    </div>
  </section>
</main>

</body>
</html>
