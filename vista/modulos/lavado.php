<!DOCTYPE html>
<html>
<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Page Title</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel='stylesheet' type='text/css' media='screen' href='main.css'>
    <script src='main.js'></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>
<div class="container">
  <h2>Lavadero</h2>
  <p>Registrar carros para el servicio de lavado</p>

  <!-- Trigger the modal with a button -->
  <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#modalParqueaderoReg">Registro</button>

  <!-- Modal -->
  <div id="modalParqueaderoReg" class="modal fade" role="dialog">
    <div class="modal-dialog">

      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Registro Lavadero</h4>
        </div>
        <div class="modal-body">
        <label> Fecha:</label>
          <input type="date" class="form-control" id="fecha">
          <label> Carro:</label>
          <input type="text" class="form-control" id="txtCarro">
          </select>
          <label> Valor a pagar:</label>
          <input type="text" class="form-control" id="txtValor">
          </div>
  </div>


  </div>

          <div class="col-lg-6">
  <h2>Carros registrados</h2>
             
  <table id="tablaCarros" class="table table-hover">
    <thead>
      <tr>
        <th>Carro</th>
        <th>Fecha</th>
        <th>Valor</th>
        <th>Acciones</th>
      </tr>
    </thead>
    <tbody id="cuerpoTablaCarros">
      
    </tbody>
  </table>
        


    
</body>
</html>