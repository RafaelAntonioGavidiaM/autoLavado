$(document).ready(function() {




    $("#consultarVehiculo").click(function() {
        var idConsultar = $("#cars").val();

        window.open("vista/informes/consultaCarro.php?idCarro=" + idConsultar, "_blank");






    })

    $("#btnInformeConceptos").click(function() {
        var proceso = "ok";

        window.open("vista/informes/informeConceptos.php?proceso=" + proceso, "_blank");






    })






})