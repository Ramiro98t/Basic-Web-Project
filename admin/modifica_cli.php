
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
            var nombre = $('#nombre').val();
            var apellidos = $('#apellidos').val();
            var correo = $('#correo').val();
            var contra = $('#pw').val();
            // Verifica que al menos todos los datos del formulario hayan sido ingresados
            if (!nombre.length || !apellidos.length || !correo.length || !contra.length) {
                $(".mensaje").html('Faltan campos por llenar'); // Modifica el contenedor, inserta al html.
                setTimeout("$('.mensaje').html('')",3000);
                return false;
            }
            else { // Verifica que los datos ingresados sean como se predefinio
                if (contra.length < 8) {
                    $(".mensaje").html('La contraseña debe tener minimo 8 caracteres'); // Modifica el contenedor, inserta al html.
                    setTimeout("$('.mensaje').html('')",3000);
                    return false;
                }
                return true;
            }
        }
        $(document).ready(function(){
            var correoActual = $('#correo').val();
            $("#pw").on('change',function(){
                $('#banderaContra').attr("value","1c");
            });
            $("#enviar").on('click',function(){
                if (valida()) {
                    var form = $('#formdata')[0];
                    var data = new FormData(form);
                    $.ajax({
                        url: 'actualiza_cli.php',
                        type: "POST",
                        data: data,
                        enctype: 'multipart/form-data',
                        processData: false,  // Important!
                        contentType: false,
                        cache: false,
                        success: function(res){
                                if(res == 1){
                                    $(".mensaje").html('Modificación éxitosa!'); // Modifica el contenedor, inserta al html.
                                    setTimeout("$('.mensaje').html('')",1500);
                                    setTimeout(function(){window.location.href='listados.php';},1500);
                                }
                                else {
                                    alert('Error al conectar al servidor');
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
                                $("#correo").val('');
                                $(".mensaje").html("El correo: "+correo+" ya existe");
                                setTimeout("$('.mensaje').html('')",3000)
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
                        $idBuscar = $_GET["id-cl"];       // Obtiene el id a buscar

                        $sql = "SELECT * FROM clientes WHERE id ='$idBuscar'";    // Consulta MySql
                        $res = mysqli_query($con,$sql); // Ejecuta la consulta en 'sql', con la conexion establecida
                        $row = mysqli_fetch_assoc($res);
                    ?>
                    <form method="post" name="form1" id="formdata" enctype="multipart/form-data">
                        <input type='hidden' name='id' id='idR' value='<?= $row['id'] ?>'>
                        <input type='text' id='nombre' name='nombre' value='<?= $row['nombre'] ?>'><br>
                        <input type='text' id='apellidos' name='apellidos' value='<?= $row['apellidos']?>' ><br>
                        <input type='email' id='correo' name='correo' value='<?= $row['correo'] ?>'><br>
                        <input type='password' id='pw' name='pw' value='<?= $row['pass'] ?>'><br>
                        <input type='hidden' class='btn' id='banderaContra' name='bandC' type='button' value=''/>
                        <input class='btn' type='button' id='enviar' value='Actualizar'/>
                    </form>
                    <div class="mensaje"></div>
                </div>  <!-- Cierre ventana -->
            </section>
        </main>
    </body>
</html>
