<?php
    require("conecta.php");
    session_start();
    $user = $_SESSION['user'];
    // Hace consulta de los pedidos pendientes, status = 0 del usuario en linea
    $sql = "UPDATE pedidos SET status = 1 WHERE usuario='$user' AND status='0'";
    $res = mysqli_query($con,$sql);    // Hace consulta con la conexion establecida

    if ($res) {
        echo 1;
    }
    else {
        echo 0;
    }
?>
