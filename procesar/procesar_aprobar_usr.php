<?php


// Cargar configuración
$config = require '../config/config.php';
// Acceder a la URL
$apiUrl = $config['webapi_url'];

// Verificar que se haya enviado el parámetro 'servicio' en la URL
if (!isset($_GET['servicio'])) {
    echo json_encode(['error' => 'No se especificó el servicio']);
    exit;
}

$servicio = $_GET['servicio'];
// Obtener datos JSON del cuerpo
$data = json_decode(file_get_contents("php://input"), true);




// Enrutador de servicios
switch ($servicio) {

    case 'listar_no_aprobados':
        listar_no_aprobados($apiUrl);
        break;
    case 'aprobar_usuarios':
        aprobar_usuarios($apiUrl);
        break;
    default:
        echo json_encode(['error' => 'Servicio no reconocido']);
        exit;
};



function listar_no_aprobados($apiUrl) {
    // URL de la API

    $url = $apiUrl ."/usuario.php?servicio=usuarios_no_aceptados";
    // $url = "http://lenovo-pc/api/usuario.php?servicio=usuarios_no_aceptados";

    // Inicializar cURL
    $ch = curl_init($url);

    // Configurar cURL para POST
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    // Si la API requiere datos en el cuerpo, podés agregarlos así:
    // curl_setopt($ch, CURLOPT_POSTFIELDS, ['clave' => 'valor']);

    // Ejecutar la solicitud
    $response = curl_exec($ch);

    // Verificar errores
    if (curl_errno($ch)) {
        echo "Error en la solicitud: " . curl_error($ch);
        curl_close($ch);
        exit;
    }

    curl_close($ch);

    header('Content-Type: application/json');
    echo $response;
    exit;

}

function aprobar_usuarios($apiUrl) {


    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['usuarios'])) {
        $ids = $_POST['usuarios']; // Array de IDs seleccionados


    $url = $apiUrl ."/usuario.php?servicio=aprobar_usuarios";
   // $url = "http://lenovo-pc/api/usuario.php?servicio=aprobar_usuarios";

    // Inicializar cURL
    $ch = curl_init($url);

    // Configurar cURL para POST
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($ids));

    // Si la API requiere datos en el cuerpo, podés agregarlos así:
    // curl_setopt($ch, CURLOPT_POSTFIELDS, ['clave' => 'valor']);

    // Ejecutar la solicitud
    $response = curl_exec($ch);

    // Verificar errores
    if (curl_errno($ch)) {
        echo "Error en la solicitud: " . curl_error($ch);
        curl_close($ch);
        exit;
    }

    curl_close($ch);
    //redirige a...
    header("Location: ../aprobar_usuarios.php");
    exit;

    }


}

?>

