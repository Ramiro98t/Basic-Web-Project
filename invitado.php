<!-- Simulacion crear usuario **/ -->
<?php
    session_start();
    // substr() Regresa parte de una cadena
    // Primer parametro la cadena
    // switchegundo parametro es el punto de inicio de la cadena a tomar
    // Tercer parametro es la longitud de esta cadena
    // str_shuffle() Regresa la cadena ordenada de manera aleatoria
    $cad1 = substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"),0,5);
    // md5() Encripta la cadena en el formato del mismo nombre
    // microtime() Regresa una cadena en microsegundos que han transcurrido desde la epoca Unix
    $cad2 = substr(md5(microtime()),1,10);
    // Concatena la cadena de 5 caracteres del alfabeto de cad1 a la de 10 caracteres obtenidos en la encriptacion de microsegundos
    $user = $cad1.$cad2;
    $_SESSION['user'] = $user;    // Establece un nombre de usuario aleatorio obtenido de los metodos anteriores
    header("Location: index.php");  // Redirecciona a pagina principal
?>
