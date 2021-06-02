<div class="container">

 <div class="row">
     <div class="col-lg-4">
  
           <h2>Registrar cliente</h2>
           <form action="">
                   <div class="form-group">
                       <label for="documento">Documento:</label>
                       <input type="text" class="form-control" id="txtDocumento" >
                   </div>
                   <div class="form-group">
                       <label for="nombre">Nombre:</label>
                       <input type="text" class="form-control" id="txtNombre" >
                   </div>
                   <div class="form-group">
                         <label for="apellido">Apellido:</label>
                         <input type="text" class="form-control" id="txtApellido" >
                   </div>
                   <div class="form-group">
                       <label for="direccion">Direccion:</label>
                       <input type="text" class="form-control" id="txtDireccion" >
                   </div>
                   <div class="form-group">
                       <label for="telefono">Telefono:</label>
                       <input type="text" class="form-control" id="txtTelefono" >
                   </div>
                   <div class="form-group">
                       <label for="email">Email:</label>
                       <input type="text" class="form-control" id="txtEmail" >
                   </div>
    
                 <button  id="btnRegistrar" type="button" class="btn btn-primary">Registrar</button>
            </form>
       </div>

          <div class="col-lg-8">
                <h2>Clientes registrados</h2>
             
                   <table id="tablaCliente" class="table table-hover">
                      <thead>
                       <tr>
                             <th>Documento</th>
                             <th>Nombre</th>
                             <th>Apellido</th>
                             <th>Direccion</th>
                             <th>Telefono</th>
                             <th>Email</th>
                             <th>Acciones</th>
                       </tr>
                      </thead>
                        <tbody id="cuerpoTablaCliente">
      
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
                       <h4 class="modal-title">Modificar cliente</h4>
                   </div>

                   <div class="modal-body">
                       <form action="">
                           <div class="form-group">
                               <label for="txtModDocumento">Documento:</label>
                               <input type="text" class="form-control" id="txtModDocumento">
                           </div>

                           <div class="form-group">
                               <label for="txtModNombre">Nombre:</label>
                               <input type="text" class="form-control" id="txtModNombre">
                           </div>

                           <div class="form-group">
                               <label for="txtModApellido">Apellido:</label>
                               <input type="text" class="form-control" id="txtModApellido">
                           </div>

                           <div class="form-group">
                               <label for="txtModDireccion">Direccion:</label>
                               <input type="text" class="form-control" id="txtModDireccion">
                           </div>

                           <div class="form-group">
                               <label for="txtModTelefono">Telefono:</label>
                               <input type="text" class="form-control" id="txtModTelefono">
                           </div>

                           <div class="form-group">
                               <label for="txtModEmail">Email:</label>
                               <input type="text" class="form-control" id="txtModEmail">
                           </div>
                       </form>
                   </div>

                   <div class="modal-footer">
                       <button id="btnModDueño" idDueño="" type="button" class="btn btn-primary">Editar</button>
         </div>
   </div>
 
</div>