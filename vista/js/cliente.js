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
                interface += '<td>' + item.apellidos + '</td>';
                interface += '<td>' + item.direccion + '</td>';
                interface += '<td>' + item.telefono + '</td>';
                interface += '<td>' + item.email + '</td>';
                interface += '<td>';
                interface += '<div class="btn-group">';
                interface += '<button type="button" class="btn btn-warning" title="Editar" id="btn-editar" idDueño="' + item.idDueño + '"  documento="' + item.documento + '" nombre="' + item.nombre + '" apellido="' + item.apellidos+ '" direccion="' + item.direccion + '" telefono="' + item.telefono + '" email="' + item.email + '" data-toggle="modal" data-target="#modalEditar"><span class="glyphicon glyphicon-pencil"></span></button>';
                interface += '<button type="button" class="btn btn-danger" title="Eliminar" id="btn-eliminar" idDueño="' + item.idDueño + '"><span class="glyphicon glyphicon-remove"></span></button>';
                interface += '</div>';
                interface += '</td>';
                interface += '</tr>';
              }

              $("#cuerpoTablaCliente").html(interface);
    

            }
       })
   }
    

   $("#tablaCliente").on("click", "#btn-editar",function(){
    var idDueño = $(this).attr("idDueño");
    var documento= $(this).attr("documento");
    var nombre = $(this).attr("nombre");
    var apellido = $(this).attr("apellido");
    var direccion = $(this).attr("direccion");
    var telefono = $(this).attr("telefono");
    var email = $(this).attr("email");

    $("#txtModDocumento").val(documento);
    $("#txtModNombre").val(nombre);
    $("#txtModApellido").val(apellido);
    $("#txtModDireccion").val(direccion);
    $("#txtModTelefono").val(telefono);
    $("#txtModEmail").val(email);
    $("#btnModDueño").attr("idDueño",idDueño);
    
   })

   $("#btnModDueño").click(function(){
      var idDueño =$(this).attr("idDueño");
      var documento = $("#txtModDocumento").val();
      var nombre = $("#txtModNombre").val();
      var apellido = $("#txtModApellido").val();
      var direccion = $("#txtModDireccion").val();
      var telefono = $("#txtModTelefono").val();
      var email = $("#txtModEmail").val();

        var objData = new FormData ();
        objData.append("modIdDueño",idDueño);
        objData.append("modNombre",nombre);
        objData.append("modDocumento",documento);
        objData.append("modApellido",apellido);
        objData.append("modDireccion",direccion);
        objData.append("modTelefono",telefono);
        objData.append("modEmail",email);

        $.ajax({
            url: "control/clienteControl.php",
            type: "post",
            dataType: "json",
            data: objData,
            cache: false,
            contentType: false,
            processData: false,
            success: function(respuesta) {

                $("#modalEditar").modal('toggle')
                cargarDatos();
            }
        })



   })

   $("#tablaCliente").on("click","#btn-eliminar", function() {
       
    var idDueño = $(this).attr("idDueño");

    Swal.fire({
        title: 'Esta seguro de eliminar el registro?',
        text: "Si lo elimina no podra recuperarlo!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si, eliminalo!'
    }).then((result) => {
        if (result.isConfirmed) {

            var objData = new FormData();
            objData.append("idDueño", idDueño);


            $.ajax({
                url: "control/clienteControl.php",
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
                        cargarDatos();



                    } 






                }

            })



        }
    })

})

})