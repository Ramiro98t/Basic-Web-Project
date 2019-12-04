<?php
    require_once('./conecta.php');  //Conecta a la Base de datos

    $correo = $_POST['correo']; // Obtiene el correo a buscar

    $sql = "SELECT * FROM administradores WHERE correo ='".$correo."' AND eliminado = '0'";    // Consulta MySql
    $res = mysqli_query($con,$sql); // Ejecuta la consulta en 'sql', con la conexion establecida
    $fila = mysqli_num_rows($res);  // Obtiene el numero de filas

    if($fila==0) {
        echo 0; // Si fila no genera ningun resultado
    }
    else {
        echo 1; // Si la contraseña no es la misma que el correo
    }

?>
