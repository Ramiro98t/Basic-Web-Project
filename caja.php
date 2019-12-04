<!DOCTYPE html>
<?php
    session_start();
    $user = $_SESSION['user'];
?>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- Titulo pestaña -->
    <title>Caja</title>
    <!-- Importacion de fuentes -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:300,400,600&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Bebas+Neue&display=swap" rel="stylesheet">
    <link rel="icon" type="image/png" href="img/icon.png">    <!-- Icono pestaña -->
    <link rel="stylesheet" href="css/style.css">              <!-- Hoja de estilo -->
    <script src="jquery-3.4.1.min.js"></script>               <!-- Relacion archivo jquery-script -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>    <!-- Relacion archivo(online) jquery-script -->
    <script type="text/javascript">
    $(document).ready(function(){   // Se cargan funciones al terminar de cargar la pagina completa
        // Pedido confirmado
        $("#pagar").on('click',function(){
            var status = 1;
            $.ajax({
                url: 'pagado.php',                 // Pagina a la que se accede de manera asincrona
                type: 'post',                                       // Metodo de envio de datos
                dataType: 'text',
                data:('status='+status),                                 // Id de la fila seleccionada, a recibir en 'actualiza_administradores'
                success: function(res){                             // En caso de un redireccionamiento con exito
                    if (res == 1) {
                        alert("El pago se ha realizado con éxito");
                        location.href="caja.php";
                    }
                    else {
                        alert("Quizá ocurrió algún inconveniente con la forma de pago");

                    }
                },
                error: function(){
                    alert('Error al conectar al servidor');         // Inconsistencia al redireccionar
                }
            }); // Fin ajax
        });
    });
    </script>
</head>
<body>
    <header>    <!-- Encabezado -->
        <!-- ELEMENTOS DEL ENCABEZADO -->
        <h2>TIENDA ONLINE</h2>              <!-- Titulo -->
        <div class="invitado" style="display:grid; justify-items:center;">
        <label style='margin:0;'>Bienvenido <?= $_SESSION['user'] ?></label><!-- Usuario actual -->
        </div>
        <a href="tienda.php">Continuar comprando</a>
        <div id="cantidad-carrito" class="carrito">    <!-- Icono carrito -->
            <img class="icono" src="img/carrito.svg" alt="logo carrito" width="80px">    <!-- SVG de icono carrito de compras -->
            <?php
                require("conecta.php");  // Conecta a la Base de datos
                $sql = "SELECT pedidos.*, SUM(cantidad) AS total FROM pedidos_productos
                INNER JOIN pedidos ON pedidos_productos.id_pedido = pedidos.id WHERE status = 0";    // Suma la cantidad total de articulos en el pedido
                $res = mysqli_query($con,$sql);    // Hace consulta con la conexion establecida
                $cant = $res->fetch_object();
                $cant = $cant->total;            // Se le asigna el campo de retorno del query
                // $cant != 0 ? $cant = $cant : $cant = 0;
            ?>
            <div class="cantidad-carrito" value="<?= $cant ?>">
                <?= $cant ?>    <!-- Contador de articulos -->
            </div>
        </div>    <!-- Fin icono carrito -->
    </header>    <!-- FIN DEL ENCABEZADO -->

    <main>
        <div class="ventana" style="width:600px">
            <div class="producto descripcion" style="display:grid; grid-template-columns: repeat(3,1fr);">
                <p>Articulo</p>
                <p>Cantidad</p>
                <p>Precio($)</p>
            </div>
            <?php
                require("conecta.php");
                // Hace consulta de los pedidos pendientes, status = 0 del usuario en linea
                $sql = "SELECT * FROM pedidos WHERE usuario='$user' AND status='0'";
                $res = mysqli_query($con,$sql);    // Hace consulta con la conexion establecida
                $fila = mysqli_num_rows($res);  // Obtiene el numero de filas

                if ($fila) {
                    $id_pedido = $res->fetch_object();
                    $id_pedido = $id_pedido->id;

                    $sql = "SELECT productos.*, pedidos_productos.* FROM pedidos_productos INNER JOIN
                    productos ON pedidos_productos.id_producto = productos.id WHERE id_pedido='$id_pedido' AND cantidad != 0";
                    $res  = mysqli_query($con,$sql);    // Hace consulta con la conexion establecida
                    $fila = mysqli_num_rows($res);      // Obtiene el numero de filas
                }
            ?>

            <?php
                $total = 0;
                for ($i=$fila; $f = $res->fetch_object(); $i--) {
                    $money = $f->cantidad * $f->costo;
                    $total += $money;
            ?>
                    <div class="producto" style="display:grid; grid-template-columns: repeat(3,1fr);">    <!-- Fila de productos en pedido -->
                        <div ><?=$f->nombre?></div>
                        <p><?=$f->cantidad?></p>
                        <p>$<?=$money?></p>
                    </div>
            <?php
                }
            ?>
            <div class="producto total" style="display:grid; grid-template-columns: repeat(3,1fr);">
                <p style="color: green;">Total:</p>
                <p></p>
                <p style="color: green;">$<?= $total ?></p>
            </div>
            <?php
                if ($fila) {
                    echo "<button type='button' id='pagar'>Pasar a pagar</button>";
                }
             ?>
        </div>
    </main>
</body>
</html>
