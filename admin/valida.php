<?php
    session_start();
    require_once("./conecta.php");  // Conecta a la Base de datos

    $correo = $_POST['email']; // Obtiene el correo a buscar
    $contra = $_POST['password']; // Obtiene la contraseña a verificar

    $contra_enc = md5($contra);

    $sql = "SELECT * FROM administradores WHERE correo ='$correo' AND pass ='$contra_enc' AND eliminado = '0'";    // Consulta MySql
    $res = mysqli_query($con,$sql); // Ejecuta la consulta en 'sql', con la conexion establecida
    $fila = mysqli_num_rows($res);  // Obtiene el numero de filas

    if($fila==0) {
        echo 0; // Si fila no genera ningun resultado
    }

    else {
        $row = mysqli_fetch_assoc($res);
        $idU = $row['id'];
        $nomU = $row['nombre'].' '.$row['apellidos'];
        $_SESSION['idU'] = $idU;
        $_SESSION['nomU'] = $nomU;
        echo 1; // Si la contraseña es la misma que el correo
    }
?>
