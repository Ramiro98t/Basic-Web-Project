<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <!-- Titulo pestaña -->
        <title>Formulario</title>
        <!-- Icono pestaña -->
        <link href="https://fonts.googleapis.com/css?family=Montserrat:300,400,600&display=swap" rel="stylesheet">
        <link rel="icon" type="image/png" href="../img/icon.png">
        <link rel="stylesheet" href="../css/style.css">    <!-- Hoja de estilo -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>    <!-- Relacion archivo(online) jquery-script -->
        <script src="jquery-3.4.1.min.js"></script>
        <script type="text/javascript">
        // Funcion que valida que ningun textbox este vacio
        function valida(){
            // Varibles que almacenan el valor de los input
            var nombre = $('#nombres').val();
            var apellidos = $('#apellidos').val();
            var correo = $('#correo').val();
            var selector = $('#rol').val();
            var contra = $('#pw').val();
            var imagen = $('#archivo').val();
            // Obtiene la extension y se almacena en la variable
            var extension = (imagen.substring(imagen.lastIndexOf(".")));
            // Verifica que al menos todos los datos del formulario hayan sido ingresados
            if (!nombre.length || !apellidos.length || !correo.length || selector == 0 || !contra.length || !imagen.length) {
                $('#mensaje').html('Faltan campos por llenar'); // Modifica el contenedor, inserta al html.
            }
            else { // Verifica que los datos ingresados sean como se predefinio
                if (contra.length < 8) {
                    alert("La contraseña debe tener minimo 8 caracteres");
                }
                if (extension != ".jpg") {
                    alert("La extension del archivo debe ser JPG")
                }
                if(contra.length >= 8 && extension == ".jpg") {
                    document.form01.method='post';
                    document.form01.action="salva_administradores.php";
                    document.form01.submit();
                }
            }
        }
        $(document).ready(function(){
            $("#archivo").on('change',function(){
                var filename = $('input[type=file]').val().split('\\').pop();     // Metodo al soltar la tecla en alguno de los campos
                $('#labelFile').html(filename);
            });

            $('#correo').blur(function(){
                var correo = $(this).val();
                $.ajax({
                    url: "validaCorreo.php",                    // Ejecuta la peticion de manera asincrona
                    type: "post",
                    data: ('correo='+correo),                   // Se transmiten las variables

                    success: function(respuesta){               // En caso de una conexion establecida
                        if (respuesta == 1) {                   // Se ha actualizado correctamente
                            $('#correo').val('');
                            $('#mensaje').html('El correo '+correo+' ya existe');
                            setTimeout("$('#mensaje').html('')",4000)
                        }
                        else {

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
                    <h1>Formulario</h1>
                    <!-- Formulario con metodo 'post' para ocultar datos en link -->
                    <form class="formulario" name="form01" action="" method="post" align="center" enctype="multipart/form-data">
                        <!-- Textbox, placeholder para texto predefinido -->
                        <input type="text" id="nombres" name="nombres" placeholder="Nombre(s)" value=""><br>
                        <input type="text" id="apellidos" name="apellidos" placeholder="Apellido(s)" value=""><br>
                        <input type="email" id="correo" name="correo" placeholder="Ejemplo@dominio.com" value=""><br>
                        <input type="password" id="pw" name="pw" placeholder="Contraseña" value=""><br>
                        <select name="rol" id="rol"> <!-- Caja de seleccion -->
                            <!-- Opciones definidas, con su valor para futuras operaciones -->
                            <option value="0">Selecciona</option>
                            <option value="1">Administrar</option>
                            <option value="2">Consultar</option>
                        </select><br>
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
