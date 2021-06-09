<div class="container">
  <label id="tituloInforme">
    <h2> Seleccione el informe a consultar:</h2>
  </label>
</div>
<br>


<div class="container">
  <div class="row">
    <div class="col-lg-6">
    <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal">Informe Lavado</button>
    <button id="btnInformeConceptos" type="button" class="btn btn-primary btn-lg">Informe Conceptos</button>
    </div>
    <div class="col-lg-6">
    
    </div>
  </div>
</div>
<!-- Trigger the modal with a button -->



<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Informe por Vehiculo</h4>
      </div>
      <div class="modal-body">

        <label> Seleccione un Vehiculo</label>
        <select class="form-control" id="cars">

          <p id="cargar"></p>
        </select>


      </div>
      <div class="modal-footer">
        <button id="consultarVehiculo" type="button" class="btn btn-primary" data-dismiss="modal">Consultar</button>
      </div>
    </div>

  </div>
</div>