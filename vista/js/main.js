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


                    alert("ingreso")

                    location.replace("principal.php");











                }








            }

        })




    })






})