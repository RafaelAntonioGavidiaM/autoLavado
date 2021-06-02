<div class="container">
    <div class="row">
        <div class="col-lg-12 ">

        </div>
    </div>

    <br>
    <div class="row">
        <div class="col-lg-4">
            <form action="" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="txtModelo">Modelo:</label>
                    <input type="text" class="form-control" id="txtModelo">
                </div>

                <div class="form-group">
                    <label for="txtDueño">Dueño:</label>
                    <select class="form-control" id="duenoSelect">

                    

                        <p id="cargar"></p>
                    </select>
                </div>

                <div class="form-group">
                    <label for="txtColor">Color:</label>
                    <input type="text" class="form-control" id="txtColor">
                </div>

                <div class="form-group">
                    <label for="txtPlaca">Placa:</label>
                    <input type="text" class="form-control" id="txtPlaca">
                </div>

                <div class="form-group">
                    <label for="txtImagen">Imagen:</label>
                    <input type="file" class="form-control" id="txtImagen">
                </div>

                <button id="btnGuardarVehiculo" type="button" class="btn btn-primary">Guardar</button>

            </form>
            <br>
        </div>

        <div class="col-lg-8">
            <center>
                <h2>Registro Autos</h2>
                <center>
                    <p>Organice informacion sobre registro de Autos</p>
                    <br>

                    <table id="tablaUsuarios" class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Modelo</th>
                                <th>Dueño</th>
                                <th>Color</th>
                                <th>Placa</th>
                                <th>Imagen</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>

                        <tbody id="cuerpoTablacarro">

                        </tbody>
                    </table>
        </div>
    </div>


    <!-- Modal -->
    <div class="modal fade" id="modalEditar" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Modificar Autos</h4>
                </div>

                <div class="modal-body">
                    <form action="">
                        <div class="form-group">
                            <label for="txtModModelo">Modelo:</label>
                            <input type="text" class="form-control" id="txtModModelo">
                        </div>

                        <div class="form-group">
                            <label for="txtModDueño">Dueño:</label>
                            <input type="text" class="form-control" id="txtModDueño">
                        </div>

                        <div class="form-group">
                            <label for="txtModColor">Color:</label>
                            <input type="text" class="form-control" id="txtModColor">
                        </div>

                        <div class="form-group">
                            <label for="txtModPlaca">Placa:</label>
                            <input type="text" class="form-control" id="txtModPlaca">
                        </div>

                        <div class="form-group">
                            <label for="txtModImagen">Imagen:</label>
                            <input type="file" class="form-control" id="txtModImagen">
                        </div>
                    </form>
                </div>

                <div class="modal-footer">
                    <button id="btnModCarro" idCarro="" type="button" class="btn btn-primary">Modificar</button>
                </div>
            </div>

        </div>
    </div>

</div>