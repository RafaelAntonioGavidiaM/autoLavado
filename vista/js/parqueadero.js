$(document).ready(function() {

    cargarCarro();





    // $("#btnParqueadero").click(function() {

    function cargarCarro() {


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







                concatenar = "";



                respuesta.forEach(cargarSelect);

                function cargarSelect(item, index) {

                    concatenar += '<option value="' + item.idCarro + '">' + item.modelo + " " + item.placa + " " + item.nombre + " " + item.apellidos + '</option>';


                }



                $("#cars").html(concatenar);














            }

        })





    }




    $("#btnGuardar").click(function() {

        var fecha = $("#fecha").val();
        var idCarro = $("#cars").val();
        var horaEntrada = $("#Entrada").val().split(":"); //sacamos el int
        var horaSalida = $("#Salida").val().split(":");

        //var objData = new FormData();
        //objData.append()


        var hora = horaSalida[0] - horaEntrada[0];
        var minutosSalida = parseInt(horaSalida[1]);
        var minutosEntrada = parseInt(horaEntrada[1]);

        var totalMinutos = minutosEntrada + minutosSalida;

        if (totalMinutos == 60 || totalMinutos > 59) { //valida los minutos

            var horasMinutos = parseInt(totalMinutos / 60);
            var minutosSobrantes = parseInt(totalMinutos % 60);
            hora += horasMinutos;

            var minutosdelasHoras = parseInt(hora) * 60;
            alert(minutosdelasHoras);

            var todoslosMinutos = minutosdelasHoras + minutosSobrantes;

            valoraPagarParqueo = todoslosMinutos * 25;


            alert("El tiempo que paso el vehiculo fue de " + " " + hora + ":" + minutosSobrantes + "Valor a Pagar " + valoraPagarParqueo);


        } else {
            alert("El tiempo que paso el vehiculo fue de " + " " + hora + ":" + totalMinutos);
        }







        //alert(fecha + " " + idCarro + " " + horaEntrada + " " + horaSalida + "" + valorPagar);

        /*
          $.ajax({
              url: "control/parqueaderoControl.php",
              type: "post",
              dataType: "json",
              data: objData,
              cache: false,
              contentType: false,
              processData: false,
              success: function(respuesta) {


              }

          })*/








    })








})