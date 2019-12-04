<?php
// Establece la coneccion con el servidor
// Direccion, usuario, contraseña, Base de datos
$con = mysqli_connect("localhost", "root", "", "cliente01");
//Recibe Variables
$nombre = $_REQUEST['nombres'];
$apellidos = $_REQUEST['apellidos'];
$correo = $_REQUEST['correo'];
$pass = $_REQUEST['pw'];
$rol = $_REQUEST['rol'];
// Recibe y procesa archivo
// Imagen - Archivo del formulario
$file_name = $_FILES['archivo']['name'];    // Nombre real del Archivo
$file_tmp  = $_FILES['archivo']['tmp_name'];// Nombre temporal del archivo
$cadena = explode(".",$file_name);          // Separa el nombre para obtener la extension, almacena en un arreglo
$ext = $cadena[1];                          // Extension extraida del arreglo en la variable $cadena
$dir = "../archivos/";                         // Carpeta donde se guardan los archivos
$file_enc = md5_file($file_tmp);            // Nombre del archivo encriptado
$pass_enc = md5($pass);

if ($file_name != '') {                     // Verifica que exista el archivo
    $file_name1 = "$file_enc.$ext";         // Asigna un nuevo nombre a una variable, con la extension y el nombre encriptado
    @copy($file_tmp, $dir.$file_name1);     // Copia el archivo temporal a la carpeta asignada en la varibale $dir
}
//Inserta en BD
$sql = "INSERT INTO administradores VALUES
        (0,'$nombre','$apellidos','$correo','$pass_enc',
        $rol,'$file_enc','$file_name',1,0)";
$res = mysqli_query($con,$sql);

header("Location: listados.php");

?>
