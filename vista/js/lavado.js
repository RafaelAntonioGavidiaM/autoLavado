$(document).ready(function() {
    
    cargarDatos();

    $("#btnRegistrar").click(function(){

        var  fecha= $("#fecha").val();
        var  carro= $("#txtCarro").val();
        var  valor= $("#txtValor").val();
       
        
        
        var objData = new FormData();

        objData.append("fecha",fecha);
        objData.append("carro",carro);
        objData.append("valor",valor);
        

        $.ajax({
            url: "control/lavadoControl.php",
            type: "post",
            dataType: "json",
            data: objData,
            cache: false,
            contentType: false,
            processData: false,
            success: function(respuesta) {
                cargarDatos();
            }
        })

    })

  function cargarDatos(){

    var listaCliente ="ok";
    var objListarCliente = new FormData();
    objListarCliente.append("listaCarros", listaCarros);

    $.ajax({
        url: "control/clienteControl.php",
        type: "post",
        dataType: "json",
        data: objListarCliente,
        cache: false,
        contentType: false,
        processData: false,
        success: function(respuesta) {

            var interface='';
            respuesta.forEach(cargarTablaCarros);


            
            function cargarTablaCarros(item, index) {
                interface += '<tr>';

                interface += '<td>' + item.fecha + '</td>';
                interface += '<td>' + item.carro + '</td>';
                interface += '<td>' + item.valor + '</td>';
                interface += '<td>' + item.direccion + '</td>';
                interface += '<td>';
                interface += '<div class="btn-group">';
                interface += '<button type="button" class="btn btn-warning" title="Editar" id="btn-editar" idCarro="' + item.idCarro + '"  fecha="' + item.fecha + '" valor="' + item.valor data-toggle="modal" data-target="#modalEditar"><span class="glyphicon glyphicon-pencil"></span></button>';
                interface += '<button type="button" class="btn btn-danger" title="Eliminar" id="btn-eliminar" idCarro="' + item.idCarro + '"><span class="glyphicon glyphicon-remove"></span></button>';
                interface += '</div>';
                interface += '</td>';
                interface += '</tr>';
              }

              $("#cuerpoTablaCarros").html(interface);
    

        }
    })


  }



})