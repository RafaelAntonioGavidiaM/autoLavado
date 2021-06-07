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
                concatenacion += ' <img id="usuarioLogin"  src="' + respuesta["foto"] + '" > ';
                concatenacion += '<div id="textLogin">' + respuesta["nombre"] +'' ;
                concatenacion += ' ' + respuesta["apellidos"] + '</div>';

                $("#Usuario").html(concatenacion);

            }

        })

    }





})