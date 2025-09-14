<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="icon" type="image/png" href="imagenes/favicon.png">
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

  <link rel="stylesheet" href="css/styles.css">
</head>
<body>

      <?php
      session_start(); // Obligatorio

      // Verifica si hay sesión
      if (empty($_SESSION['usr_islogued'])) {
          $_SESSION['usr_islogued'] = 0;
      }

      $usr_isLogued = $_SESSION['usr_islogued'];
      $objUsuario = null;
      $usr_isAdmin = false;
      $usr_aceptado = false;

      if (!empty($_SESSION['usuario'])) {
          $objUsuario = $_SESSION['usuario'];
          $usr_isAdmin = isset($objUsuario->es_admin) ? $objUsuario->es_admin : false;
          $usr_aceptado = isset($objUsuario->aceptado) ? $objUsuario->aceptado : false;
      }

      // Mostrar resultados
      echo "Variables de sesión" . "<br>";
      echo "Esta logueado: " . $usr_isLogued . "<br>";
      echo "Existe usuario: " . ($objUsuario ? 'Sí' : 'No') . "<br>";
      echo "Es Admin: " . ($usr_isAdmin ? 'Sí' : 'No') . "<br>";
      echo "Aceptado: " . ($usr_aceptado ? 'Sí' : 'No') . "<br>";
      ?>


  <!-- Menú de navegación -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <div class="container-fluid">
      <a class="navbar-brand" href="./index.php">
        <img src="imagenes/favicon.png" alt="Logo" style="height: 32px;">
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#menuPrincipal" aria-controls="menuPrincipal" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="menuPrincipal">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">

          <li class="nav-item">
            <a class="nav-link" href="index.php">Home</a>
          </li>

          <?php if (!$usr_isAdmin): ?>
              <li class="nav-item">
                      <a class="nav-link" href="contacto.php">Contacto</a>
              </li>
          <?php endif; ?>

          <?php if (!$usr_isAdmin): ?>
              <li class="nav-item">
                  <a class="nav-link" href="quienes_somos.php">Quienes Somos</a>
              </li>
          <?php endif; ?>

          <!-- Submenú Operar -->
          <?php if (!$usr_isAdmin && $usr_isLogued == 1): ?>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="operarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                Operar
              </a>
              <ul class="dropdown-menu" aria-labelledby="operarDropdown">
                <li><a class="dropdown-item" href="#">Enviar comprobante de pago</a></li>
                <li><a class="dropdown-item" href="#">Actualizar horas trabajadas</a></li>
              </ul>
            </li>
          <?php endif; ?>

          <!-- Submenú Administrar -->
          <?php if ($usr_isAdmin && $usr_isLogued == 1): ?>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="adminDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              Administrar
            </a>
            <ul class="dropdown-menu" aria-labelledby="adminDropdown">
              <li><a class="dropdown-item" href="aprobar_usuarios.php">Aprobar solicitudes pendientes</a></li>
              <li><a class="dropdown-item" href="#">Administrar Usuarios</a></li>
            </ul>
          </li>
          <?php endif; ?>

        </ul>

        <!-- Botones anclados a la derecha -->
        <div class="d-flex ms-auto align-items-center">


            <?php if ($usr_isLogued == 0): ?>
            <a  href="logueo.php" class="btn btn-outline-light me-2">
              <i class="bi bi-box-arrow-in-right"></i> Iniciar sesión
            </a>
            <?php endif; ?>

            <?php if ($usr_isLogued == 1): ?>
              <!-- Icono de perfil -->
              <a href="perfilusu.php" class="btn btn-outline-light me-2" title="Editar perfil de usuario">
                <i class="bi bi-person-circle"></i>
              </a>

              <a href="procesar/procesar_logout.php" class="btn btn-light">
                <i class="bi bi-box-arrow-right"></i> Cerrar sesión
              </a>
            <?php endif; ?>

          </div>
        </div>
      </div>
    </div>
  </nav>

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
