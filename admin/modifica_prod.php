
<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <!-- Titulo pestaña -->
        <title>Modificar</title>
        <!-- Icono pestaña -->
        <link href="https://fonts.googleapis.com/css?family=Montserrat:300,400,600&display=swap" rel="stylesheet">
        <link rel="icon" type="image/png" href="../img/icon.png"><script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <link rel="stylesheet" href="../css/style.css">    <!-- Hoja de estilo -->
        <script src="jquery-3.4.1.min.js"></script>
        <script type="text/javascript">
        // Funcion que valida que ningun textbox este vacio
        function valida(){
            // Varibles que almacenan el valor de los input
            var codigo = $('#codigo').val();
            var nombre = $('#nombre').val();
            var descripcion = $('#descripcion').val();
            var costo = $('#costo').val();
            var stock = $('#stock').val();
            var bandF = $('#banderaFile').val();
            // Verifica que al menos todos los datos del formulario hayan sido ingresados
            if (!codigo.length || !nombre.length || !descripcion.length || costo == 0 || !stock.length ) {
                $('.mensaje').html('Faltan campos por llenar'); // Modifica el contenedor, inserta al html.
                $('.mensaje ').show();
                $('.mensaje').fadeOut(2000);

                return false;
            }
            else { // Verifica que los datos ingresados sean como se predefinio
                if (bandF != '') {
                    var imagen = $('#archivo').val();
                    // Obtiene la extension y se almacena en la variable
                    var extension = (imagen.substring(imagen.lastIndexOf(".")));

                    if (extension != ".jpg") {
                        alert("La extension del archivo debe ser JPG");
                        return false;
                    }
                }
            }
            return true;
        }
        $(document).ready(function(){
            var codigoActual = $('#codigo').val();
            $("#archivo").on('change',function(){
                var filename = $('input[type=file]').val().split('\\').pop();     // Metodo al soltar la tecla en alguno de los campos
                $('#labelFile').html(filename);
                $('#banderaFile').attr("value","1f");
            });
            $("#enviar").on('click',function(){
                if (valida()) {
                    var form = $('#formdata')[0];
                    var data = new FormData(form);
                    $.ajax({
                        url: 'actualiza_prod.php',
                        type: "POST",
                        data: data,
                        enctype: 'multipart/form-data',
                        processData: false,  // Important!
                        contentType: false,
                        cache: false,
                        success: function(res){
                                if(res == 1){
                                    $('.exito').fadeIn(1000);
                                    $('.ventana').fadeOut(2000);
                                }
                                else {
                                    $('.error').show();
                                }
                            }
                        });
                }
            });
            $('#codigo').blur(function(){
                var codigo = $(this).val();
                if (codigoActual != codigo) {
                    $.ajax({
                        url: "validaCodigo.php",                     // Ejecuta la peticion de manera asincrona
                        type: "post",
                        data: ('codigo='+codigo),                 // Se transmiten las variables

                        success: function(respuesta){               // En caso de una conexion establecida
                            if (respuesta == 1) {                   // Se ha actualizado correctamente
                                $('#codigo').val(codigoActual);
                                $('#mensaje').html('El codigo '+codigo+' ya existe');
                                setTimeout("$('#mensaje').html('')",4000)
                            }
                        },
                        error: function(){                          // En caso de un fallo en la conexion
                            alert('Error al conectar al servidor');
                        }
                    });
                }
            });

        });

        </script>
        <style media="screen">
            html {
                height: 100vh;
            }
        </style>
    </head>
    <body>
        <main>
            <section>
                <a href="listados.php">Regresar a listado</a>
                <div class="ventana">
                    <!-- Titulo -->
                    <h1>Modificar</h1>
                    <!-- Formulario con metodo 'post' para ocultar datos en link -->
                    <?php
                        require('./conecta.php');               // Conecta a la Base de datos
                        $idBuscar = $_GET["id-prod"];       // Obtiene el id a buscar

                        $sql = "SELECT * FROM productos WHERE id ='$idBuscar'";    // Consulta MySql
                        $res = mysqli_query($con,$sql); // Ejecuta la consulta en 'sql', con la conexion establecida
                        $row = mysqli_fetch_assoc($res);
                    ?>
                    <form method="post" id="formdata" enctype="multipart/form-data">
                        <input type='hidden' name='id' id='idR' value='<?= $row['id'] ?>'>
                        <input type='text' id='codigo' name='codigo' value='<?= $row['codigo'] ?>'><br>
                        <input type='text' id='nombre' name='nombre' value='<?= $row['nombre'] ?>'><br>
                        <input type='text' id='descripcion' name='descripcion' value='<?= $row['descripcion']?>' ><br>
                        <input type="number" id="costo" name="costo" min="0.01" step="0.01" value="<?= $row['costo']?>"><br>
                        <input type="number" id="stock" name="stock" min="0" step="1" value="<?= $row['stock']?>"><br>
                        <label id="labelFile" for="archivo"><?=$row['archivo']?></label>
                        <input type="file" id="archivo" name="archivo"><br>  <!-- Selecciona un archivo -->
                        <input type='hidden' class='btn' id='banderaFile' name='bandF' type='button' value=''/>
                        <input class='btn' type='button' id='enviar' value='Actualizar'/>
                    </form>
                    <div id="mensaje" class="centrar"></div>
                    <div class="centrar mensaje" style="display:none;"></div>
                    <div class="centrar error" style="display:none;"> Error al actualizar producto </div>
                </div>  <!-- Cierre ventana -->
                <div class="centrar exito ventana" style="display:none;"> El producto ha sido modificado con éxito </div>
            </section>
        </main>
    </body>
</html>
