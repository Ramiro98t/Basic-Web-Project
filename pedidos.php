<?php
    require_once('./conecta.php');  // Conecta a la Base de datos
    // Recibe Variables
    $user = $_POST['usuario'];
    $fecha = date("dmY");
    $id_producto = $_POST['producto'];

    // echo "Usuario:".$user."\nFecha:".$fecha."\nProducto:".$id_producto."\n";

    // Pedido pendiente, Status = 1, cuando haya sido realizado o cancelado
    $sql = "SELECT * FROM pedidos WHERE usuario='$user' AND status='0'";
    $res = mysqli_query($con,$sql);

    $fila = mysqli_num_rows($res);  // Obtiene el numero de filas

    // Si existe un pedido pendiente
    if ($fila) {
        $id_pedido = $res->fetch_object();
        $id_pedido = $id_pedido->id;
        // Inserta al mismo pedido producto o modifica la cantidad
        $sql = "SELECT * FROM pedidos_productos WHERE id_pedido='$id_pedido' AND id_producto='$id_producto'";
        $res = mysqli_query($con,$sql);
        $fila = mysqli_num_rows($res);

        if ($fila) {
            $cant = $res->fetch_object();
            $cant = $cant->cantidad;
            $cant++;
            echo $cant;

            $sql = "UPDATE pedidos_productos SET cantidad='$cant'
            WHERE id_producto='$id_producto' AND id_pedido='$id_pedido'";
            $res = mysqli_query($con,$sql);
        }
        else {
            $sql = "INSERT INTO pedidos_productos VALUES
                    (0,'$id_pedido','$id_producto',1)";
            $res = mysqli_query($con,$sql);
        }
        return 1;
    }
    // Si no existe un pedido pendiente
    else {
        // Crea un nuevo pedido para el usuario
        $sql = "INSERT INTO pedidos VALUES
                (0,'$fecha','$user',0)";
        $res = mysqli_query($con,$sql);

        $sql = "SELECT * FROM pedidos WHERE usuario='$user' AND status='0'";
        $res = mysqli_query($con,$sql);

        $id = $res->fetch_object();
        $id = $id->id;

        // Inserta al mismo pedido producto o modifica la cantidad
        $sql = "INSERT INTO pedidos_productos VALUES
                (0,'$id','$id_producto',1)";
        $res = mysqli_query($con,$sql);
        return 1;
    }
    return 0;
?>
