<?php
session_start(); // Inicia o reanuda una sesión existente

// Cargar configuración
$config = require '../config/config.php';
// Acceder a la URL
$apiUrl = $config['webapi_url'];

try {
    // Verifica si los datos fueron enviados por POST y los guarda en la sesión
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $_SESSION['nombre']   = isset($_POST['nombre'])   ? htmlspecialchars($_POST['nombre'])   : '';
        $_SESSION['email']    = isset($_POST['email'])    ? htmlspecialchars($_POST['email'])    : '';
        $_SESSION['cedula']   = isset($_POST['ci'])       ? htmlspecialchars($_POST['ci'])       : '';
        $_SESSION['password'] = isset($_POST['password']) ? htmlspecialchars($_POST['password']) : '';
        $_SESSION['apellido'] = isset($_POST['apellido']) ? htmlspecialchars($_POST['apellido']) : '';
        $_SESSION['ingresos'] = isset($_POST['ingreso'])  ? htmlspecialchars($_POST['ingreso'])  : '';
        $_SESSION['familia']  = isset($_POST['cant-nf'])  ? htmlspecialchars($_POST['cant-nf'])  : '';

        // Datos a enviar
        $data = [
            'nombre'   => $_SESSION['nombre'],
            'cedula'   => $_SESSION['cedula'],
            'email'    => $_SESSION['email'],
            'password' => $_SESSION['password'],
            'apellido' => $_SESSION['apellido'],
            'ingresos' => $_SESSION['ingresos'],
            'familia'  => $_SESSION['familia']
        ];

        // Inicializar cURL
        $ch = curl_init($apiUrl . '/usuario.php?servicio=registrar_usuario');
        //$ch = curl_init('http://localhost/api/usuario.php?servicio=registrar_usuario');

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
            header("Location: ../index.php?result=regis_ok");
        } else {
            $message = "";
            if (isset($resultado['message'])) {
                $message = $resultado['message'];
            }
            header("Location: ../registro.php?result=error&message=" . $message);
        }
        exit;
    }
} catch (PDOException $e) {
    header("Location: ../registro.php?mensaje=error");
    exit;
}
?>
