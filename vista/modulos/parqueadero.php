<div class="container">

  <div id="blanco">
    <h2>Parqueadero</h2>
    <p>Registre los autos que ingresaron al servicio de Parqueadero.</p>
    <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#modalParqueaderoReg">Nuevo Registro</button>
    <table id="tablaPrincipal" class="table">
    <thead>
      <tr>
        <th>Fecha</th>
        <th>Vehiculo</th>
        <th>Hora Entrada</th>
        <th>Hora Salida</th>
        <th>Tiempo</th>
        <th>Atendido Por</th>
        <th>Valor a Pagar</th>
        <th>Acciones</th>

      </tr>
    </thead>
    <tbody id="tablaParqueadero">


    </tbody>
  </table>
  </div>
</div>

<!-- Trigger the modal with a button -->


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
        <label> Hora Entrada:</label>
        <input type="time" class="form-control" id="Entrada">
        <label> Hora Salida:</label>
        <input type="time" class="form-control" id="Salida">


















      </div>
      <div class="modal-footer">
        <button id="btnGuardarParqueadero" type="button" class="btn btn-primary" data-dismiss="modal">Guardar Registro</button>
      </div>
    </div>

  </div>
</div>


<!-- Modal -->
<div id="modalParqueaderoMod" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Modificar Registro</h4>
      </div>
      <div class="modal-body">
        <label> Fecha:</label>
        <input type="date" class="form-control" id="fechaMod">
        <label> Vehiculo</label>
        <select class="form-control" id="carsMod">

          <p id="cargar"></p>
        </select>
        <label> Hora Entrada:</label>
        <input type="time" class="form-control" id="EntradaMod">
        <label> Hora Salida:</label>
        <input type="time" class="form-control" id="SalidaMod">


















      </div>
      <div class="modal-footer">
        <button id="btnModificar" type="button" class="btn btn-primary" data-dismiss="modal">Modificar Registro</button>
      </div>
    </div>

  </div>
</div>






  
</div>
