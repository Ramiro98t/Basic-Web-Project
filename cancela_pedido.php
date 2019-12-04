<?php
    require_once('./conecta.php');  // Conecta a la Base de datos
    // Recibe Variables
    $user = $_POST['usuario'];

    $sql = "SELECT * FROM pedidos WHERE status = 0";
    $res = mysqli_query($con,$sql);

    $id_pedido = $res->fetch_object();
    $id_pedido = $id_pedido->id;

    $sql = "UPDATE pedidos SET status = 1
    WHERE usuario='$user'";
    $res = mysqli_query($con,$sql);

    $sql = "UPDATE pedidos_productos SET cantidad = 0
    WHERE id_pedido='$id_pedido'";
    $res = mysqli_query($con,$sql);

    if ($res) {
        echo 1;
    }
    else {
        echo 0;
    }
?>
