$(document).ready(function() {

    cargarCarro(1, "");
    cargarTabla();


    function cargarTabla() {

        var cargarTabla = "ok";

        var objData = new FormData();

        objData.append("cargarTabla", cargarTabla);

        $.ajax({
            url: "control/parqueaderoControl.php",
            type: "post",
            dataType: "json",
            data: objData,
            cache: false,
            contentType: false,
            processData: false,
            success: function(respuesta) {

                var concatenar = "";

                respuesta.forEach(concatenarTabla);

                function concatenarTabla(item, index) {
                    var caracteristicas = "";
                    caracteristicas = item.modelo + " " + item.placa + " " + item.nombreDueño + " " + item.apellidosDueño;

                    concatenar += '<tr>';
                    concatenar += '<td>' + item.fecha + '</td>';
                    concatenar += '<td>' + item.modelo + " " + item.placa + '</td>';
                    concatenar += '<td>' + item.horaEntrada + '</td>';
                    concatenar += '<td>' + item.horaSalida + '</td>';
                    concatenar += '<td>' + item.tiempo + '</td>';
                    concatenar += '<td>' + item.nombre + " " + item.apellidos + '</td>';
                    concatenar += '<td>' + "$" + item.valorPagar + '</td>';
                    concatenar += '<td><div class="btn-group">';
                    concatenar += '<button id="modParqueo" type="button" class="btn btn-success" nombreDueño="' + item.nombreDueño + '" apellidosDueño="' + item.apellidosDueño + '" idParqueadero="' + item.idParqueadero + '" fecha="' + item.fecha + '" idCarro="' + item.idCarro + '" caracteristicas="' + caracteristicas + '" horaEntrada="' + item.horaEntrada + '" horaSalida="' + item.horaSalida + '" tiempo="' + item.tiempo + '" valorPagar="' + item.valorPagar + '" data-toggle="modal" data-target="#modalParqueaderoMod" ><span class="glyphicon glyphicon-pencil"></span></button>';
                    concatenar += '<button id="eliminarParqueo" type="button" class="btn btn-danger" idParqueadero="' + item.idParqueadero + '" ><span class="glyphicon glyphicon-minus"></span></button>';
                    concatenar += '<button id="Factura" type="button" class="btn btn-danger" idParqueadero="' + item.idParqueadero + '" >Factura</button>';
                    concatenar += '</td>';
                    concatenar += '</tr>';







                }



                $("#tablaParqueadero").html(concatenar);


            }

        })



    }


    idParqueadero = "";

    $("#tablaPrincipal").on("click", "#modParqueo", function() {

        // alert("hola");
        idParqueadero = $(this).attr("idParqueadero");
        var fecha = $(this).attr("fecha");
        var caracteristicas = $(this).attr("caracteristicas");
        var horaEntrada = $(this).attr("horaEntrada");
        var horaSalida = $(this).attr("horaSalida");
        var idCarro = $(this).attr("idCarro");

        $("#fechaMod").val(fecha);
        $("#EntradaMod").val(horaEntrada);
        $("#SalidaMod").val(horaSalida);

        var principal = '<option value="' + idCarro + '">' + caracteristicas + '</option>';

        cargarCarro(2, principal);


    })

    $("#tablaPrincipal").on("click", "#Factura", function() {

        var idParqueadero = $(this).attr("idParqueadero");
        window.open("vista/informes/facturaParqueadero.php?idParqueadero=" + idParqueadero, "_blank");






    })



    $("#tablaPrincipal").on("click", "#eliminarParqueo", function() {

        var idEliminar = $(this).attr("idParqueadero");

        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {

                var objData = new FormData();
                objData.append("idEliminar", idEliminar);


                $.ajax({
                    url: "control/parqueaderoControl.php",
                    type: "post",
                    dataType: "json",
                    data: objData,
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: function(respuesta) {
                        if (respuesta == "ok") {
                            Swal.fire(
                                'Eliminado!',
                                'El registro ha sido eliminado.',
                                'success'
                            )
                            cargarTabla();



                        } else {

                            alert(respuesta);


                        }






                    }

                })



            }
        })






    })


    $("#btnModificar").click(function() {


        var fecha = $("#fechaMod").val();
        var idCarro = $("#carsMod").val();

        var horaEntrada = $("#EntradaMod").val().split(":"); //sacamos el int

        var horaSalida = $("#SalidaMod").val().split(":");

        if (fecha == "" || horaEntrada[0] == null || horaSalida[0] == null) {
            Swal.fire({
                icon: 'error',
                title: 'Nulos',
                text: 'Hay cajas Nulas!',

            })



        } else if (parseInt(horaEntrada[0]) > parseInt(horaSalida[0])) {
            Swal.fire({
                icon: 'error',
                title: 'Eror Datos',
                text: 'Hora Entrada mayor que hora Salida!',

            })

        } else {

            var horaEnt = horaEntrada[0];
            var horaSal = horaSalida[0];
            var minutoEntrada = horaEntrada[1];
            var minutoSalida = horaSalida[1];
            var tiempo = "";

            var totalMinutosHorasE = (parseInt(horaEnt) * 60) + parseInt(minutoEntrada);
            var totalMinutosHorasSal = (parseInt(horaSal) * 60) + parseInt(minutoSalida);

            var totalMinutos = parseInt(totalMinutosHorasSal - totalMinutosHorasE);


            var horas = 0;
            var minutosRestante = 0;

            if (totalMinutos > 59) {


                horas = parseInt(totalMinutos / 60);


                minutosRestante = parseInt(totalMinutos % 60);


                if (parseInt(horas) < 10 && parseInt(minutosRestante) > 9) {


                    tiempo = "0" + horas + ":" + minutosRestante;



                } else if (parseInt(horas) < 10 && parseInt(minutosRestante) < 10) {

                    tiempo = "0" + horas + ":" + "0" + minutosRestante;
                } else if (horas > 9 && minutosRestante < 10) {
                    tiempo = horas + ":0" + minutosRestante;

                }


            } else {
                if (parseInt(totalMinutos) < 10) {
                    tiempo = "00:0" + totalMinutos;

                } else {
                    tiempo = "00:" + totalMinutos;
                }


            }

            var ValorPagar = "";



            var tiempoTotal = tiempo.split(":");
            if (tiempoTotal[1] > 0) {
                ValorPagar = (parseFloat(tiempoTotal[0]) * 1500) + 1500;


            } else {
                ValorPagar = parseFloat(tiempoTotal[0]) * 1500;


            }







            var objData = new FormData();
            objData.append("fechaM", fecha);
            objData.append("idCarroM", idCarro);
            var HoraEntrada = horaEntrada[0] + ":" + horaEntrada[1];
            var HoraSalida = horaSalida[0] + ":" + horaSalida[1];




            objData.append("horaEntradaM", HoraEntrada);
            objData.append("horaSalidaM", HoraSalida);
            objData.append("tiempoM", tiempo);
            objData.append("valorPagarM", ValorPagar);
            objData.append("idParqueadero", idParqueadero);

            $.ajax({
                url: "control/parqueaderoControl.php",
                type: "post",
                dataType: "json",
                data: objData,
                cache: false,
                contentType: false,
                processData: false,
                success: function(respuesta) {

                    if (respuesta == "ok") {



                        Swal.fire({
                            position: 'top-end',
                            icon: 'success',
                            title: 'Se realizo el registro Exitosamente',
                            showConfirmButton: false,
                            timer: 1500
                        })
                        cargarTabla();
                    } else {

                        alert(respuesta);
                    }





                }

            })

        }








    })





    // $("#btnParqueadero").click(function() {

    function cargarCarro(opcion, caracteristicas) {


        var mensaje = "selectCars";

        var objData = new FormData();

        objData.append("cargarCarro", mensaje);

        $.ajax({
            url: "control/parqueaderoControl.php",
            type: "post",
            dataType: "json",
            data: objData,
            cache: false,
            contentType: false,
            processData: false,
            success: function(respuesta) {



                if (opcion == 1 && caracteristicas == "") {
                    concatenar = "";



                    respuesta.forEach(cargarSelect);

                    function cargarSelect(item, index) {

                        concatenar += '<option value="' + item.idCarro + '">' + item.modelo + " " + item.placa + " " + item.nombre + " " + item.apellidos + '</option>';


                    }



                    $("#cars").html(concatenar);
                } else if (opcion == 2) {

                    concatenar = "";





                    respuesta.forEach(cargarSelect);

                    function cargarSelect(item, index) {
                        var comprobar = "";

                        comprobar = '<option value="' + item.idCarro + '">' + item.modelo + " " + item.placa + " " + item.nombre + " " + item.apellidos + '</option>';

                        if (comprobar != caracteristicas) {
                            concatenar += '<option value="' + item.idCarro + '">' + item.modelo + " " + item.placa + " " + item.nombre + " " + item.apellidos + '</option>';
                        }







                    }

                    $("#carsMod").html(caracteristicas + concatenar);




                }




















            }

        })





    }




    $("#btnGuardarParqueadero").click(function() {



        var fecha = $("#fecha").val();
        var idCarro = $("#cars").val();

        var horaEntrada = $("#Entrada").val().split(":"); //sacamos el int

        var horaSalida = $("#Salida").val().split(":");

        if (fecha == "" || horaEntrada[0] == null || horaSalida[0] == null) {
            Swal.fire({
                icon: 'error',
                title: 'Nulos',
                text: 'Hay cajas Nulas!',

            })



        } else if (parseInt(horaEntrada[0]) > parseInt(horaSalida[0])) {
            Swal.fire({
                icon: 'error',
                title: 'Eror Datos',
                text: 'Hora Entrada mayor que hora Salida!',

            })

        } else {

            var horaEnt = horaEntrada[0];
            var horaSal = horaSalida[0];
            var minutoEntrada = horaEntrada[1];
            var minutoSalida = horaSalida[1];
            var tiempo = "";

            var totalMinutosHorasE = (parseInt(horaEnt) * 60) + parseInt(minutoEntrada);
            var totalMinutosHorasSal = (parseInt(horaSal) * 60) + parseInt(minutoSalida);

            var totalMinutos = parseInt(totalMinutosHorasSal - totalMinutosHorasE);


            var horas = 0;
            var minutosRestante = 0;

            if (totalMinutos > 59) {


                horas = parseInt(totalMinutos / 60);


                minutosRestante = parseInt(totalMinutos % 60);


                if (parseInt(horas) < 10 && parseInt(minutosRestante) > 9) {


                    tiempo = "0" + horas + ":" + minutosRestante;



                } else if (parseInt(horas) < 10 && parseInt(minutosRestante) < 10) {

                    tiempo = "0" + horas + ":" + "0" + minutosRestante;
                } else if (horas > 9 && minutosRestante < 10) {
                    tiempo = horas + ":0" + minutosRestante;

                }


            } else {
                if (parseInt(totalMinutos) < 10) {
                    tiempo = "00:0" + totalMinutos;

                } else {
                    tiempo = "00:" + totalMinutos;
                }


            }

            var ValorPagar = "";


            var tiempoTotal = tiempo.split(":");
            if (tiempoTotal[1] > 0) {
                ValorPagar = (parseFloat(tiempoTotal[0]) * 1500) + 1500;


            } else {
                ValorPagar = parseFloat(tiempoTotal[0]) * 1500;


            }







            var objData = new FormData();
            objData.append("fecha", fecha);
            objData.append("idCarro", idCarro);
            var HoraEntrada = horaEntrada[0] + ":" + horaEntrada[1];
            var HoraSalida = horaSalida[0] + ":" + horaSalida[1];



            objData.append("horaEntrada", HoraEntrada);
            objData.append("horaSalida", HoraSalida);
            objData.append("tiempo", tiempo);
            objData.append("valorPagar", ValorPagar);

            $.ajax({
                url: "control/parqueaderoControl.php",
                type: "post",
                dataType: "json",
                data: objData,
                cache: false,
                contentType: false,
                processData: false,
                success: function(respuesta) {

                    if (respuesta == "ok") {



                        Swal.fire({
                            position: 'top-end',
                            icon: 'success',
                            title: 'Se realizo el registro Exitosamente',
                            showConfirmButton: false,
                            timer: 1500
                        })
                        cargarTabla()
                    } else {

                        alert(respuesta);
                    }





                }

            })















        }




















    })








})