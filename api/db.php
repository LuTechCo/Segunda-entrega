<?php

 // Cargar configuración
$config = require './config/config.php';
// Acceder a CONFIGURACION
$host = $config['host_servicios'];
$dbname = $config['dbname'];
$user = $config['user_db'];
$pass = $config['pass_db']; 


try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo json_encode(['error' => 'Error de conexión: ' . $e->getMessage()]);
    exit;
}

?>