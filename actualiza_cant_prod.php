<?php
    require_once('./conecta.php');  // Conecta a la Base de datos
    // Recibe Variables
    $id_producto = $_POST['producto'];
    $cantidad = $_POST['cantidad'];
    $sql = "UPDATE pedidos_productos SET cantidad = '$cantidad'
    WHERE id_producto='$id_producto'";
    $res = mysqli_query($con,$sql);

    if ($id_producto == 0) {
        $sql = "UPDATE pedidos_productos SET cantidad = '$cantidad'";
        $res = mysqli_query($con,$sql);
    }

    if ($res) {
        echo 1;
    }
    else {
        echo 0;
    }
?>
