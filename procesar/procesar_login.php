<?php
session_start(); // Inicia o reanuda una sesión existente

// Cargar configuración
$config = require '../config/config.php';
// Acceder a la URL
$apiUrl = $config['webapi_url'];

try {
    // Verifica si los datos fueron enviados por POST y los guarda en la sesión
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $_SESSION['email']    = isset($_POST['email'])    ? htmlspecialchars($_POST['email'])    : '';
        $_SESSION['password'] = isset($_POST['password']) ? htmlspecialchars($_POST['password']) : '';


        // Datos a enviar
        $data = [
            'email'    => $_SESSION['email'],
            'password' => $_SESSION['password']
        ];

        // Inicializar cURL
        $ch = curl_init($apiUrl . '/usuario.php?servicio=login');
        //$ch = curl_init('http://localhost/api/usuario.php?servicio=login');

        // Configurar opciones
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));

        // Ejecutar y obtener respuesta
        $response = curl_exec($ch);
        curl_close($ch);

        // Decodificar respuesta
        $resultado = json_decode($response, true);

        // Redirigir según resultado
        if (isset($resultado['success']) && $resultado['success'] === true) {

            // Asigna un nombre a la variable de sesión
            $usuario = new stdClass();
            $usuario->id        = $resultado['id'];
            $usuario->ci        = $resultado['ci'];
            $usuario->nombre    = $resultado['nombre'];
            $usuario->apellido  = $resultado['apellido'];
            $usuario->mail      = $resultado['mail'];
            $usuario->ingresos  = $resultado['ingresos'];
            $usuario->familia   = $resultado['familia'];
            $usuario->aceptado  = $resultado['aceptado'];
            $usuario->es_admin  = $resultado['es_admin'];

            // Guardar en sesión
            $_SESSION['usuario'] = $usuario;
            $_SESSION['usr_islogued'] = 1;

            header("Location: ../index.php?result=login_ok");
        } else {
            $message = "";
            $_SESSION['usuario'] = null;
            $_SESSION['usr_islogued'] = "false";
            if (isset($resultado['message'])) {
                $message = $resultado['message'];
            }
            header("Location: ../logueo.php?result=error&message=" . $message);
        }
        exit;
    }
} catch (PDOException $e) {
    header("Location: ../registro.php?mensaje=error");
    exit;
}
?>
