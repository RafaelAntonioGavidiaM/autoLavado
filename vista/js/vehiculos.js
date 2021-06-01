$(document).ready(function() {

    cargarDatos();

    $("#btnGuardar").click(function() {
        var modelo = $("#txtModelo").val();
        var dueño = $("#txtDueño").val();
        var color = $("#txtColor").val();
        var placa = $("#txtPlaca").val();
        var imagen = $("#txtImagen").val();
        var objData = new FormData();
        alert(modelo);
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
                cargarDatos();
                alert(respuesta);
            }
        })
    })


    function cargarDatos() {
        var listaVehiculos = "ok";
        var objListarVehiculos = new FormData();
        objListarVehiculos.append("listaVehiculos", listaVehiculos);

        $.ajax({
            url: "control/vehiculosControl.php",
            type: "post",
            dataType: "json",
            data: objListarVehiculos,
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
                    interface += '<td>' + item.imagen + '</td>';
                    interface += '<td>';
                    interface += '<div class="btn-group">';
                    interface += '<button type="button" class="btn btn-warning" title="Editar" id="btn-editar" idCarro="' + item.idCarro + '"  modelo="' + item.modelo + '" dueño="' + item.idDueño + '" color="' + item.color + '" placa="' + item.placa + '" imagen="' + item.imagen + '" data-toggle="modal" data-target="#modalEditar"><span class="glyphicon glyphicon-pencil"></span></button>';
                    interface += '<button type="button" class="btn btn-danger" title="Eliminar" id="btn-eliminar" idCarro="' + item.idCarro + '"><span class="glyphicon glyphicon-remove"></span></button>';
                    interface += '</div>';
                    interface += '</td>';
                    interface += '</tr>';
                }

                $("#cuerpoTablacarro").html(interface);
            }
        })
    }


    $("#tablacarro").on("click", "#btn-editar", function() {
        var idCarro = $(this).attr("idCarro");
        var modelo = $(this).attr("modelo");
        var dueño = $(this).attr("dueño");
        var color = $(this).attr("color");
        var placa = $(this).attr("placa");
        var imagen = $(this).attr("imagen");

        $("#txtModModelo").val(modelo);
        $("#txtModDueño").val(dueño);
        $("#txtModColor").val(color);
        $("#txtModPlaca").val(placa);
        $("#txtModImagen").val(imagen);
        $("#btnModCarro").attr("idCarro", idCarro);
    })


    $("#tablaCarro").on("click", "#btn-eliminar", function() {
        var idCarro = $(this).attr("idCarro");

        swal({
                title: "¿Esta seguro de eliminar este registro?",
                text: "Una vez lo elimines no podras recuperar la información!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {

                    var objData = new FormData();
                    objData.append("eliminarId", idCarro);

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

                                swal("Se elimino registro");
                                cargarDatos();
                            } else {

                            }
                        }
                    })

                } else {
                    swal("¡tu registro de encuentra a salvo!");
                }
            });
    })



    $("#btnModCarro").click(function() {
        var idCarro = $(this).attr("idCarro");
        var modelo = $("#txtModModelo").val();
        var dueño = $("#txtModDueño").val();
        var color = $("#txtModColor").val();
        var placa = $("#txtModPlaca").val();
        var imagen = $("#txtModImagen").val();

        var objData = new FormData();
        objData.append("modIdCarro", idCarro);
        objData.append("modModelo", modelo);
        objData.append("modDueño", dueño);
        objData.append("modColor", color);
        objData.append("modPlaca", placa);
        objData.append("modImagen", imagen);
        $.ajax({
            url: "control/vehiculosControl.php",
            type: "post",
            dataType: "json",
            data: objData,
            cache: false,
            contentType: false,
            processData: false,
            success: function(respuesta) {

                $("#modalEditar").modal('toggle');
                cargarDatos();
            }
        })
    })

})