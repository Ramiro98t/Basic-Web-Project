<?php
    require_once('./conecta.php');  // Conecta a la Base de datos
    //Recibe Variables
    $id = $_POST['id'];
    $nombre = $_POST['nombres'];
    $apellidos = $_POST['apellidos'];
    $correo = $_POST['correo'];
    $rol = $_POST['rol'];
    $contra = $_POST['pw'];
    $bandF = $_POST['bandF'];
    $bandC = $_POST['bandC'];


    if ($bandC == '' && $bandF == '') {     // Banderas Nulas, no ha sido modificada la contraseña ni el archivo
        // Consulta MySql
        $sql = "UPDATE administradores SET nombre='$nombre', apellidos='$apellidos',
                correo='$correo', rol='$rol' WHERE id ='$id'";
        $res = mysqli_query($con,$sql); // Ejecuta la consulta en 'sql', con la conexion establecida
        echo 1;
    }
    else if ($bandC != '') {                // Bandera contraseña, Ha sido modificada
        $pass_enc = md5($contra);           // Encripta contraseña
        // Consulta MySql
        $sql = "UPDATE administradores SET nombre='$nombre', apellidos='$apellidos',
        pass='$pass_enc' , correo='$correo', rol='$rol' WHERE id ='$id'";
        $res = mysqli_query($con,$sql);     // Ejecuta la consulta almacenada en 'sql', con la conexion establecida
        echo 1;
    }
    else if ($bandF != '') {                 // Bandera archivo, Ha sido modificado
        // Imagen - Archivo del formulario
        $file_name = $_FILES['archivo']['name'];    // Nombre real del Archivo
        $file_tmp  = $_FILES['archivo']['tmp_name'];// Nombre temporal del archivo
        $cadena = explode(".",$file_name);          // Separa el nombre para obtener la extension, almacena en un arreglo
        $ext = $cadena[1];                          // Extension extraida del arreglo en la variable $cadena
        $dir = "../archivos/";                         // Carpeta donde se guardan los archivos
        $file_enc = md5_file($file_tmp);            // Nombre del archivo encriptado

        if ($file_name != '') {                     // Verifica que exista el archivo
            $file_name1 = "$file_enc.$ext";         // Asigna un nuevo nombre a una variable, con la extension y el nombre encriptado
            @copy($file_tmp, $dir.$file_name1);     // Copia el archivo temporal a la carpeta asignada en la varibale $dir
        }

        // Consulta MySql
        $sql = "UPDATE administradores SET nombre='$nombre', apellidos='$apellidos',
        archivo_n='$file_enc', archivo='$file_name', correo='$correo', rol='$rol' WHERE id ='$id'";
        $res = mysqli_query($con,$sql); // Ejecuta la consulta en 'sql', con la conexion establecida
        echo 1;
    }
    else {
        echo 0;
    }
?>
