<div class="container">
    <h2>Usuarios</h2>
    <div class="container">
        <!---boton de registro--->
        <button id="btnNewPersonal" type="button" class="btn btn-success" title="Registrar Nuevo usuario" data-toggle="modal" data-target="#ventanaRegPersonal">👷💾Registrar Personal</button>
    </div>

    <!----tabla de personal----->
    <table id="tablaPersonal" class="table">
        <thead>
            <tr>
                <th>Documento</th>
                <th>Nombres</th>
                <th>Apellidos</th>
                <th>Foto</th>
                <th>Contraseña</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody id="bodyPersonal">
        </tbody>
    </table>
</div>

</div>

<!---modal de registro de personal------>

<!-- Modal -->
<div class="modal fade" id="ventanaRegPersonal" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">

                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title text-center">👷Registro Personal</h4>

            </div>

            <!---text box de registro de personal ----->
            <div class="modal-body">

                <form action="" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="txtRegDocumento">Documento:</label>
                        <input type="text" class="form-control" id="txtRegDocumento">
                    </div>
                    <div class="form-group">
                        <label for="txtRegNombres">Nombres:</label>
                        <input type="text" class="form-control" id="txtRegNombres">
                    </div>
                    <div class="form-group">
                        <label for="txtRegApellidos">Apellidos:</label>
                        <input type="text" class="form-control" id="txtRegApellidos">
                    </div>
                    <div class="form-group">
                        <label for="txtFoto">Fotografia:</label>
                        <input type="file" class="form-control" id="txtFoto">
                    </div>
                    <div class="form-group">
                        <label for="txtRegContraseña">Contraseña</label>
                        <input type="text" class="form-control" id="txtRegContraseña">
                    </div>
                    <div class="modal-footer">
                        <button id="btnRegPersonal" type="button" class="btn btn-success" data-dismiss="modal">💾</button>
                    </div>

            </div>

        </div>
    </div>

</div>    
<!---modal de modificar personal------>

<!-- Modal -->
<div class="modal fade" id="ventanaModPersonal" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">

                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title text-center">👷Modificar Personal</h4>

            </div>

            <!---text box de modificar de personal ----->
            <div class="modal-body">

                <form action="">
                    <div class="form-group">
                        <label for="txtModDocumento">Documento:</label>
                        <input type="text" class="form-control" id="txtModDocumento">
                    </div>
                    <div class="form-group">
                        <label for="txtModNombres">Nombres:</label>
                        <input type="text" class="form-control" id="txtModNombres">
                    </div>
                    <div class="form-group">
                        <label for="txtModApellidos">Apellidos:</label>
                        <input type="text" class="form-control" id="txtModApellidos">
                    </div>
                    <div class="form-group">
                        <label for="txtModFoto">Fotografia:</label>
                        <img src="" id="modFoto">
                        <input type="file" class="form-control" id="txtModFoto">
                    </div>
                    <div class="form-group">
                        <label for="txtModContraseña">Contraseña</label>
                        <input type="text" class="form-control" id="txtModContraseña">
                    </div>
                    <div class="modal-footer">
                        <button id="btnModPersonal" type="button" class="btn btn-success" data-dismiss="modal">Modificar</button>
                    </div>

            </div>

        </div>
    </div>
</div>