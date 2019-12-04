
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
            var nombre = $('#nombres').val();
            var apellidos = $('#apellidos').val();
            var correo = $('#correo').val();
            var contra = $('#pw').val();
            var rol = $('#rol').val();
            var img = $('#archivo').val();
            var bandF = $('#banderaFile').val();

            // Verifica que al menos todos los datos del formulario hayan sido ingresados
            if (!nombre.length || !apellidos.length || !correo.length || rol == 0 || !contra.length) {
                $('.mensaje').html('Faltan campos por llenar'); // Modifica el contenedor, inserta al html.
                $('.mensaje ').show();
                $('.mensaje').fadeOut(2000);

                return false;
            }
            else { // Verifica que los datos ingresados sean como se predefinio
                if (contra.length < 8) {
                    alert("La contraseña debe tener minimo 8 caracteres");
                    return false;
                }
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
            var correoActual = $('#correo').val();
            $("#archivo").on('change',function(){
                var filename = $('input[type=file]').val().split('\\').pop();     // Metodo al soltar la tecla en alguno de los campos
                $('#labelFile').html(filename);
                $('#banderaFile').attr("value","1f");
            });
            $("#pw").on('change',function(){
                $('#banderaContra').attr("value","1c");
            });
            $("#enviar").on('click',function(){
                if (valida()) {
                    var form = $('#formdata')[0];
                    var data = new FormData(form);
                    $.ajax({
                        url: 'actualiza_admin.php',
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
            $('#correo').blur(function(){
                var correo = $(this).val();
                if (correoActual != correo) {
                    $.ajax({
                        url: "validaCorreo.php",                     // Ejecuta la peticion de manera asincrona
                        type: "post",
                        data: ('correo='+correo),                 // Se transmiten las variables

                        success: function(respuesta){               // En caso de una conexion establecida
                            if (respuesta == 1) {                   // Se ha actualizado correctamente
                                $('#correo').val(correoActual);
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
                        $idBuscar = $_GET["id-usuario"];       // Obtiene el id a buscar

                        $sql = "SELECT * FROM administradores WHERE id ='$idBuscar'";    // Consulta MySql
                        $res = mysqli_query($con,$sql); // Ejecuta la consulta en 'sql', con la conexion establecida
                        $row = mysqli_fetch_assoc($res);
                    ?>
                    <form method="post" id="formdata" enctype="multipart/form-data">
                        <input type='hidden' name='id' id='idR' value='<?= $row['id'] ?>'>
                        <input type='text' id='nombres' name='nombres' value='<?= $row['nombre'] ?>'><br>
                        <input type='text' id='apellidos' name='apellidos' value='<?= $row['apellidos']?>' ><br>
                        <input type='email' id='correo' name='correo' value='<?= $row['correo'] ?>'><br>
                        <input type='password' id='pw' name='pw' value='<?= $row['pass'] ?>'><br>
                        <select name='rol' id='rol' value=''>
                        <?php
                            if ($row['rol']==1) {
                                echo "<option value='1' selected>Administrar</option>";
                                echo "<option value='2'>Consultar</option>";
                            }
                            else {
                                echo "<option value='1'>Administrar</option>";
                                echo "<option value='2' selected>Consultar</option>";
                        }
                        ?>
                        </select><br>
                        <label id='labelFile' for='archivo'><?=$row['archivo']?></label>
                        <input type='file' id='archivo' name='archivo'><br> <!-- Selecciona un archivo -->
                        <input type='hidden' class='btn' id='banderaFile' name='bandF' type='button' value=''/>
                        <input type='hidden' class='btn' id='banderaContra' name='bandC' type='button' value=''/>
                        <input class='btn' type='button' id='enviar' value='Actualizar'/>
                    </form>
                    <div id="mensaje" class="centrar"></div>
                    <div class="centrar mensaje" style="display:none;"></div>
                    <div class="centrar error" style="display:none;"> Error al actualizar usuario </div>
                </div>  <!-- Cierre ventana -->
                <div class="centrar exito ventana" style="display:none;"> El usuario ha sido modificado con exito </div>
            </section>
        </main>
    </body>
</html>
