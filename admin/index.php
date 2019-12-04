<!DOCTYPE html>
<html lang="es" style="background: url(../img/wall.jpg);background-size: cover;">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <!-- Titulo pestaña -->
        <title>Login</title>
        <!-- Importacion de fuentes -->
        <link href="https://fonts.googleapis.com/css?family=Bebas+Neue&display=swap" rel="stylesheet">
        <!-- Icono pestaña -->
        <link href="https://fonts.googleapis.com/css?family=Montserrat:300,400,600&display=swap" rel="stylesheet">
        <link rel="icon" type="image/png" href="../img/icon.png">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <link rel="stylesheet" href="../css/styleLog.css">    <!-- Hoja de estilo -->
        <script src="jquery-3.4.1.min.js"></script>
        <script type="text/javascript">
        // Funcion que valida que ningun textbox este vacio
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
        $(document).ready(function(){   // Se cargan funciones al terminar de cargar la pagina completa
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
                                    $(".mensaje").html('Bienvenido!'); // Modifica el contenedor, inserta al html.
                                    setTimeout("$('.mensaje').html('')",1500);
                                    setTimeout(function(){window.location.href='listados.php';},1500);
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
                <h2>ADMINISTRADORES</h2>
            </div>
        </header>
        <main>
            <main>
                <div id="login" class="ventana">
                    <div class="titulo fila">
                        <h1 class="log">INICIAR SESION</h1>
                    </div>
                    <form action="salvaCliente.php" id="form0" method="post">
                        <input type="email" id="email" name="email" placeholder="correo@ejemplo.com.mx" autocomplete="off">
                        <input type="password" id="password" name="password" placeholder="contraseña">
                        <div class="mensaje"></div>
                        <button type="button" id="loginBtn" class="enviar">INICIAR SESION</button>
                    </form>
                </div>
        </main>
    </body>
</html>
