<?php
    require_once('./conecta.php');  //Conecta a la Base de datos

    $codigo = $_POST['codigo']; // Obtiene el correo a buscar

    $sql = "SELECT * FROM productos WHERE codigo ='$codigo' AND eliminado = 0";    // Consulta MySql
    $res = mysqli_query($con,$sql); // Ejecuta la consulta en 'sql', con la conexion establecida
    $fila = mysqli_num_rows($res);  // Obtiene el numero de filas

    if($fila==0) {
        echo 0; // Si fila no genera ningun resultado
    }
    else {
        echo 1; // Si el codigo ya existe en la Base de Datos
    }

?>
