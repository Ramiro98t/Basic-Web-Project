<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <!-- Titulo pestaña -->
        <title>Login</title>
        <!-- Importacion de fuentes -->
        <link href="https://fonts.googleapis.com/css?family=Bebas+Neue&display=swap" rel="stylesheet">
        <!-- Icono pestaña -->
        <link rel="icon" type="image/png" href="img/icon.png">
        <link rel="stylesheet" href="css/styleLog.css">    <!-- Hoja de estilo -->
        <script src="jquery-3.4.1.min.js"></script>     <!-- Relacion archivo jquery-script -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>    <!-- Relacion archivo(online) jquery-script -->
        <script type="text/javascript">
        function validaLogIn(){
            // Varibles que almacenan el valor de los input
            var correo = $('#email').val();
            var contra = $('#password').val();
            // Verifica que al menos todos los datos del formulario hayan sido ingresados
            if (!correo.length || !contra.length) {
                $(".mensaje").html('Faltan campos por llenar'); // Modifica el contenedor, inserta al html.
                setTimeout("$('.mensaje').html('')",3000);
                return false;
            }
            else { // Verifica que los datos ingresados sean como se predefinio
                if (contra.length < 8) {
                    $("#mensaje").html('La contraseña debe tener minimo 8 caracteres'); // Modifica el contenedor, inserta al html.
                    setTimeout("$('.mensaje').html('')",3000);
                    return false;
                }
                return true;
            }
        }
        function validaRegistro(){
            // Varibles que almacenan el valor de los input
            var nombre = $('#name').val();
            var apellidos = $('#lastname').val();
            var correo = $('#emailR').val();
            var contra = $('#passwordR').val();
            // Verifica que al menos todos los datos del formulario hayan sido ingresados
            if (!nombre.length || !apellidos.length || !correo.length || !contra.length) {
                $(".mensaje").html('Faltan campos por llenar'); // Modifica el contenedor, inserta al html.
                setTimeout("$('.mensaje').html('')",3000);
            }
            else { // Verifica que los datos ingresados sean como se predefinio
                if (contra.length < 8) {
                    $(".mensaje").html('La contraseña debe tener minimo 8 caracteres'); // Modifica el contenedor, inserta al html.
                    setTimeout("$('.mensaje').html('')",3000);
                }
                else {
                    $(".mensaje").html('Registro completo '+nombre+'!'); // Modifica el contenedor, inserta al html.
                    setTimeout("$('.mensaje').html('')",1500);
                    setTimeout(function(){document.form1.submit();},1500);

                }
            }
        }
        $(document).ready(function(){   // Se cargan funciones al terminar de cargar la pagina completa
            // Cambia de ventanas entre Registro y LogIn
            $(".log").on('click',function(){
                $("#login").show();
                $("#registro").hide();
            });
            $(".reg").on('click',function(){
                $("#registro").show();
                $("#login").hide();
            });
            // Verifica que el correo a registrar exista o no
            $("#emailR").on('blur',function(){
                var correo = $(this).val();
                $.ajax({
                    url: "validaCorreo.php",                    // Ejecuta la peticion de manera asincrona
                    type: "post",
                    data: ('correo='+correo),                   // Se transmiten las variables

                    success: function(respuesta){               // En caso de una conexion establecida
                        if (respuesta == 1) {                   // Se ha actualizado correctamente
                            $("#emailR").val('');
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
            });
            // Verifica la informacion de usuario en la BD
            $("#loginBtn").on('click',function(){
                if (validaLogIn()) {
                    var form = $('#form0')[0];
                    var data = new FormData(form);
                    $.ajax({
                        url: 'valida.php',
                        type: 'POST',
                        data: data,
                        enctype: 'multipart/form-data',
                        processData: false,  // Important!
                        contentType: false,
                        cache: false,
                        success: function(res){
                                if(res == 1){
                                    $('.mensaje').html('Bienvenido!  <img src="./img/loading.gif" width="25px" height = "25px"/>'); // Modifica el contenedor 'id=mensaje', inserta al html la imagen
                                    // $(".mensaje").html('Bienvenido!'); // Modifica el contenedor, inserta al html.
                                    setTimeout("$('.mensaje').html('')",1500);
                                    setTimeout(function(){window.location.href='tienda.php';},1500);
                                }
                                else {
                                    $(".mensaje").html('Correo y/o contraseña incorrecto!'); // Mensaje de error
                                    setTimeout("$('.mensaje').html('')",3000);
                                }
                            }
                        });
                }
            });
        });
        </script>
    </head>

    <body>
        <header>
            <div class="fila">
                <h2>TIENDA ONLINE</h2>
                <img src="./img/carrito.svg" alt="carrito" width="60px">
            </div>
        </header>
        <main>
            <div id="login" class="ventana">
                <div class="titulo fila">
                    <h1 class="log">INICIAR SESION</h1>
                    <div class="line"></div>
                    <h2 class="reg">REGISTRARSE</h2>
                </div>
                <form action="" id="form0" method="post">
                    <input type="email" id="email" name="email"placeholder="correo@ejemplo.com.mx" autocomplete="off">
                    <input type="password" id="password" name="password"placeholder="contraseña">
                    <div class="mensaje"></div>
                    <button type="button" id="loginBtn" class="enviar">INICIAR SESION</button>
                    <a href="invitado.php">Continuar como invitado</a>
                </form>
            </div>

            <div id="registro" class="ventana" style="display:none;">
                <div class="titulo fila">
                    <h1 class="reg">REGISTRARSE</h1>
                    <div class="line"></div>
                    <h2 class="log">INICIAR SESION</h2>
                </div>
                <form action="salvaCliente.php" name="form1" method="post">
                    <input type="text" id="name" name="name" placeholder="nombre(s)" autocomplete="off">
                    <input type="text" id="lastname" name="lastname" placeholder="apellido(s)" autocomplete="off">
                    <input type="email" id="emailR" name="emailR" placeholder="correo@ejemplo.com.mx" autocomplete="off">
                    <input type="password" id="passwordR" name="passwordR" placeholder="contraseña">
                    <div class="mensaje"></div>
                    <button type="button" class="enviar" onclick="validaRegistro();">REGISTRARSE</button>
                    <a href="invitado.php">Continuar como invitado</a>
                </form>
            </div>
        </main>
    </body>
</html>
