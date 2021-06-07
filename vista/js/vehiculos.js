$(document).ready(function() {

    /*--------------------------------------------------------------------------------------------------------*/
    /*-----------------------------------------------CARGAR DATOS---------------------------------------------*/
    /*--------------------------------------------------------------------------------------------------------*/

    cargarDatos();
    cargarDueno();
    $("#btnGuardarVehiculo").click(function() {
        alert("HolaMundox3");
        var modelo = $("#txtModelo").val();
        var dueño = $("#duenoSelect").val();
        var color = $("#txtColor").val();
        var placa = $("#txtPlaca").val();
        var imagen = document.getElementById("txtImagen").files[0];
        var objData = new FormData();
        alert(modelo);
        alert(imagen);
        objData.append("modelo", modelo);
        objData.append("dueño", dueño);
        objData.append("color", color);
        objData.append("placa", placa);
        objData.append("imagen", imagen);

        $.ajax({
            url: "control/vehiculosControl.php",
            type: "post",
            dataType: "json",
            data: objData,
            cache: false,
            contentType: false,
            processData: false,
            success: function(respuesta) {
                if (respuesta == "ok") {
                    alert(respuesta); //si realizo registro



                }


            }
        })
    })

    /*--------------------------------------------------------------------------------------------------------*/
    /*-----------------------------------------------CARGAR DATOS DUEÑO---------------------------------------------*/
    /*--------------------------------------------------------------------------------------------------------*/

    function cargarDueno() {
        var mensaje = "ok";
        var objData = new FormData();

        objData.append("cargarDueno", mensaje);

        $.ajax({
            url: "control/vehiculosControl.php",
            type: "post",
            dataType: "json",
            data: objData,
            cache: false,
            contentType: false,
            processData: false,
            success: function(respuesta) {

                console.log(respuesta);

                var interface = '';
                respuesta.forEach(cargarduenoCarro);

                function cargarduenoCarro(item, index) {

                    interface += '<option value="' + item.idDueño + '">' + item.nombre + " " + item.apellidos + '</option>';
                }



                $("#duenoSelect").html(interface);
            }
        })
    }




    /*--------------------------------------------------------------------------------------------------------*/
    /*-----------------------------------------------LISTAR DATOS---------------------------------------------*/
    /*--------------------------------------------------------------------------------------------------------*/
    function cargarDatos() {
        var listaVehiculos = "ok";
        var objListaVehiculos = new FormData();
        objListaVehiculos.append("listaVehiculos", listaVehiculos);

        $.ajax({
            url: "control/vehiculosControl.php",
            type: "post",
            dataType: "json",
            data: objListaVehiculos,
            cache: false,
            contentType: false,
            processData: false,
            success: function(respuesta) {

                var interface = '';
                respuesta.forEach(cargarTablacarro);

                function cargarTablacarro(item, index) {
                    interface += '<tr>';

                    interface += '<td>' + item.modelo + '</td>';
                    interface += '<td>' + item.nombre + " " + item.apellidos + '</td>';
                    interface += '<td>' + item.color + '</td>';
                    interface += '<td>' + item.placa + '</td>';
                    interface += '<td><img src="' + item.imagen + '" high="40" width="40"></td>';
                    interface += '<td>';
                    interface += '<div class="btn-group">';
                    interface += '<button type="button" class="btn btn-warning" title="Editar" id="btn-editarVehiculos" idCarro="' + item.idCarro + '"  modelo="' + item.modelo + '" dueño="' + item.idDueño + '" color="' + item.color + '" placa="' + item.placa + '" imagen="' + item.imagen + '" data-toggle="modal" data-target="#modalEditar"><span class="glyphicon glyphicon-pencil"></span></button>';
                    interface += '<button type="button" class="btn btn-danger" title="Eliminar" id="btn-eliminarVehiculos" idCarro="' + item.idCarro + '"><span class="glyphicon glyphicon-trash"></span></button>';
                    interface += '</div>';
                    interface += '</td>';
                    interface += '</tr>';
                }

                $("#cuerpoTablacarro").html(interface);
            }
        })
    }


    /*--------------------------------------------------------------------------------------------------------*/
    /*-----------------------------------------------EDITAR DATOS---------------------------------------------*/
    /*--------------------------------------------------------------------------------------------------------*/

    $("#tablacarro").on("click", "#btn-editarVehiculos", function() {
        var idCarro = $(this).attr("idCarro");
        var modelo = $(this).attr("modelo");
        var dueño = $(this).attr("dueno");
        var color = $(this).attr("color");
        var placa = $(this).attr("placa");
        imagen = $(this).attr("imagen");
        $("#modimagen").attr("src",imagen);

        $("#txtModModelo").val(modelo);
        $("#modDuenoSelect").val(dueño);
        $("#txtModColor").val(color);
        $("#txtModPlaca").val(placa);
        $("#txtModImagen").val();
        $("#btnModCarro").attr("idCarro", idCarro);
    })


    /*--------------------------------------------------------------------------------------------------------*/
    /*---------------------------------------------ELIMINAR DATOS---------------------------------------------*/
    /*--------------------------------------------------------------------------------------------------------*/

    $("#tablaCarro").on("click", "#btn-eliminarVehiculos", function(){
       
        var idCarro = $(this).attr("idCarro");
    
        swal({
            title: "¿Esta seguro de eliminar el registro?",
            text: "Recuerde que si lo elimina no tendra formas de recuperarlo",
            icon: "warning",
            buttons: true,
            dangerMode: true,
          })
          .then((willDelete) => {
            if (willDelete) {
                $.ajax({
                    url: "control/vehiculosControl.php",
                    type: "post",
                    data:{'idCarro':idCarro},
                    success:function(){
                        swal(
                            "Registro eliminado exitosamente!", {
                            icon: "success",
                        });
                        cargarDatos();          
                    }
               })
            }
            else {
              swal("Su registro esta a salvo!",{
              icon:"success",
              })
            }
        })
    })


    /*--------------------------------------------------------------------------------------------------------*/
    /*------------------------------------------CARGAR DATOS MODAL--------------------------------------------*/
    /*--------------------------------------------------------------------------------------------------------*/

    $("#btnModCarro").click(function() {
        var idCarro = $(this).attr("idCarro");
        var modelo = $("#txtModModelo").val();
        var dueño = $("#modDuenoSelect").val();
        var color = $("#txtModColor").val();
        var placa = $("#txtModPlaca").val();
        var rutaImagen = "";
        var opcion3 = "";
        var opcion4 = ""

        var imagenAnterior = "";
        if ($("#txtModImagen").val() == null ||  $("#txtModImagen").val() == ""  ) {

            alert("Hola");
            rutaImagen = imagen;
            opcion3 ="imagenNormal";
        }
        else{

            alert("Hola mundo")
            var imagenNueva = document.getElementById("txtModImagen").files[0];
            rutaImagen = imagenNueva;
            imagenAnterior = foto;
            opcion4 ="imagenArray";
            
        }   
        alert(rutaImagen);
        
        var objData = new FormData();
        if (opcion3 = "imagenNormal" && opcion4 == "") {
            alert("Hola")
            objData.append("opcion3",opcion3);
            
        }else if (opcion4 = "imagenArray" && opcion3 == "") {
            alert("Hola Mundo")
            objData.append("opcion4",opcion4);
        } else {
            
        }

        var objData = new FormData();
        objData.append("modIdCarro", idCarro);
        objData.append("modModelo", modelo);
        objData.append("modDueño", dueño);
        objData.append("modColor", color);
        objData.append("modPlaca", placa);
        objData.append("modImagen", rutaImagen);
        objData.append("imagenAnterior",imagenAnterior);
        $.ajax({
            url: "control/vehiculosControl.php",
            type: "post",
            dataType: "json",
            data: objData,
            cache: false,
            contentType: false,
            processData: false,
            success: function(respuesta) {

                Swal.fire({
                    position: 'top-end',
                    icon: 'success',
                    title: 'Registro Exitoso',
                    showConfirmButton: false,
                    timer: 1500
                })
                cargarDatos();
            }
        })
    })

})