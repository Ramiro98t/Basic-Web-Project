<?php
    require_once('./conecta.php');  //Conecta a la Base de datos

    $correo = $_POST['correo']; // Obtiene el correo a buscar

    $sql = "SELECT * FROM clientes WHERE correo ='$correo' AND eliminado = '0'";    // Consulta MySql
    $res = mysqli_query($con,$sql); // Ejecuta la consulta en 'sql', con la conexion establecida
    $fila = mysqli_num_rows($res);  // Obtiene el numero de filas

    if($fila==0) {
        echo 0; // Si la consulta no genera ningun resultado
    }
    else {
        echo 1; // Si la consulta si genera ningun resultado
    }

?>
