$(document).ready(function() {



    cargarDuenosLavado(1, "");
    cargarDatosTablaLavado();



    function cargarDuenosLavado(opcion, idCarro) {
        var mensaje = "ok";

        var objData = new FormData();

        objData.append("cargarDuenosLavado", mensaje);

        $.ajax({
            url: "control/lavadoControl.php",
            type: "post",
            dataType: "json",
            data: objData,
            cache: false,
            contentType: false,
            processData: false,
            success: function(respuesta) {

                if (opcion == 1) {
                    var concatenar = "";

                    respuesta.forEach(cargarSelectDuenoCarro);

                    function cargarSelectDuenoCarro(item, index) {



                        concatenar += '<option value="' + item.idCarro + '">' + item.modelo + " " + item.placa + " " + item.nombre + " " + item.apellidos + '</option>';

                    }

                    $("#selectLavado").html(concatenar);

                } else if (opcion = 2) {

                    var concatenar = "";
                    var principal = ""

                    respuesta.forEach(cargarSelectDuenoCarro);

                    function cargarSelectDuenoCarro(item, index) {

                        if (item.idCarro == idCarro) {
                            principal = '<option value="' + item.idCarro + '">' + item.modelo + " " + item.placa + " " + item.nombre + " " + item.apellidos + '</option>';
                        } else {
                            concatenar += '<option value="' + item.idCarro + '">' + item.modelo + " " + item.placa + " " + item.nombre + " " + item.apellidos + '</option>';



                        }





                    }

                    $("#selectLavadoMod").html(principal + concatenar);


                }





            }
        })




    }


    $("#btnGuardarLavado").click(function() {


        var fecha = $("#fechaLavado").val();
        var idCarro = $("#selectLavado").val();
        var valorPagar = "8000";

        var objData = new FormData();

        objData.append("fechaLavado", fecha);
        objData.append("idCarro", idCarro);
        objData.append("valorPagar", valorPagar);

        $.ajax({
            url: "control/lavadoControl.php",
            type: "post",
            dataType: "json",
            data: objData,
            cache: false,
            contentType: false,
            processData: false,
            success: function(respuesta) {
                alert(respuesta);
                cargarDatosTablaLavado();





            }
        })





    })

    var idLavadoModificar = "";

    $("#tablaCarrosLavado").on("click", "#modLavado", function() {

        idLavadoModificar = $(this).attr("idLavado");
        var fechaMod = $(this).attr("fecha");
        var carro = $(this).attr("idCarro");



        $("#fechaLavadoMod").val(fechaMod);
        cargarDuenosLavado(2, carro);








    })


    $("#btnModificarLavado").click(function() {


        fecha = $("#fechaLavadoMod").val();
        carro = $("#selectLavadoMod").val();

        var objData = new FormData();
        objData.append("fechaMod", fecha);
        objData.append("carroMod", carro);
        objData.append("idLavadoMod", idLavadoModificar);

        $.ajax({
            url: "control/lavadoControl.php",
            type: "post",
            dataType: "json",
            data: objData,
            cache: false,
            contentType: false,
            processData: false,
            success: function(respuesta) {

                alert(respuesta);
                cargarDatosTablaLavado();











            }
        })







    })

    function cargarDatosTablaLavado() {
        var mensaje = "cargarDatos";

        var objData = new FormData();

        objData.append("cargarTablaLavado", mensaje);

        $.ajax({
            url: "control/lavadoControl.php",
            type: "post",
            dataType: "json",
            data: objData,
            cache: false,
            contentType: false,
            processData: false,
            success: function(respuesta) {

                var interface = "";

                respuesta.forEach(cargarDatosSegunTabla);

                var gratuito = '<td> + < a href = "#" data-toggle = "tooltip" title = "El auto ya cuenta con el lavado Gratis y Polichado!">Gratuito</a> +</td >';

                function cargarDatosSegunTabla(item, index) {

                    interface += '<tr>';
                    interface += '<td>' + item.fecha + '</td>';
                    interface += '<td>' + item.modelo + " " + item.placa + '</td>';
                    interface += '<td>' + item.nombre + " " + item.apellidos + '</td>';

                    if (item.valorPagar == 0 || item.valorPagar == "0") {
                        interface += '<td>' + '<button  type="button" class="btn btn-info"  >Servicio Gratuito </button>' + '</td>';

                    } else {
                        interface += '<td>' + "$" + item.valorPagar + '</td>';
                    }
                    interface += '<td>';

                    interface += '<button id="modLavado" type="button" class="btn btn-success" idLavado="' + item.idlavado + '" fecha="' + item.fecha + '" idCarro="' + item.idCarro + '"  idPersonal="' + item.idPersonal + '" valorPagar="' + item.valorPagar + '" data-toggle="modal" data-target="#modalLavadoMod" ><span class="glyphicon glyphicon-pencil"></span></button>';
                    interface += '<button id="eliminarLavado" idLavado="' + item.idlavado + '" type="button" class="btn btn-danger"  ><span class="glyphicon glyphicon-minus"></span></button>';
                    interface += '<button id="FacturaLavado" type="button" class="btn btn-danger" idLavado="' + item.idlavado + '" >Factura</button>';
                    interface += '</td>';




                    interface += '</tr>';








                }
                //alert(interface);

                $("#cuerpoTablaCarrosLavado").html(interface);













            }
        })






    }

    $("#tablaCarrosLavado").on("click", "#FacturaLavado", function() {

        var idlavado = $(this).attr("idLavado");
        window.open("vista/informes/facturaLavado.php?idlavado=" + idlavado, "_blank");





    })







    $("#tablaCarrosLavado").on("click", "#eliminarLavado", function() {


        Swal.fire({
            title: '¿Estas Seguro?',
            text: "No podras revertir los cambios",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Si, Eliminar Registro!'
        }).then((result) => {
            if (result.isConfirmed) {
                var idEliminar = $(this).attr("idLavado");
                alert(idEliminar);

                var objData = new FormData();
                objData.append("idEliminar", idEliminar);

                $.ajax({
                    url: "control/lavadoControl.php",
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
                            cargarDatosTablaLavado();

                        } else {
                            alert(respuesta);
                        }












                    }
                })






            }
        })



    })









})