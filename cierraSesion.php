<?php
    session_start();                // Gestor de sesiones
    session_destroy();              // Destruye toda la información asociada con la sesión actual.
    header("Location: index.php");  // Redirecciona a pagina principal
?>
