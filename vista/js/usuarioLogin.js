$(document).ready(function() {


    cargarDatosUsuario();


    //cargara los datos de la persona que haya iniciado sesion en la aplicacion
    function cargarDatosUsuario() {
        var mensaje = "cargar";

        var objData = new FormData();
        objData.append("cargar", mensaje);

        $.ajax({
            url: "control/controlDatos.php",
            type: "post",
            dataType: "json",
            data: objData,
            cache: false,
            contentType: false,
            processData: false,
            success: function(respuesta) {

                var concatenacion = "";
                concatenacion += ' <img src="' + respuesta["foto"] + '" > ';
                concatenacion += '<p>' + ' ' + respuesta["nombre"] + ' ' + '</p>';
                concatenacion += '<p>' + ' ' + respuesta["apellidos"] + ' ' + '</p>';



                $("#datosPersonales").html(concatenacion);






















            }

        })

    }





})