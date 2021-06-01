$(document).ready(function() {

    $("#btnIngresar").click(function() {
        var user = $("#txtemail").val();
        var contraseña = $("#txtpwd").val();

        var objData = new FormData();
        objData.append("usuario", user);
        objData.append("contraseña", contraseña);

        $.ajax({
            url: "control/LoginControl.php",
            type: "post",
            dataType: "json",
            data: objData,
            cache: false,
            contentType: false,
            processData: false,
            success: function(respuesta) {

                var idUsuario = respuesta;

                if (respuesta == "No") {
                    alert("No se puede realizar el ingreso")
                } else {
                    alert(idUsuario);

                    alert("ingreso")

                    location.replace("principal.php");
                    /*   var ruta = "cabecera.php";

                       var objData2 = new FormData();
                       alert("este se envia", idUsuario);

                       objData2.append("ruta", ruta);

                       $.ajax({
                           url: "principal.php",
                           type: "post",
                           dataType: "json",
                           data: objData2,
                           cache: false,
                           contentType: false,
                           processData: false,

                       })*/
                }
            }
        })
    })
})