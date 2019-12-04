<?php
    require_once('./conecta.php');  // Conecta a la Base de datos
    //Recibe Variables
    $id = $_POST['id'];
    $codigo = $_POST['codigo'];
    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];
    $costo = $_POST['costo'];
    $stock = $_POST['stock'];
    $bandF = $_POST['bandF'];

    if ($bandF == '') {                     // Banderas Nulas, no ha sido modificada la contraseña ni el archivo
        // Consulta MySql
        $sql = "UPDATE productos SET codigo='$codigo', nombre='$nombre',
        descripcion='$descripcion', costo='$costo', stock='$stock' WHERE id ='$id'";
        $res = mysqli_query($con,$sql); // Ejecuta la consulta en 'sql', con la conexion establecida
        echo 1;
    }
    else if ($bandF != '') {                // Bandera archivo, Ha sido modificado
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
        $sql = "UPDATE productos SET codigo='$codigo', nombre='$nombre',
        descripcion='$descripcion', archivo_n='$file_enc', archivo='$file_name',
        costo='$costo', stock='$stock' WHERE id ='$id'";
        $res = mysqli_query($con,$sql);     // Ejecuta la consulta en 'sql', con la conexion establecida
        echo 1;
    }
    else {
        echo 0;
    }
?>
