<?php
    session_start();
    require("conecta.php");    // Conecta a la Base de datos
    $sql = "SELECT nombre, apellidos FROM clientes";    // Consulta Sql
    $res = mysqli_query($con,$sql);    // Hace consulta con la conexion establecida
    $fila = mysqli_num_rows($res);      // Obtiene el numero de filas
    $random = "false";
    for ($i=0; $f = $res->fetch_object(); $i++) {
        $user = $f->nombre." ".$f->apellidos;
        if ($user == $_SESSION['user']) {
            $random = "false";
            break;
        }
        else {
            
        }
        echo $user." es: ".$random."<br>";
    }
    echo "<br>";
    echo $random;
    echo "<br>";

    if ($random == "true") {
        echo "<a href='login.php'>¿Ya estás registrado?</a>";
    }

    if ($random == "false") {
        echo "<a class='logout' href=''>Log Out</a>                               <!-- Boton para cerrar sesion actual -->";
    }


?>
