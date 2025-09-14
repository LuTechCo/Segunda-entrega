<!doctype html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Editar Perfil de Usuario</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
      .profile-img {
        width: 150px;
        height: 150px;
        object-fit: cover;
        border: 4px solid #fff;
        box-shadow: 0 0 10px rgba(0,0,0,0.1);
      }
      .card {
        border-radius: 15px;
      }
    </style>
  </head>
  <body style="background-color: #f0f2f5;">
        <?php include 'menu.php' ; ?>

    <div class="container mt-5 p-4" style="background-color: #b8d0da;">

      <div class="row justify-content-center">
        <div class="col-md-10 col-lg-8">
          <div class="card p-4">
            <form action="procesar_perfil.php" method="POST" enctype="multipart/form-data">
              <div class="row align-items-center">
                <div class="col-md-4 text-center mb-3 mb-md-0">
                  <img src="https://via.placeholder.com/150" class="rounded-circle profile-img" alt="Foto de perfil">
                  <div class="mt-2">
                    <label for="profile_picture" class="btn btn-primary btn-sm">Cambiar Foto</label>
                    <input type="file" class="form-control-file d-none" id="profile_picture" name="profile_picture">
                  </div>
                </div>

                <div class="col-md-8">
                  <div class="mb-3">
                    <label for="nombre" class="form-label text-muted">Nombre:</label>
                    <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Ingresa tu nombre">
                  </div>

                  <div class="mb-3">
                    <label for="descripcion" class="form-label text-muted">Descripción:</label>
                    <textarea class="form-control" id="descripcion" name="descripcion" rows="3" placeholder="Ingresa tu descripción"></textarea>
                  </div>

                  <hr class="my-3">

                  <div class="row">
                    <div class="col-6 mb-3">
                      <label for="edad" class="form-label text-muted">Edad:</label>
                        <input type="number" onkeypress="return soloNumeros(event)" id="edad" name="edad" class="form-control" placeholder="Edad" requied />
                    </div>
                    <div class="col-6 mb-3">
                      <label for="genero" class="form-label text-muted">Género:</label>
                      <div class="mb-3">

                        <select class="form-select" id="generoSelect" name="genero">
                            <option selected disabled>Selecciona una opción</option>
                            <option value="mujer">Mujer</option>
                            <option value="hombre">Hombre</option>
                            <option value="no-binario">No binario</option>
                            <option value="otro">Otro</option>
                        </select>
</div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="mt-4 text-center">
                <button type="submit" class="btn btn-success">Guardar Cambios</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
      // Script para mostrar la vista previa de la imagen seleccionada
      const input = document.getElementById('profile_picture');
      const img = document.querySelector('.profile-img');
      input.addEventListener('change', (e) => {
        if (e.target.files.length > 0) {
          const src = URL.createObjectURL(e.target.files[0]);
          img.src = src;
        }
      });
    </script>
  </body>
</html>
