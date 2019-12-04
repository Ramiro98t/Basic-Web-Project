<?php
    require_once('./conecta.php');  // Conecta a la Base de datos
    //Recibe Variables
    $id = $_POST['id'];
    $nombre = $_POST['nombre'];
    $apellidos = $_POST['apellidos'];
    $correo = $_POST['correo'];
    $contra = $_POST['pw'];
    $bandC = $_POST['bandC'];

    if ($bandC == '') {     // Bandera Nula, no ha sido modificada la contraseña
        // Consulta MySql
        $sql = "UPDATE clientes SET nombre='$nombre', apellidos='$apellidos',
                correo='$correo' WHERE id ='$id'";
        $res = mysqli_query($con,$sql); // Ejecuta la consulta en 'sql', con la conexion establecida
        echo 1;
    }
    else if ($bandC != '') {                // Bandera contraseña, Ha sido modificada
        $pass_enc = md5($contra);           // Encripta contraseña
        // Consulta MySql
        $sql = "UPDATE clientes  SET nombre='$nombre', apellidos='$apellidos',
        correo='$correo', pass='$pass_enc' WHERE id ='$id'";
        $res = mysqli_query($con,$sql);     // Ejecuta la consulta almacenada en 'sql', con la conexion establecida
        echo 1;
    }
    else {
        echo 0;
    }
?>
