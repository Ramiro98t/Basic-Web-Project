<?php
require("conecta.php");
// $sql = "DELETE FROM administradores WHERE id=$id";
$id = $_POST["id"];
$sql = "UPDATE clientes SET eliminado = 1 WHERE id=$id";
$del  = mysqli_query($con,$sql);

echo $del;

?>
