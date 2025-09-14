<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>MiApp - Menú Principal</title>
</head>
<body>

  <?php include 'menu.php' ; ?>

  <!-- Contenido principal -->

  <div class="container mt-4">
    <h1>¡Bienvenidos a nuestra Cooperativa!</h1>
    <h3>Construyendo juntos un futuro más justo, solidario y participativo.</h3>
  </div>

<div class="carruselfoto">
   <!doctype html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Carrusel de Imágenes con Estilos Externos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

  </head>
  <body>

  <div class="container mt-5">
    <div class="row align-items-center">
      <!-- Imagen a la izquierda -->
      <div class="col-md-6 text-start">
        <img id="imganefondo" src="imagenes/indexfoto.png" alt="imagenhome" class="imagenlogueo" />
      </div>

      <!-- Carrusel a la derecha -->
      <div class="col-md-6">
        <div id="carouselExampleAutoplaying" class="carousel slide" data-bs-ride="carousel">
          <div class="carousel-indicators">
            <button type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide-to="1" aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide-to="2" aria-label="Slide 3"></button>
          </div>
          <div class="carousel-inner">
            <div class="carousel-item active">
              <img src="imagenes/cooperativafoto1.jpg" class="d-block w-100" alt="Imagen 1">
            </div>
            <div class="carousel-item">
              <img src="imagenes/cooperativafoto1.jpg" class="d-block w-100" alt="Imagen 2">
            </div>
            <div class="carousel-item">
              <img src="imagenes/cooperativafoto1.jpg" class="d-block w-100" alt="Imagen 3">
            </div>
          </div>
          <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Anterior</span>
          </button>
          <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Siguiente</span>
          </button>
        </div>
      </div>
    </div>
  </div>

  </body>
</html>
</div>

    <?php
    if (isset($_GET['result'])) {
        if ($_GET['result'] === 'regis_ok') {
            echo "<div id='mensaje-alerta' class='alert alert-success'>Registro realizado con éxito, su aprobación esta pendiente.</div>";
        } elseif ($_GET['result'] === 'login_ok') {
            echo "<div id='mensaje-alerta' class='alert alert-success'>Login realizado con éxito.</div>";
        } elseif ($_GET['result'] === 'logout_ok') {
            echo "<div id='mensaje-alerta' class='alert alert-success'>Su sesión fue cerrada.</div>";
        } elseif ($_GET['result'] === 'error') {
            echo "<div id='mensaje-alerta' class='alert alert-danger'>" . $_GET['message'] . "</div>";
        }
    }
    ?>



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
