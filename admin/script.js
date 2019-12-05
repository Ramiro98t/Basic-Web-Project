// LISTO AL CARGAR LA PAGINA
$(document).ready(function(){
    /* HEADER BARRA DE NAVEGACION */
    $('#inicio').click(function(){              // INICIO
        $('.ventana').hide();                   // Oculta cualqiuer ventana
        $('.inicio').fadeIn();                  // Muestra la ventana correspondiente(Inicio)
    });
    $('#administradores').click(function(){     // ADMINISTRADORES
        $('.ventana').hide();                   // Oculta cualqiuer ventana
        $('.administradores').fadeIn();         // Muestra la ventana correspondiente(Administradores)
    });
    $('#productos').click(function(){           // PRODUCTOS
        $('.ventana').hide();                   // Oculta cualqiuer ventana
        $('.productos').fadeIn();               // Muestra la ventana correspondiente(Productos)
    });
    $('#clientes').click(function(){            // CLIENTES
        $('.ventana').hide();                   // Oculta cualqiuer ventana
        $('.clientes').fadeIn();                // Muestra la ventana correspondiente(Clientes)
    });
    $('#pedidos').click(function(){             // PEDIDOS
        $('.ventana').hide();                   // Oculta cualqiuer ventana
        $('.pedidos').fadeIn();                // Muestra la ventana correspondiente(Clientes)
    });
    // ADMINISTRADORES - CLICK EN BOTON
    $('.detalle').click(function(){             // Boton Administradores detalle - Click
        var fila = $(this).parent().parent().parent().attr('id');   // Obtiene el id de la fila seleccionada
        $('#detalle'+fila).fadeToggle();                            // Habilita / Inhabilita la vista de la ventana Detalle administrador
    });
    $('.elimina').click(function(){             //  Metodo para ocultar filas y eliminar administradores
        var fila = $(this).parent().parent().parent().attr('id');   // Obtiene el id de la fila seleccionada
        if (confirm('Borrar registro '+fila+'?')) {                 // Si se confirma da paso al ajax para update SQL
            $.ajax({
                url: 'elimina_administradores.php',                 // Pagina a la que se accede de manera asincrona
                type: 'post',                                       // Metodo de envio de datos
                dataType: 'text',
                data: 'id='+fila,                                   // Id de la fila seleccionada, a recibir en 'actualiza_administradores'
                success: function(res){                             // En caso de un redireccionamiento con exito
                    if (res == 1) {
                        $('#'+fila).fadeOut(300);                   // Se realizo la actualizacion en el registro sin fallo
                    }
                    else {
                        alert('Error al eliminar');                 // Existe alguna inconsistencia al hacer la actualizacion
                    }
                },
                error: function(){
                    alert('Error al conectar al servidor');         // Inconsistencia al redireccionar
                }
            }); // Fin ajax
        } // Fin de condicion(if)
    });
    // PRODUCTOS - CLICK EN BOTON
    $('.detalleP').click(function(){            // Boton Productos detalle- Click
        var fila = $(this).parent().parent().parent().attr('id');   // Obtiene el id de la fila seleccionada
        $('#detalleP'+fila).fadeToggle();                           // Habilita / Inhabilita la vista de la ventana Detalle producto
    });
    $('.eliminaP').click(function(){            //  Metodo para ocultar filas y eliminar administradores
        var fila = $(this).parent().parent().parent().attr('id');   // Obtiene el id de la fila seleccionada
        if (confirm('Borrar registro '+fila+'?')) {                 // Si se confirma da paso al ajax para update SQL
            $.ajax({
                url: 'elimina_prod.php',                            // Pagina a la que se accede de manera asincrona
                type: 'post',                                       // Metodo de envio de datos
                dataType: 'text',
                data: 'id='+fila,                                   // Id de la fila seleccionada, a recibir en 'actualiza_administradores'
                success: function(res){                             // En caso de un redireccionamiento con exito
                    if (res == 1) {
                        $('#'+fila).fadeOut(300);                   // Se realizo la actualizacion en el registro sin fallo
                    }
                    else {
                        alert('Error al eliminar');                 // Existe alguna inconsistencia al hacer la actualizacion
                    }
                },
                error: function(){
                    alert('Error al conectar al servidor');         // Inconsistencia al redireccionar
                }
            }); // Fin ajax
        } // Fin de condicion(if)
    });
    // CLIENTES - CLICK EN BOTON
    $('.detalleC').click(function(){            // Boton Productos detalle- Click
        var fila = $(this).parent().parent().parent().attr('id');   // Obtiene el id de la fila seleccionada
        $('#detalleC'+fila).fadeToggle();                           // Habilita / Inhabilita la vista de la ventana Detalle producto
    });
    $('.eliminaC').click(function(){            //  Metodo para ocultar filas y eliminar administradores
        var fila = $(this).parent().parent().parent().attr('id');   // Obtiene el id de la fila seleccionada
        if (confirm('Borrar registro '+fila+'?')) {                 // Si se confirma da paso al ajax para update SQL
            $.ajax({
                url: 'elimina_cli.php',                            // Pagina a la que se accede de manera asincrona
                type: 'post',                                       // Metodo de envio de datos
                dataType: 'text',
                data: 'id='+fila,                                   // Id de la fila seleccionada, a recibir en 'actualiza_administradores'
                success: function(res){                             // En caso de un redireccionamiento con exito
                    if (res == 1) {
                        $('#'+fila).fadeOut(300);                   // Se realizo la actualizacion en el registro sin fallo
                    }
                    else {
                        alert('Error al eliminar');                 // Existe alguna inconsistencia al hacer la actualizacion
                    }
                },
                error: function(){
                    alert('Error al conectar al servidor');         // Inconsistencia al redireccionar
                }
            }); // Fin ajax
        } // Fin de condicion(if)
    });
    // CLIENTES - CLICK EN BOTON
    $('.detalleO').click(function(){            // Boton Productos detalle- Click
        var fila = $(this).parent().parent().attr('id');   // Obtiene el id de la fila seleccionada
        $('#detalleO'+fila).fadeToggle();                           // Habilita / Inhabilita la vista de la ventana Detalle producto
    });
    /* BOTON CERRAR SESION */
    $('.logout').click(function(){
        if (confirm('Desea cerrar sesion?')) {              // Si se confirma se redirecciona para metodo de 'Destroy'
            $('.logout').attr("href","cierraSesion.php");
        }
    });
});
