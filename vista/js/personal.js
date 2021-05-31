$(document).ready(function () {

    listaPersonal();

    function listaPersonal() {

        var listaPersonal = "ok";
        var objListarPersonal = new FormData()
        objListarPersonal.append("listaPersonal", listaPersonal);

        $.ajax({
            url: "control/personalControl.php",
            type: "post",
            dataType: "json",
            data: objListarPersonal,
            cache: false,
            contentType: false,
            processData: false,
            success: function (respuesta) {

                console.log(respuesta)
                var interface = "";
                respuesta.forEach(listaPersonal)

                function listaPersonal(item, index) {

                    interface += '<tr>';
                    interface += '<td>' + item.documento + '</td>';
                    interface += '<td>' + item.nombre + '</td>';
                    interface += '<td>' + item.apellidos + '</td>';
                    interface += '<td><img src="' + item.foto + '" high="40" width="40"></td>';
                    interface += '<td>' + item.contraseña + '</td>';
                    interface += '<td>'
                    interface += '<div class = "btn-group">'
                    interface += '<button type="button" class="btn btn-warning" title="Editar"  id="btnEditarPersonal" idPersonal="' + item.idPersonal + '" documento="' + item.documento + '" nombre="' + item.nombre + '" apellidos="' + item.apellidos + '" foto="' + item.foto + '" contraseña="' + item.contraseña + '" data-toggle="modal" data-target="#ventanaModPersonal"><span class="glyphicon glyphicon-pencil"></span></button>'
                    interface += '<button type="button" class="btn btn-danger" title ="Eliminar" id="btnEliminarPersonal" idPersonal="' + item.idPersonal + '" foto="' + item.foto + '"><span class="glyphicon glyphicon-remove"></span></button>';
                    interface += '<button type="button" class="btn btn-info" title ="PDF" id="btnPdf" idUsuario="' + item.idUsuario + '" url="' + item.url + '"><span class="glyphicon glyphicon-pencil"></span></button>';
                    interface += '</tr>';

                }

                $("#bodyPersonal").html(interface);


            }
        })


    }

    $("#btnRegPersonal").click(function () {

        var docuemnto = $("#txtRegDocumento").val();
        var nombre = $("#txtRegNombres").val();
        var apellidos = $("#txtRegApellidos").val();
        var foto = document.getElementById("txtFoto").files[0];
        var contraseña = $("#txtRegContraseña").val();

        var objData = new FormData();
        objData.append("documento", docuemnto);
        objData.append("nombre", nombre);
        objData.append("apellidos", apellidos);
        objData.append("foto", foto);
        objData.append("contraseña", contraseña);


        $.ajax({

            url: "control/personalControl.php",
            type: "post",
            dataType: "json",
            data: objData,
            cache: false,
            contentType: false,
            processData: false,
            success: function (respuesta) {

                Swal.fire({
                    position: 'top-end',
                    icon: 'success',
                    title: 'Registro Exitoso',
                    showConfirmButton: false,
                    timer: 1500
                })
                listaPersonal();
            }
        })


    })

    var idPersonal = "";

    $("#tablaPersonal").on("click", "#btnEditarPersonal", function () {

        idPersonal = $(this).attr("idPersonal");
        var docuemnto = $(this).attr("documento");
        var nombre = $(this).attr("nombre");
        var apellidos = $(this).attr("apellidos");
        var foto = $(this).attr("foto");
        var contraseña = $(this).attr("contraseña")

        $("#btnModPersonal").attr("idPersonal", idPersonal);
        $("#txtModDocumento").val(docuemnto);
        $("#txtModNombres").val(nombre);
        $("#txtModApellidos").val(apellidos);
        $("#txtModFoto").val(foto);
        $("#txtModContraseña").val(contraseña);



    })

    $("#btnModPersonal").click(function () {

        var docuemnto = $("#txtModDocumento").val();
        var nombre = $("#txtModNombres").val();
        var apellidos = $("#txtModApellidos").val();
        var foto = document.getElementById("txtModFoto").files[0];
        var contraseña = $("#txtModContraseña").val();

        var objData = new FormData();
        objData.append("idModPersonal", idPersonal);
        objData.append("modDocumento", docuemnto);
        objData.append("modNombre", nombre);
        objData.append("modApellidos", apellidos);
        objData.append("modFoto", foto);
        objData.append("modContraseña", contraseña);


        $.ajax({

            url: "control/personalControl.php",
            type: "post",
            dataType: "json",
            data: objData,
            cache: false,
            contentType: false,
            processData: false,
            success: function (respuesta) {

                Swal.fire({
                    position: 'top-end',
                    icon: 'success',
                    title: 'Registro Exitoso',
                    showConfirmButton: false,
                    timer: 1500
                })
                listaPersonal();
            }
        })


    })

    $("#tablaPersonal").on("click", "#btnEliminarPersonal", function () {

        idPersonal = $(this).attr("idPersonal");
        foto = $(this).attr("foto")

        const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
                confirmButton: 'btn btn-success',
                cancelButton: 'btn btn-danger'
            },
            buttonsStyling: false
        })

        swalWithBootstrapButtons.fire({
            title: 'Estas seguro?',
            text: "no puedes recuperar la informacion despues de ser eleiminada!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Eliminar!',
            cancelButtonText: 'Cancelar!',
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {

                var objData = new FormData();
                objData.append("idDeletePersonal", idPersonal)
                objData.append("deleteFoto", foto)

                $.ajax({

                    url: "control/personalControl.php",
                    type: "post",
                    dataType: "json",
                    data: objData,
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: function (respuesta) {
                        if (respuesta == "ok") {
                            swalWithBootstrapButtons.fire(
                                'Eliminado!',
                                'Registro eliminado exitosamente.',
                                'success'
                            )
                        }
                        listaPersonal();
                    }
                })
            } else if (
                result.dismiss === Swal.DismissReason.cancel
            ) {
                swalWithBootstrapButtons.fire(
                    'Cancelado',
                    'Tu registro se a salvado',
                    'error'
                )
            }
        })



    })




















})