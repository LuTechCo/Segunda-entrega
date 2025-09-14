<?php
session_start(); // Inicia o reanuda una sesión existente

try {
        // Cambia las variables de sesión del usuario
        $_SESSION['usuario'] = null;
        $_SESSION['usr_islogued'] = 0;

        //Redirige al index con un mensaje al usuario.
        header("Location: ../index.php?result=logout_ok");
        exit;
}
 catch (PDOException $e) {
    header("Location: ../index.php?result=error&message='Un error ha ocurrido'");
    exit;
}
?>
