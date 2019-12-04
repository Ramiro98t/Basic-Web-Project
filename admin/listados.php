<!DOCTYPE html>
<?php session_start(); ?>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <!-- Titulo pestaña -->
        <title>Administradores</title>
        <!-- Icono pestaña -->
        <link href="https://fonts.googleapis.com/css?family=Montserrat:300,400,600&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Bebas+Neue&display=swap" rel="stylesheet">
        <link rel="icon" type="image/png" href="../img/icon.png">
        <link rel="stylesheet" href="../css/style.css">    <!-- Hoja de estilo -->
        <script src="jquery-3.4.1.min.js"></script>     <!-- Relacion archivo jquery-script -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>    <!-- Relacion archivo(online) jquery-script -->
        <script src="script.js" type="text/javascript"></script>
    </head>

    <body>
        <!-- ENCABEZADO Y MENU PARA VENTANAS -->
        <header class="fila">
            <!-- Pestañas en barra de navegacion -->
            <h2 id="inicio">Inicio</h2>
            <h2 id="administradores">Administradores</h2>
            <h2 id="productos">Productos</h2>
            <h2 id="clientes">Clientes</h2>
            <h2 id="pedidos">Pedidos</h2>
            <?php
                if (isset($_SESSION['idU'])) {                                  // Nombre de Usuario con sesion actual
                    echo "<label style='margin:0;'>Bienvenido ".$_SESSION['nomU']."</label>";
                }
            ?>
            <a class='logout' href=''>Log Out</a>                               <!-- Boton para cerrar sesion actual -->
        </header>

        <!-- VENTANAS -->
        <main>
            <!-- VENTANA DE BIENVENIDA -->
            <div class="inicio ventana">
                <?php
                if (isset($_SESSION['idU'])) {                                  // Nombre de Usuario con sesion actual
                        echo "<h1 style='margin:50px auto;'>Bienvenido ".$_SESSION['nomU']."</h1>";
                    }
                ?>
            </div>
            <!-- CIERRE VENTANA DE BIENVENIDA -->

            <!-- VENTANA DE ADMINISTRADORES -->
            <?php
            require_once('conecta.php');                                        // Establece la conexion a la BD
            // Consulta a la base de datos para mostrar los que no hayan sido eliminados logicamente
            $sql = "SELECT * FROM administradores WHERE status = 1 AND eliminado = 0";
            $res  = mysqli_query($con,$sql);                                    // Hace consulta con la conexion establecida
            $filas = mysqli_num_rows($res);                                      // Obtiene el numero de filas
            ?>

            <!-- Inicio tabla Administradores, no se muestra a menos que se accione en la pestaña -->
            <div class='administradores ventana' style='display:none;'>
                <div class='horizontal'>                      <!-- Encabezado de ventana -->
                        <h1>Administradores (<?= $filas ?>)</h1>    <!-- Titulo -->
                        <a href='formulario.php'>Insertar</a>       <!-- Redireccionar e insertar en la BD -->
                </div>                                              <!-- Fin de encabezado de ventana -->

                <?php
                // Ciclo para recibir registro por registro para manipular sus metodos posteriormente
                for($i = 1; $f = $res->fetch_object(); $i++){
                    $id = $f->id;
                ?>
                <div class='horizontal' id='<?= $id?>'>         <!-- Inicio Registro -->
                    <div class='horizontal'>                    <!-- Mitad izquierda(Imagen,Nombre,Correo) -->
                        <div class='celda-imagen'>
                            <img src='../archivos/<?= $f->archivo_n ?>.jpg' alt='avatar'>  <!-- Imagen -->
                        </div>

                        <div class='celda'>
                            <?= $f->nombre.' '.$f->apellidos ?>                         <!-- Nombre -->
                        </div>

                        <div class='celda'>
                            <?= $f->correo ?>                                  <!-- Correo -->
                        </div>
                    </div>                                      <!-- Fin mitad izquierda -->

                    <div class='hor'>                           <!-- Mitad derecha(Detalles,Modifica,Elimina) -->
                        <div class='celda'>
                            <button type='button' class='detalle'>Detalle</button>      <!-- Ver detalle -->
                        </div>

                        <div class='celda'>
                            <a class='abutton' href="modifica.php?id-usuario=<?=$id ?>">Modificar</a>
                        </div>

                        <div class='celda'>
                            <?php
                            if (isset($_SESSION['idU'])) {      // Nombre de Usuario con sesion actual
                                    if ($_SESSION['idU'] != $id){
                                        echo "<button type='button' class='elimina'>ELIMINAR</button>     <!-- Eliminar -->";
                                    }
                                }
                            ?>
                        </div>
                    </div>                                      <!-- Fin mitad derecha -->
                </div>                                          <!-- Fin registro -->
                <?php } ?>  <!-- Fin del ciclo -->
            </div>  <!-- Fin de la tabla de Administradores -->

        <?php
            // VENTANAS DE DETALLE-ADMINISTRADORES
            $res  = mysqli_query($con,$sql);    // Hace consulta con la conexion establecida
            echo "<div class='barraLateral'>";
            // Ciclo para mostrar los resultados en la BD
            for($i = 1; $f = $res->fetch_object(); $i++){       // Asigna cada registro a una ventana
                $id = $f->id;
                ?>
                <div class='ventana detalleMenu' style='display:none;' id='detalle<?=$id?>'>
                    <h1>Detalles</h1>
                    <ul>                                    <!-- Lista de campos del registro -->
                        <li>
                            <img src='../archivos/<?=$f->archivo_n?>.jpg' alt='avatar'> <!-- Imagen -->
                        </li>

                        <li>
                            <?=$f->nombre.' '.$f->apellidos?>                    <!-- Nombre -->
                        </li>

                        <li>
                            <?=$f->correo?>                                          <!-- Correo -->
                        </li>

                        <li>
                            <?=($f->rol == 1) ? "Administrar" : "Consultar";?>      <!-- Rol, Operador ternario -->
                        </li>

                    </ul>                                   <!-- Fin de la lista -->
                </div>                                      <!-- Cierre de la ventana de registro -->
            <?php
            }
            echo "</div>";  // Fin barra lateral
            // VENTANAS DE VENTANAS DETALLE-ADMINISTRADORES

            ?>
            <!-- /** CIERRE VENTANA DE ADMINISTRADORES **/ -->

            <!-- VENTANA DE PRODUCTOS -->
            <?php
            require_once('conecta.php');       // Establece la conexion a la BD
            // Consulta a la base de datos para mostrar los que no hayan sido eliminados logicamente
            $sql1 = "SELECT * FROM productos WHERE status = 1 AND eliminado = 0";
            $res1  = mysqli_query($con,$sql1);    // Hace consulta con la conexion establecida
            $filas1 = mysqli_num_rows($res1);  // Obtiene el numero de filas
            // Ciclo para mostrar los resultados en la BD
            ?>
            <div class='productos ventana' style='display:none;'> <!-- Inicio ventana tabla -->
                <div class='horizontal'>                      <!-- Encabezado de ventana -->
                    <h1>Productos (<?=$filas1?>)</h1>                    <!-- Titulo -->
                    <a href='form_prod.php'>Insertar</a>       <!-- Redireccionar e insertar en la BD -->
                </div>                                     <!-- Fin de encabezado de ventana -->

            <?php
            for($i = 1; $f = $res1->fetch_object(); $i++){
                $id = $f->id;
            ?>
            <div class='horizontal' id='<?= $id?>'>               <!-- Registro -->
                <div class='horizontal'>                    <!-- Mitad izquierda(Imagen,Nombre,Correo) -->
                    <div class='celda-imagen'>
                        <img src='../archivos/<?= $f->archivo_n ?>.jpg' alt='avatar'>  <!-- Imagen -->
                    </div>

                    <div class='celda'>
                        <?= $f->codigo  ?>                                          <!-- Codigo -->
                    </div>

                    <div class='celda'>
                        <?= $f->nombre ?>                                           <!-- Nombre -->
                    </div>
                </div>                                      <!-- Fin mitad izquierda -->

                <div class='hor'>                           <!-- Mitad derecha(Detalles,Modifica,Elimina) -->
                    <div class='celda'>
                        <button type='button' class='detalleP'>Detalle</button>     <!-- Ver detalle -->
                    </div>

                    <div class='celda'>
                        <a class='abutton' href="modifica_prod.php?id-prod=<?=$id ?>">Modificar</a>
                    </div>

                    <div class="celda" style="display:flex;align-items:center;">
                        <img class="eliminaP" src="../img/equis.svg" width="28px" style="cursor:pointer;" title="Eliminar registro <?=$id?>">     <!-- Eliminar -->
                    </div>
                </div>                                      <!-- Fin mitad derecha -->
            </div>                                          <!-- Fin registro -->

            <?php } ?>    <!-- Fin del ciclo -->

            </div> <!-- Fin de la tabla de Productos -->

            <!-- VENTANAS DE DETALLE-PRODUCTOS -->
            <div class='barraLateral_P'>
                <?php
                $res1  = mysqli_query($con,$sql1);    // Hace consulta con la conexion establecida
                // Ciclo para mostrar los resultados en la BD
                for($i = 1; $f = $res1->fetch_object(); $i++){       // Asigna cada registro a una ventana
                    $id = $f->id;
                ?>
                        <div class='ventana detalleMenuP' style='display:none;' id='detalleP<?=$id?>'>     <!-- Ventana de registro -->
                            <h1>Detalles</h1>
                            <ul>                                    <!-- Lista de campos del registro -->
                                <li>
                                    <div class='celda-imagen'><img src='../archivos/<?=$f->archivo_n?>.jpg' alt='avatar'></div> <!-- Imagen -->
                                </li>

                                <li>
                                    Código: <?=$f->codigo?>                    <!-- Codigo -->
                                </li>

                                <li>
                                    Nombre: <?=$f->nombre?>                    <!-- Nombre -->
                                </li>

                                <li>
                                    Descripción:<br><?=$f->descripcion?>               <!-- Descripcion -->
                                </li>

                                <li>
                                    Costo ($): <?=$f->costo?>                     <!-- Costo -->
                                </li>

                                <li>
                                    Stock: <?=$f->stock?>                     <!-- Stock -->
                                </li>
                            </ul>                                   <!-- Fin de la lista -->
                        </div>                                      <!-- Cierre de la ventana de registro -->
                <?php } ?>
            </div>    <!-- Fin barra lateral -->

            <!-- VENTANA DE CLIENTES -->
            <?php
            require_once('conecta.php');       // Establece la conexion a la BD
            // Consulta a la base de datos para mostrar los que no hayan sido eliminados logicamente
            $sql1 = "SELECT * FROM clientes WHERE status = 1 AND eliminado = 0";
            $res1  = mysqli_query($con,$sql1);    // Hace consulta con la conexion establecida
            $filas1 = mysqli_num_rows($res1);  // Obtiene el numero de filas
            // Ciclo para mostrar los resultados en la BD
            ?>
            <div class='clientes ventana' style='display:none;'> <!-- Inicio ventana tabla -->
                <div class='horizontal'>                      <!-- Encabezado de ventana -->
                    <h1>Clientes (<?=$filas1?>)</h1>                    <!-- Titulo -->
                    <a href='form_cl.php'>Insertar</a>       <!-- Redireccionar e insertar en la BD -->
                </div>

            <?php
            for($i = 1; $f = $res1->fetch_object(); $i++){
                $id = $f->id;
            ?>
            <div class='horizontal' id='<?=$id?>'>               <!-- Registro -->
                <div class='horizontal'>                    <!-- Mitad izquierda(Imagen,Nombre,Correo) -->
                    <div class='celda' style="width:250px;">
                        <?= $f->nombre.' '.$f->apellidos ?>                         <!-- Nombre -->
                    </div>

                    <div class='celda' style="width:250px;">
                        <?= $f->correo  ?>                                  <!-- Correo -->
                    </div>
                </div>                                      <!-- Fin mitad izquierda -->

                <div class='hor'>                           <!-- Mitad derecha(Detalles,Modifica,Elimina) -->
                    <div class='celda'>
                        <button type='button' class='detalleC'>Detalle</button>     <!-- Ver detalle -->
                    </div>

                    <div class='celda'>
                        <a class='abutton' href="modifica_cli.php?id-cl=<?=$id ?>">Modificar</a>
                    </div>

                    <div class="celda" style="display:flex;align-items:center;">
                        <img class="eliminaC" src="../img/equis.svg" width="28px" style="cursor:pointer;" title="Eliminar registro <?=$id?>">     <!-- Eliminar -->
                    </div>
                </div>                                      <!-- Fin mitad derecha -->
            </div>                                          <!-- Fin registro -->

            <?php } ?>    <!-- Fin del ciclo -->

            </div> <!-- Fin de la tabla de Productos -->

            <!-- VENTANAS DE DETALLE-PRODUCTOS -->
            <div class='barraLateral_C'>
                <?php
                $res1  = mysqli_query($con,$sql1);    // Hace consulta con la conexion establecida
                // Ciclo para mostrar los resultados en la BD
                for($i = 1; $f = $res1->fetch_object(); $i++){       // Asigna cada registro a una ventana
                    $id = $f->id;
                ?>
                        <div class='ventana detalleMenuC' style='display:none;' id='detalleC<?=$id?>'>     <!-- Ventana de registro -->
                            <h1>Detalles</h1>
                            <ul>                                    <!-- Lista de campos del registro -->
                                <li>
                                    <?=$f->nombre.' '.$f->apellidos?>                    <!-- Nombre -->
                                </li>

                                <li>
                                    <?=$f->correo?>                                          <!-- Correo -->
                                </li>
                            </ul>                                   <!-- Fin de la lista -->
                        </div>                                      <!-- Cierre de la ventana de registro -->
                <?php } ?>
            </div>    <!-- Fin barra lateral -->


            <!-- ***************** -->
            <!-- VENTANA DE PEDIDOS -->
            <?php
            require_once('conecta.php');       // Establece la conexion a la BD
            // Consulta a la base de datos para mostrar los que no hayan sido eliminados logicamente
            $sql1 = "SELECT * FROM pedidos WHERE status = 1";
            $res1  = mysqli_query($con,$sql1);    // Hace consulta con la conexion establecida
            $filas1 = mysqli_num_rows($res1);  // Obtiene el numero de filas
            // Ciclo para mostrar los resultados en la BD
            ?>
            <div class='pedidos ventana' style='display:none;'> <!-- Inicio ventana tabla -->
                <div class='horizontal'>                      <!-- Encabezado de ventana -->
                    <h1>Pedidos (<?=$filas1?>)</h1>                    <!-- Titulo -->
                </div>
            <div class="horizontal">
                <div class="celda" style="width:130px;">ID Pedido</div>
                <div class="celda" style="width:130px;">Usuario</div>
                <div class="celda" style="width:130px;">Fecha</div>
                <div class="celda" style="width:130px;">Detalles</div>
            </div>
            <?php
            for($i = 1; $f = $res1->fetch_object(); $i++){
                $id = $f->id;
            ?>
            <div class='horizontal' id='<?=$id?>'>               <!-- Registro -->
                <div class='celda' style="width:130px;">
                    <?= $f->id ?>                                  <!-- Correo -->
                </div>

                <div class='celda' style="width:130px;">
                    <?= $f->usuario ?>                         <!-- Nombre -->
                </div>

                <div class='celda' style="width:130px;">
                    <?= $f->fecha  ?>                                  <!-- Correo -->
                </div>

                <div class="celda" style="width:130px;">
                    <img class="detalleO" src="../img/detalles.svg" width="28px" style="cursor:pointer;">     <!-- Eliminar -->
                </div>
            </div>                                          <!-- Fin registro -->

            <?php } ?>    <!-- Fin del ciclo -->

            </div> <!-- Fin de la tabla de Productos -->

            <!-- VENTANAS DE DETALLE-PRODUCTOS -->
            <div class='barraLateral_O'>
                <?php
                $sql = "SELECT pedidos.id AS num_pedido, pedidos.usuario, pedidos.fecha,
                pedidos_productos.id_producto, pedidos_productos.cantidad FROM pedidos
                INNER JOIN pedidos_productos ON pedidos.id = pedidos_productos.id_pedido WHERE status != 0";
                $res1  = mysqli_query($con,$sql);    // Hace consulta con la conexion establecida
                // Ciclo para mostrar los resultados en la BD
                for($i = 1; $f = $res1->fetch_object(); $i++){       // Asigna cada registro a una ventana
                    $id = $f->num_pedido;
                ?>
                    <div class='ventana detalleMenuO' style='display:none;' id='detalleO<?=$id?>'>     <!-- Ventana de registro -->
                    <h1>Detalles</h1>
                    <ul>
                        <li>ID pedido: <?= $f->num_pedido ?></li>
                        <li>Usuario: <?= $f->usuario ?></li>
                        <li>Fecha: <?= $f->fecha ?></li>
                        <li>
                        <?php
                        $sql = "SELECT pedidos_productos.id_pedido, pedidos_productos.cantidad,
                        productos.nombre, productos.costo FROM productos INNER JOIN pedidos_productos
                        ON productos.id = pedidos_productos.id_producto WHERE id_pedido = $id";
                        $res = mysqli_query($con,$sql);    // Hace consulta con la conexion establecida
                        // Ciclo para mostrar los resultados en la BD
                        $paid = false;
                        $total = 0;
                        for($j = 1; $g = $res->fetch_object(); $j++){       // Asigna cada registro a una ventana
                            echo $g->nombre." (".$g->cantidad.")<br>";
                            if ($g->cantidad != 0) {
                                $paid = true;
                            }
                            $total += (($g->cantidad)*($g->costo));
                        }
                        ?>
                        </li>
                        <?php
                        if ($paid) {
                            echo "<p style='color:green;'>Total: $$total </p>";
                        }
                        else {
                            echo "<p style='color:red;'>Cancelado</p>";
                        }

                        ?>
                    </ul>                                   <!-- Fin de la lista -->
                    </div>                                      <!-- Cierre de la ventana de registro -->
                <?php } ?>
            </div>    <!-- Fin barra lateral -->
        </main>
    </body>

</html>
