<?php
    session_start();           // Metodos para la Sesion
    require("conecta.php");    // Establece la coneccion con la BD
    //Recibe Variables
    $nombre = $_POST['name'];
    $apellidos = $_POST['lastname'];
    $correo = $_POST['emailR'];
    $pass = $_POST['passwordR'];
    $pass_enc = md5($pass);    // Encripta contraseña
    //Inserta en BD
    $sql = "INSERT INTO clientes VALUES
            (0,'$nombre','$apellidos','$correo','$pass_enc',1,0)";
    $res = mysqli_query($con,$sql);

    $row = mysqli_fetch_assoc($res);
    $nomU = $nombre." ".$apellidos;
    $_SESSION['user'] = $nomU;

    header("Location: tienda.php");
?>
