<div class="container">
  <h2>Lavadero</h2>
  <p>Registrar carros para el servicio de lavado</p>

  <!-- Trigger the modal with a button -->
  <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#modalLavadoReg">Registro</button>

  <!-- Modal -->
  <div id="modalLavadoReg" class="modal fade" role="dialog">
    <div class="modal-dialog">

      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Lavado</h4>
        </div>
        <div class="modal-body">

          <label> Fecha:</label>
          <input type="date" class="form-control" id="fechaLavado">
          <label> Carro:</label>
          <select class="form-control" id="selectLavado">

          


          </select>
          










        </div>
        <div class="modal-footer">
          <button id="btnGuardarLavado" type="button" class="btn btn-default" data-dismiss="modal">Guardar Lavado</button>
        </div>
      </div>

    </div>
  </div>



  <!-- Trigger the modal with a button -->
 

  <!-- Modal Modificar -->
  <div id="modalLavadoMod" class="modal fade" role="dialog">
    <div class="modal-dialog">

      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Modificar Registro</h4>
        </div>
        <div class="modal-body">

          <label> Fecha:</label>
          <input type="date" class="form-control" id="fechaLavadoMod">
          <label> Carro:</label>
          <select class="form-control" id="selectLavadoMod">

          


          </select>
          
          










        </div>
        <div class="modal-footer">
          <button id="btnModificarLavado" type="button" class="btn btn-default" data-dismiss="modal">Guardar Lavado</button>
        </div>
      </div>

    </div>
  </div>








  <h2>Carros registrados</h2>

  <table id="tablaCarrosLavado" class="table table-hover">
    <thead>
      <tr>
        <th>Fecha</th>
        <th>Carro</th>
        <th>Personal</th>
        <th>Valor a Pagar</th>
        <th>Acciones</th>

      </tr>
    </thead>
    <tbody id="cuerpoTablaCarrosLavado">
 

    </tbody>
  </table>