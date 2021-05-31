$(document).ready(function() {
    
    cargarDatos();

    $("#btnRegistrar").click(function(){

        var documento = $("#txtDocumento").val();
        var nombre = $("#txtNombre").val();
        var apellido = $("#txtApellido").val();
        var direccion = $("#txtDireccion").val();
        var telefono =$("#txtTelefono").val();
        var email = $ ("#txtEmail").val();
        
        
        var objData = new FormData();

        objData.append("documento",documento);
        objData.append("nombre",nombre);
        objData.append("apellido",apellido);
        objData.append("direccion",direccion);
        objData.append("telefono",telefono);
        objData.append("email",email);

        $.ajax({
            url: "control/clienteControl.php",
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
    objListarCliente.append("listaCliente", listaCliente);

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
            respuesta.forEach(cargarTablaCliente);


            
            function cargarTablaCliente(item, index) {
                interface += '<tr>';

                interface += '<td>' + item.documento + '</td>';
                interface += '<td>' + item.nombre + '</td>';
                interface += '<td>' + item.apellido + '</td>';
                interface += '<td>' + item.direccion + '</td>';
                interface += '<td>' + item.telefono + '</td>';
                interface += '<td>' + item.email + '</td>';
                interface += '<td>';
                interface += '<div class="btn-group">';
                interface += '<button type="button" class="btn btn-warning" title="Editar" id="btn-editar" idCliente="' + item.idCliente + '"  documento="' + item.documento + '" nombre="' + item.nombre + '" apellido="' + item.apellido + '" direccion="' + item.direccion + '" telefono="' + item.telefono + '" email="' + item.email + '" data-toggle="modal" data-target="#modalEditar"><span class="glyphicon glyphicon-pencil"></span></button>';
                interface += '<button type="button" class="btn btn-danger" title="Eliminar" id="btn-eliminar" idCliente="' + item.idCliente + '"><span class="glyphicon glyphicon-remove"></span></button>';
                interface += '</div>';
                interface += '</td>';
                interface += '</tr>';
              }

              $("#cuerpoTablaCliente").html(interface);
    

        }
    })


  }



})