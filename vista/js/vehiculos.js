$(document).ready(function() {

    /*--------------------------------------------------------------------------------------------------------*/
    /*-----------------------------------------------CARGAR DATOS---------------------------------------------*/
    /*--------------------------------------------------------------------------------------------------------*/

    cargarDatos();
    cargarDueno(1, "");
    $("#btnGuardarVehiculo").click(function() {
        alert("HolaMundox3");
        var modelo = $("#txtModelo").val();
        var dueño = $("#duenoSelect").val();
        var color = $("#txtColor").val();
        var placa = $("#txtPlaca").val();
        var imagen = document.getElementById("txtImagen").files[0];
        var objData = new FormData();

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
                Swal.fire({
                    position: 'top-center',
                    icon: 'success',
                    title: 'Registro Exitoso',
                    showConfirmButton: false,
                    timer: 1500
                })
                cargarDatos();
            }
        })
    })

    /*--------------------------------------------------------------------------------------------------------*/
    /*-----------------------------------------------CARGAR DATOS DUEÑO---------------------------------------------*/
    /*--------------------------------------------------------------------------------------------------------*/

    function cargarDueno(opcion, idDueno) {
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

                if (opcion == 1) {
                    console.log(respuesta);

                    var interface = '';
                    respuesta.forEach(cargarduenoCarro);

                    function cargarduenoCarro(item, index) {

                        interface += '<option value="' + item.idDueño + '">' + item.nombre + " " + item.apellidos + '</option>';
                    }

                    //alert(interface);

                    $("#duenoSelect").html(interface);

                } else if (opcion == 2) {

                    var interface = '';
                    var principal = "";
                    respuesta.forEach(cargarduenoCarro);

                    function cargarduenoCarro(item, index) {
                        if (item.idDueño == idDueno) {
                            principal = '<option value="' + item.idDueño + '">' + item.nombre + " " + item.apellidos + '</option>';
                        } else {
                            interface += '<option value="' + item.idDueño + '">' + item.nombre + " " + item.apellidos + '</option>';
                        }
                    }
                    $("#modDuenoSelect").html(principal + interface);
                }
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
                    interface += '<button type="button" class="btn btn-warning" title="Editar" id="btn-editarVehiculos" idCarro="' + item.idCarro + '"  modelo="' + item.modelo + '" dueño="' + item.idDueño + '" color="' + item.color + '" placa="' + item.placa + '" imagen="' + item.imagen + '" data-toggle="modal" data-target="#modalEditarVehiculo"><span class="glyphicon glyphicon-pencil"></span></button>';
                    interface += '<button type="button" class="btn btn-danger" title="Eliminar" id="btn-eliminarVehiculos" idCarro="' + item.idCarro + '"  imagen="' + item.imagen + '"><span class="glyphicon glyphicon-trash"></span></button>';
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
    var imagen = "";
    $("#tablacarroVehiculo").on("click", "#btn-editarVehiculos", function() {


        var idCarro = $(this).attr("idCarro");
        var modelo = $(this).attr("modelo");
        var dueño = $(this).attr("dueño");
        var color = $(this).attr("color");
        var placa = $(this).attr("placa");
        imagen = $(this).attr("imagen");
        $("#imagenVehiculos").attr("src", imagen);

        $("#txtModModelo").val(modelo);

        $("#txtModColor").val(color);
        $("#txtModPlaca").val(placa);
        $("#txtModImagen").val();
        $("#btnModCarro").attr("idCarro", idCarro);

        cargarDueno(2, dueño);
    })


    /*--------------------------------------------------------------------------------------------------------*/
    /*---------------------------------------------ELIMINAR DATOS---------------------------------------------*/
    /*--------------------------------------------------------------------------------------------------------*/

    $("#tablacarroVehiculo").on("click", "#btn-eliminarVehiculos", function() {

        Swal.fire({
            title: '¿Estas seguro?',
            text: "¡No podrás revertir esto!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: '¡Sí, !Eliminalo!'
        }).then((result) => {
            if (result.isConfirmed) {
                var idCarro = $(this).attr("idCarro");
                var imagen = $(this).attr("imagen");


                var objData = new FormData();
                objData.append("eliminarId", idCarro);
                objData.append("deleteImagen", imagen);


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
                            Swal.fire(
                                'Deleted!',
                                'Your file has been deleted.',
                                'success'
                            )

                            cargarDatos();
                        }
                    }
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
        if ($("#txtModImagen").val() == null || $("#txtModImagen").val() == "") {

            rutaImagen = imagen;
            opcion3 = "imagenNormal";
        } else {

            var imagenNueva = document.getElementById("txtModImagen").files[0];
            rutaImagen = imagenNueva;
            imagenAnterior = imagen;
            opcion4 = "imagenArray";

        }
        var objData = new FormData();
        if (opcion3 = "imagenNormal" && opcion4 == "") {
            objData.append("opcion3", opcion3);

        } else if (opcion4 = "imagenArray" && opcion3 == "") {
            objData.append("opcion4", opcion4);
        } else {

        }


        objData.append("modIdCarro", idCarro);
        objData.append("modModelo", modelo);
        objData.append("modDueño", dueño);
        objData.append("modColor", color);
        objData.append("modPlaca", placa);
        objData.append("modImagen", rutaImagen);
        objData.append("imagenAnterior", imagenAnterior);
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
                    position: 'top-center',
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