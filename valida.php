<?php
    session_start();
    require("conecta.php");    // Establece la coneccion con la BD

    $correo = $_POST['email'];     // Obtiene el correo a buscar
    $contra = $_POST['password'];  // Obtiene la contraseña a verificar
    $contra_enc = md5($contra);    // Encripta contraseña

    $sql = "SELECT * FROM clientes WHERE correo ='$correo' AND pass ='$contra_enc' AND eliminado = '0'";    // Consulta MySql
    $res = mysqli_query($con,$sql); // Ejecuta la consulta en 'sql', con la conexion establecida
    $fila = mysqli_num_rows($res);  // Obtiene el numero de filas

    if($fila==0) {
        echo 0; // Si la consulta no genera ningun resultado
    }

    else {
        $row = mysqli_fetch_assoc($res);
        $nomU = $row['nombre'].' '.$row['apellidos'];
        $_SESSION['user'] = $nomU;
        echo 1; // Si la consulta si genera ningun resultado
    }
?>
