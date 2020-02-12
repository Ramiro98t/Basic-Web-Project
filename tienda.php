<!DOCTYPE html>
<?php
    session_start();
    $user = $_SESSION['user'];
    require("conecta.php");    // Conecta a la Base de datos
    $sql = "SELECT nombre, apellidos FROM clientes";    // Consulta Sql
    $res = mysqli_query($con,$sql);    // Hace consulta con la conexion establecida
    $fila = mysqli_num_rows($res);      // Obtiene el numero de filas
    $random = "false";
    for ($i=0; $f = $res->fetch_object(); $i++) {
        $cliente = $f->nombre." ".$f->apellidos;
        if ($cliente == $user) {
            $random = "false";
            break;
        }
        $random = "true";
    }
?>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <!-- Titulo pestaña -->
        <title>Productos</title>
        <!-- Importacion de fuentes -->
        <link href="https://fonts.googleapis.com/css?family=Montserrat:300,400,600&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Bebas+Neue&display=swap" rel="stylesheet">
        <link rel="icon" type="image/png" href="img/icon.png">    <!-- Icono pestaña -->
        <link rel="stylesheet" href="css/style.css">              <!-- Hoja de estilo -->
        <script src="jquery-3.4.1.min.js"></script>               <!-- Relacion archivo jquery-script -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>    <!-- Relacion archivo(online) jquery-script -->
        <script type="text/javascript">
            $(document).ready(function(){   // Se cargan funciones al terminar de cargar la pagina completa
                // Agrega algun producto o incrementa su cantidad en el pedido en curso
                $(".add").on('click',function(){
                    var producto = $(this).attr("id");
                    var usuario = "<?= $_SESSION['user']; ?>";
                    $.ajax({
                        url: 'pedidos.php',                 // Pagina a la que se accede de manera asincrona
                        type: 'post',                                       // Metodo de envio de datos
                        dataType: 'text',
                        data:('usuario='+usuario+
                            '&producto='+producto),
                        success: function(res){                             // En caso de un redireccionamiento con exito
                            // $("#carrito").load(location.href + " #carrito>*", "");
                            location.href="tienda.php";
                        },
                        error: function(){
                            alert('Error al conectar al servidor');         // Inconsistencia al redireccionar
                        }
                    }); // Fin ajax
                    var cant = parseInt($(".cantidad-carrito").text(),10);  // Convierte a entero el valor actual del div(html)
                    cant++;                                                 // Incrementa el valor almacenado en una variable
                    $(".cantidad-carrito").attr("value",cant);              // Modifica el valor del div con la nueva cantidad
                    $(".cantidad-carrito").html(cant);                      // Inserta en el html la nueva cantidad

                });
                // Muestra mini ventana lista de los productos del carrito
                $(".carrito").on('click',function(){
                    $(".vista-carrito").fadeToggle("fast"); // Oculta/Muestra al hacer click
                });
                // Modifica la cantidad de productos en el pedido en curso
                $(".cant").on('change',function(){
                    var fila = $(this).parent().attr("id");
                    var producto = $(this).attr("name");
                    var cantidad =  parseInt($(this).val());
                    var total = document.querySelectorAll(".cant");
                    let t = 0;
                    total.forEach(producto=>{
                        t += parseInt(producto.value);
                    })
                    $(".cantidad-carrito").html(t);                      // Inserta en el html la nueva cantidad
                    $.ajax({
                        url: 'actualiza_cant_prod.php',                 // Pagina a la que se accede de manera asincrona
                        type: 'post',                                       // Metodo de envio de datos
                        dataType: 'text',
                        data:('producto='+producto+
                            '&cantidad='+cantidad),                                   // Id de la fila seleccionada, a recibir en 'actualiza_administradores'
                        success: function(res){                             // En caso de un redireccionamiento con exito
                            if (cantidad == 0) {
                                $("#"+fila).fadeToggle("fast"); // Oculta/Muestra al hacer click
                            }
                        },
                        error: function(){
                            alert('Error al conectar al servidor');         // Inconsistencia al redireccionar
                        }
                    }); // Fin ajax
                });
                // Quita el producto del pedido en curso
                $(".quitar_producto").on('click',function(){
                    var fila = $(this).parent().attr("id");
                    var cantidad = 0;
                    var producto = $(this).attr("name");
                    var total = document.querySelectorAll(".cant");
                    let t = 0;
                    total.forEach(producto=>{
                        t += parseInt(producto.value);
                    })
                    $(".cantidad-carrito").html(t);                      // Inserta en el html la nueva cantidad
                    $.ajax({
                        url: 'actualiza_cant_prod.php',                 // Pagina a la que se accede de manera asincrona
                        type: 'post',                                       // Metodo de envio de datos
                        dataType: 'text',
                        data:('producto='+producto+
                            '&cantidad='+cantidad),                                 // Id de la fila seleccionada, a recibir en 'actualiza_administradores'
                        success: function(res){                             // En caso de un redireccionamiento con exito
                            $("#"+fila).fadeToggle("fast"); // Oculta/Muestra al hacer click
                        },
                        error: function(){
                            alert('Error al conectar al servidor');         // Inconsistencia al redireccionar
                        }
                    }); // Fin ajax
                });
                // Vacia la lista de productos del pedido en curso
                $("#vaciar").on('click',function(){
                    if (confirm('Desea vaciar el carrito?')) {              // Si se confirma se redirecciona para metodo de 'Destroy'
                        var producto = 0, cantidad = 0;
                        var total = document.querySelectorAll(".cant");
                        let t = 0;
                        total.forEach(producto=>{
                            t += parseInt(producto.value);
                        })
                        $(".cantidad-carrito").html(t);                      // Inserta en el html la nueva cantidad
                        $.ajax({
                            url: 'actualiza_cant_prod.php',                 // Pagina a la que se accede de manera asincrona
                            type: 'post',                                       // Metodo de envio de datos
                            dataType: 'text',
                            data:('producto='+producto+
                            '&cantidad='+cantidad),                                 // Id de la fila seleccionada, a recibir en 'actualiza_administradores'
                            success: function(res){                             // En caso de un redireccionamiento con exito
                                $(".producto").fadeToggle("fast"); // Oculta/Muestra al hacer click
                            },
                            error: function(){
                                alert('Error al conectar al servidor');         // Inconsistencia al redireccionar
                            }
                        }); // Fin ajax
                    }
                });
                // Muestra el boton de añadir al carrito al pasar el cursor por el producto
                $(".item").hover(function(){
                    var fila = $(this).attr("id");      // Recibe el id de la fila en la que se encuentra para acceder solo a un producto
                    $("#"+fila+"button").toggle();      // Oculta/Muestra el boton para añadir al carrito
                    $("#"+"info"+fila).toggle();        // Oculta/Muestra la informacion del producto
                });
                /* BOTON CERRAR SESION */
                $('.logout').click(function(){
                    if (confirm('Desea cerrar sesion?')) {              // Si se confirma se redirecciona para metodo de 'Destroy'
                        var usuario = "<?= $_SESSION['user']; ?>";
                        $.ajax({
                            url: 'cancela_pedido.php',                 // Pagina a la que se accede de manera asincrona
                            type: 'post',                                       // Metodo de envio de datos
                            dataType: 'text',
                            data:('usuario='+usuario),                                 // Id de la fila seleccionada, a recibir en 'actualiza_administradores'
                            success: function(res){                             // En caso de un redireccionamiento con exito
                                window.location.replace("cierraSesion.php");
                            },
                            error: function(){
                                alert('Error al conectar al servidor');         // Inconsistencia al redireccionar
                            }
                        }); // Fin ajax
                    }
                });
                // Pedido a pagar
                $("#caja").click(function(){
                    window.location.replace("caja.php");
                });
            });
        </script>
    </head>

    <body>
        <header>    <!-- Encabezado -->
            <!-- ELEMENTOS DEL ENCABEZADO -->
            <h2>TIENDA ONLINE</h2>              <!-- Titulo -->
            <div class="invitado" style="display:grid; justify-items:center;">

                <?php
                    if ($random == "true") {
                        echo "<a href='cierraSesion.php'>¿Ya estás registrado?</a>";
                    }
                    else if ($random == "false"){
                        echo "<a class='logout' href=''>Log Out</a>                               <!-- Boton para cerrar sesion actual -->";
                    }
                ?>
                <label style='margin:0;'>Bienvenido <?= $_SESSION['user'] ?></label><!-- Usuario actual -->
            </div>
            <div id="cantidad-carrito" class="carrito">    <!-- Icono carrito -->
                <img class="icono" src="img/carrito.svg" alt="logo carrito" width="80px">    <!-- SVG de icono carrito de compras -->
                <?php
                    require("conecta.php");  // Conecta a la Base de datos
                    $sql = "SELECT pedidos.*, SUM(cantidad) AS total FROM pedidos_productos
                    INNER JOIN pedidos ON pedidos_productos.id_pedido = pedidos.id WHERE usuario = '$user' AND status = 0";    // Suma la cantidad total de articulos en el pedido
                    $res = mysqli_query($con,$sql);    // Hace consulta con la conexion establecida
                    $cant = $res->fetch_object();
                    $cant = $cant->total;            // Se le asigna el campo de retorno del query
                    // $cant != 0 ? $cant = $cant : $cant = 0;
                ?>
                <div class="cantidad-carrito" value="<?= $cant ?>">
                    <?= $cant ?>    <!-- Contador de articulos -->
                </div>
            </div>    <!-- Fin icono carrito -->

            <div id="carrito" class="vista-carrito ventana" style="display:none;">    <!--  Ventana pedido -->
                <div class="vista-carrito-header">    <!-- Encabezado ventana pedido -->
                    <h2>Carrito</h2>
                    <img id="vaciar" class="icono" src="img/basura.svg" alt="logo basura" title="Vaciar carrito">
                </div>    <!-- Fin encabezado ventana pedido -->

                <?php
                    // Hace consulta de los pedidos pendientes, status = 0 del usuario en linea
                    $sql = "SELECT * FROM pedidos WHERE usuario='$user' AND status='0'";
                    $res = mysqli_query($con,$sql);    // Hace consulta con la conexion establecida
                    $fila = mysqli_num_rows($res);  // Obtiene el numero de filas

                    if ($fila) {
                        $id_pedido = $res->fetch_object();
                        $id_pedido = $id_pedido->id;

                        $sql = "SELECT productos.nombre, pedidos_productos.* FROM pedidos_productos INNER JOIN
                        productos ON pedidos_productos.id_producto = productos.id WHERE id_pedido='$id_pedido' AND cantidad != 0";
                        $res  = mysqli_query($con,$sql);    // Hace consulta con la conexion establecida
                        $fila = mysqli_num_rows($res);      // Obtiene el numero de filas
                    }
                ?>

                <?php
                    for ($i=$fila; $f = $res->fetch_object(); $i--) {
                ?>
                        <div id="<?=$f->id_producto?>c"class="producto">    <!-- Fila de productos en pedido -->
                            <?=$f->nombre?>
                            <input name="<?=$f->id_producto?>" type="number" class="cant" min="0" step="1" value="<?=$f->cantidad?>" title="Cantidad">
                            <img name="<?=$f->id_producto?>" class="icono quitar_producto" src="img/equis.svg" alt="logo borrar" title="Quitar producto">
                        </div>
                <?php
                    }
                    if ($cant != 0) { echo "<button type='button' id='caja'>Pasar a Caja</button>"; }
                ?>
            </div>    <!--  Fin ventana pedido -->

        </header>    <!-- FIN DEL ENCABEZADO -->

        <main>
            <div class="contenedor ventana">
                <?php
                $sql = "SELECT * FROM productos WHERE status = 1 AND eliminado = 0 ORDER BY id DESC";
                $res  = mysqli_query($con,$sql);    // Hace consulta con la conexion establecida
                $fila = mysqli_num_rows($res);  // Obtiene el numero de filas

                for ($i=$fila; $f = $res->fetch_object(); $i--) {
                    ?>
                    <div id="<?= $i ?>"class="ventana item">
                        <div class="celda-imagen" style="width:120px;height:120px;" title="<?= strtoupper($f->nombre)."\n".$f->descripcion ?>">
                            <img src='archivos/<?= $f->archivo_n ?>.jpg' alt='avatar'> <!-- Imagen de producto -->
                        </div>
                        <div id="info<?= $i?>">
                            <div class="nombre">
                                <?= $f->nombre ?>   <!-- Nombre del producto -->
                            </div>
                            <div class="precio">
                                $ <?= $f->costo ?><!-- Precio del producto -->
                            </div>
                        </div>
                        <div id="<?= $f->id ?>button" class="agregar" style="display:none; margin-top:15px;">
                            <button id="<?= $f->id ?>" type="button" class="add">Agregar al Carrito</button>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </main>
    </body>

</html>
