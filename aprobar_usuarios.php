<?php

// URL de la API
$url = "http://lenovo-pc/cooperativa/procesar/procesar_aprobar_usr.php?servicio=listar_no_aprobados";

// Inicializar cURL
$ch = curl_init($url);

// Configurar cURL para POST
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);


// Ejecutar la solicitud
$response = curl_exec($ch);

// Verificar errores
if (curl_errno($ch)) {
    echo "Error en la solicitud: " . curl_error($ch);
    curl_close($ch);
    exit;
}

curl_close($ch);

// Decodificar el JSON
$data = json_decode($response, true);

?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Aprobación de Usuarios</title>

</head>
<body>
 <?php include 'menu.php' ; ?>


<div class="container my-5">
  <h2 class="mb-4 text-center">👥 Lista de Usuarios</h2>

  <form method="POST" action="procesar/procesar_aprobar_usr.php?servicio=aprobar_usuarios">
    <div class="table-responsive">
      <table class="table table-bordered table-hover align-middle">
        <thead class="table-dark">
          <tr>
            <th>Id</th>
            <th>Nombre</th>
            <th>Apellido</th>
            <th>Cédula</th>
            <th>Email</th>
            <th>Cant. Familiares</th>
            <th>Ingresos</th>
            <th>Aceptar</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($data['result'] as $usuario): ?>
            <tr>
              <td><?= htmlspecialchars($usuario['id']) ?></td>
              <td><?= htmlspecialchars($usuario['nombre']) ?></td>
              <td><?= htmlspecialchars($usuario['apellido']) ?></td>
              <td><?= htmlspecialchars($usuario['cedula']) ?></td>
              <td><?= htmlspecialchars($usuario['mail']) ?></td>
              <td><?= htmlspecialchars($usuario['canti_familiares']) ?></td>
              <td>$<?= number_format($usuario['ingresos'], 2, ',', '.') ?></td>
              <td class="text-center">
                <input type="checkbox"
                       class="form-check-input"
                       name="usuarios[]"
                       value="<?= $usuario['id'] ?>">
              </td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>

    <!-- Botón para aceptar usuarios -->
    <div class="mt-3 text-end">
      <button type="submit" class="btn btn-success">
        <i class="bi bi-check-circle"></i> Aceptar usuarios seleccionados
      </button>
    </div>
  </form>


</div>

<script>
  // Captura el cambio de estado del checkbox
  document.querySelectorAll('input[type="checkbox"]').forEach(checkbox => {
    checkbox.addEventListener('change', function () {
      const id = this.getAttribute('data-id');
      const estado = this.checked;

      console.log(`Usuario ID ${id} → aceptado: ${estado}`);

      // Aquí podrías hacer un fetch/AJAX para actualizar en el backend
      // Ejemplo:
      /*
      fetch('actualizar_estado.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ id: id, aceptado: estado })
      })
      .then(res => res.json())
      .then(data => console.log(data));
      */
    });
  });
</script>

</body>
</html>
