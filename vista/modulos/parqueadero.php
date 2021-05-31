<div class="container">
  <h2>Parqueadero</h2>
  <p>Registre los autos que ingresaron al servicio de Parqueadero.</p>

  <!-- Trigger the modal with a button -->
  <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#modalParqueaderoReg">Nuevo Registro</button>

  <!-- Modal -->
  <div id="modalParqueaderoReg" class="modal fade" role="dialog">
    <div class="modal-dialog">

      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Registro Parqueadero</h4>
        </div>
        <div class="modal-body">
        <label> Fecha:</label>
          <input type="date" class="form-control" id="fecha">
          <label> Vehiculo</label>
          <select class="form-control" id="cars">

            <p id="cargar"></p>
          </select>
          <label>  Hora Entrada:</label>
          <input type="time" class="form-control" id="Entrada">
          <label> Hora Salida:</label>
          <input type="time" class="form-control" id="Salida">


















        </div>
        <div class="modal-footer">
          <button id="btnGuardar" type="button" class="btn btn-primary" data-dismiss="modal">Guardar Registro</button>
        </div>
      </div>

    </div>
  </div>






  <table class="table">
    <thead>
      <tr>
        <th>Firstname</th>
        <th>Lastname</th>
        <th>Email</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td>John</td>
        <td>Doe</td>
        <td>john@example.com</td>
      </tr>
      <tr>
        <td>Mary</td>
        <td>Moe</td>
        <td>mary@example.com</td>
      </tr>
      <tr>
        <td>July</td>
        <td>Dooley</td>
        <td>july@example.com</td>
      </tr>
    </tbody>
  </table>
</div>