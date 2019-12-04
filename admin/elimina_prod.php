<?php
require_once('conecta.php');       // Establece la conexion a la BD
// $sql = "DELETE FROM administradores WHERE id=$id";
$id = $_REQUEST["id"];
$sql = "UPDATE productos SET eliminado = 1 WHERE id=$id";
$del  = mysqli_query($con,$sql);

echo $del;
?>
