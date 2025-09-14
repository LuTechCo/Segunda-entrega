<?php
header("Content-Type: application/json");
require 'db.php';

// Solo aceptar POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['error' => 'Método no permitido']);
    exit;
}

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
    case 'registrar_usuario':
        registrar_usuario($pdo, $data);
        break;

        
    case 'login':
        login($pdo, $data);
        break;

    case 'aceptar_usuario':
        aceptar_usuario($pdo, $data);
        break;
    case 'aprobar_usuarios':
        aprobar_usuarios($pdo, $data);        
    case 'usuarios_no_aceptados':
        get_usuarios_no_aceptados($pdo);
        break;
    default:
        echo json_encode(['error' => 'Servicio no reconocido']);
        exit;
}



// Función login de usuario
function login($pdo, $data) {
    $campos = ['password', 'email'];
    foreach ($campos as $campo) {
        if (!isset($data[$campo])) {
            echo json_encode(['error' => "Falta el campo: $campo"]);
            exit;
        }
    }

    $email = trim($data['email']);
    $password = trim($data['password']);

    try {
        $verificar = $pdo->prepare("SELECT id, nombre, ci, apellido, mail, password, ingresos, familia, aceptado, es_admin FROM usuarios WHERE mail = ? && password = ?");
        $verificar->execute([$email, $password]);
        $usuario = $verificar->fetch(PDO::FETCH_ASSOC);

        if ($usuario) {
            // Aquí podrías validar la contraseña si está hasheada
            echo json_encode([
                'success' => true,
                'id' => $usuario['id'],
                'ci' => $usuario['ci'],
                'nombre' => $usuario['nombre'],
                'apellido' => $usuario['apellido'],
                'mail' => $usuario['mail'],
                'ingresos' => $usuario['ingresos'],
                'familia' => $usuario['familia'],
                'aceptado' => $usuario['aceptado'],
                'es_admin' => $usuario['es_admin'],
                'message'=> null
            ]);
        } else {
            echo json_encode([
                'success' => false,
                'message' => 'Su usuario o clave es incorrecto'
            ]);
        }
        exit;

    } catch (PDOException $e) {
        echo json_encode(['error' => 'Error al consultar: ' . $e->getMessage()]);
        exit;
    }
}

function registrar_usuario($pdo, $data) {
    $campos = ['nombre', 'cedula', 'apellido', 'password', 'email', 'familia', 'ingresos'];
    foreach ($campos as $campo) {
        if (!isset($data[$campo])) {
            echo json_encode(['error' => "Falta el campo: $campo"]);
            exit;
        }
    }

    $nombre = trim($data['nombre']);
    $cedula = trim($data['cedula']);
    $apellido = trim($data['apellido']);
    $email = trim($data['email']);
    $password = trim($data['password']);
    $ingresos = trim($data['ingresos']);
    $familia = trim($data['familia']);
    $aceptado = 0;

    try {
        $verificar = $pdo->prepare("SELECT id FROM usuarios WHERE mail = ?");
        $verificar->execute([$email]);

        if ($verificar->rowCount() > 0) {
            echo json_encode([
                'success' => false,
                'message' => 'El correo ya está registrado.'
            ]);
            exit;
        }

        $stmt = $pdo->prepare("INSERT INTO usuarios (nombre, ci, apellido, mail, password, ingresos, familia, aceptado) VALUES (?,?,?,?,?,?,?,?)");
        $stmt->execute([$nombre, $cedula, $apellido, $email, $password, $ingresos, $familia, $aceptado]);

        echo json_encode([
            'success' => true,
            'usuario_id' => $pdo->lastInsertId(),
            'nombre' => $nombre,
            'cedula' => $cedula
        ]);
    } catch (PDOException $e) {
        echo json_encode(['error' => 'Error al registrar: ' . $e->getMessage()]);
        exit;
    }
}

// Función para aceptar usuario
function aceptar_usuario($pdo, $data) {
    if (!isset($data['usuario_id'])) {
        echo json_encode(['error' => 'Falta el ID del usuario']);
        exit;
    }

    $usuario_id = intval($data['usuario_id']);

    try {
        $stmt = $pdo->prepare("UPDATE usuarios SET aceptado = 1 WHERE id = ?");
        $stmt->execute([$usuario_id]);

        if ($stmt->rowCount() > 0) {
            echo json_encode(['success' => true, 'message' => 'Usuario aceptado']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Usuario no encontrado o ya aceptado']);
        }
    } catch (PDOException $e) {
        echo json_encode(['error' => 'Error al aceptar usuario: ' . $e->getMessage()]);
        exit;
    }
}

function get_usuarios_no_aceptados($pdo) {
    try {
        $stmt = $pdo->prepare("
            SELECT 
                id, 
                nombre, 
                apellido, 
                ci AS cedula, 
                mail, 
                familia AS canti_familiares, 
                ingresos 
            FROM usuarios 
            WHERE aceptado = 0
        ");
        $stmt->execute();
        $usuarios = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Retornar como JSON con clave "result"
        header('Content-Type: application/json');
        echo json_encode(['result' => $usuarios]);
        exit;

    } catch (PDOException $e) {
        header('Content-Type: application/json');
        echo json_encode([
            'error' => 'Error al consultar: ' . $e->getMessage()
        ]);
        exit;
    }
}

function aprobar_usuarios($pdo, $data) {
    // Validar que $data sea un array no vacío
    if (!is_array($data) || empty($data)) {
        echo json_encode(['error' => 'No se recibieron IDs válidos']);
        exit;
    }

    // Sanitizar los IDs (convertir a enteros)
    $ids = array_map('intval', $data);

    // Construir placeholders dinámicos (?, ?, ?, ...)
    $placeholders = implode(',', array_fill(0, count($ids), '?'));

    try {
        // Preparar la consulta con IN (...)
        $sql = "UPDATE usuarios SET aceptado = 1 WHERE id IN ($placeholders)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute($ids);

        echo json_encode([
            'success' => true,
            'actualizados' => $ids,
            'cantidad' => $stmt->rowCount()
        ]);
    } catch (PDOException $e) {
        echo json_encode(['error' => 'Error al actualizar: ' . $e->getMessage()]);
        exit;
    }
}