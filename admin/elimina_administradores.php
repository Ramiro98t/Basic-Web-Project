<?php
$con = mysqli_connect("localhost", "root", "", "cliente01");
// $sql = "DELETE FROM administradores WHERE id=$id";
$id = $_REQUEST["id"];
$sql = "UPDATE administradores SET eliminado = '1' WHERE id=$id";
$del  = mysqli_query($con,$sql);

echo $del;

?>
