<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <!-- Titulo pestaña -->
        <title>Formulario Productos</title>
        <!-- Icono pestaña -->
        <link href="https://fonts.googleapis.com/css?family=Montserrat:300,400,600&display=swap" rel="stylesheet">
        <link rel="icon" type="image/png" href="../img/icon.png">
        <link rel="stylesheet" href="../css/style.css">    <!-- Hoja de estilo -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
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
            var imagen = $('#archivo').val();
            // Obtiene la extension y se almacena en la variable
            var extension = (imagen.substring(imagen.lastIndexOf(".")));
            // Verifica que al menos todos los datos del formulario hayan sido ingresados
            if (!codigo.length || !nombre.length || !descripcion.length || costo == 0 || !stock.length || !imagen.length) {
                $('#mensaje').html('Faltan campos por llenar'); // Modifica el contenedor, inserta al html.
            }
            else { // Verifica que los datos ingresados sean como se predefinio
                if (extension != ".jpg") {
                    alert("La extension del archivo debe ser JPG")
                }
                if(extension == ".jpg") {
                    document.form02.method='post';
                    document.form02.action="salva_prod.php";
                    document.form02.submit();
                }
            }
        }
        $(document).ready(function(){
            $("#archivo").on('change',function(){
                var filename = $('input[type=file]').val().split('\\').pop();     // Metodo al soltar la tecla en alguno de los campos
                $('#labelFile').html(filename);
            });

            $('#codigo').blur(function(){
                var codigo = $(this).val();
                $.ajax({
                    url: "validaCodigo.php",                     // Ejecuta la peticion de manera asincrona
                    type: "post",
                    data: ('codigo='+codigo),                 // Se transmiten las variables

                    success: function(respuesta){               // En caso de una conexion establecida
                        if (respuesta == 1) {                   // Se ha actualizado correctamente
                            $('#codigo').val('');
                            $('#mensaje').html('El codigo '+codigo+' ya existe');
                            setTimeout("$('#mensaje').html('')",4000)
                        }
                    },
                    error: function(){                          // En caso de un fallo en la conexion
                        alert('Error al conectar al servidor');
                    }
                });
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
                    <h1>Form Productos</h1>
                    <!-- Formulario con metodo 'post' para ocultar datos en link -->
                    <form class="formulario" name="form02" action="" method="post" align="center" enctype="multipart/form-data">
                        <!-- Textbox, placeholder para texto predefinido -->
                        <input type="text" id="codigo" name="codigo" placeholder="Codigo"><br>
                        <input type="text" id="nombre" name="nombre" placeholder="Nombre"><br>
                        <input type="text" id="descripcion" name="descripcion" placeholder="Descripcion"><br>
                        <input type="number" id="costo" name="costo" min="0.01" step="0.01" placeholder="Costo"><br>
                        <input type="number" id="stock" name="stock" min="0" step="1" placeholder="En Stock"><br>
                        <label id="labelFile" for="archivo">Seleccione archivo</label>
                        <input type="file" id="archivo" name="archivo"><br>  <!-- Selecciona un archivo -->
                        <!-- Boton para llamar la funcion de validacion -->
                        <!-- Tipo submit para que sea boton, return false para no ejecutar el action del Formulario -->
                        <input onclick="valida();" type="button" value="Enviar"/>
                    </form>
                    <div id="mensaje" class="centrar"></div>
                </div>  <!-- Cierre ventana -->
            </section>
        </main>
    </body>
</html>
