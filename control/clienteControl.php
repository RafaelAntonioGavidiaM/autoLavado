<?php 

include_once "../modelo/clienteModelo.php";

class clienteControl {

    public $idDueño;
    public $documento;
    public $nombre;
    public $apellido;
    public $direccion;
    public $telefono;
    public $email;
    


    public function ctrInsertar(){

        $objRespuesta = clienteModelo:: mdlInsertar($this->documento,$this->nombre,$this->apellido,$this->direccion,$this->telefono,$this->email);
        echo json_encode ($objRespuesta);

    }
    public function ctrListarTodos(){
        $objRespuesta= clienteModelo::mdlListarTodos();
        echo json_encode($objRespuesta);

    }

    public function ctrEditar(){
       $objRespuesta = clienteModelo:: mdlEditar ($this->idDueño, $this->documento,$this->nombre,$this->apellido,$this->direccion,$this->telefono,$this->email);
        echo json_encode($objRespuesta);
    }

    public function ctrEliminar(){

        $objRespuesta = clienteModelo::mdlEliminar($this -> idDueño);
        echo json_encode ($objRespuesta);
    }




}

if (isset($_POST["documento"]) && isset($_POST["nombre"]) && isset($_POST["apellido"]) && isset($_POST["direccion"]) && isset($_POST["telefono"]) && isset($_POST["email"])){

    $objCliente = new clienteControl();
    $objCliente-> documento = $_POST["documento"];
    $objCliente ->nombre =$_POST["nombre"];
    $objCliente ->apellido =$_POST["apellido"];
    $objCliente ->direccion =$_POST["direccion"];
    $objCliente ->telefono =$_POST["telefono"];
    $objCliente ->email =$_POST["email"];
    $objCliente ->ctrInsertar();

}

if (isset($_POST["listaCliente"]) == "ok"){
    $ObjListarCliente = new clienteControl();
    $ObjListarCliente->ctrListarTodos();
 }


if (isset($_POST["modIdDueño"]) && isset($_POST["modDocumento"]) && isset($_POST["modNombre"]) &&  isset($_POST["modApellido"]) && isset($_POST["modDireccion"]) && isset($_POST["modTelefono"]) && isset($_POST["modEmail"])){

     $objModCliente = new clienteControl();
     $objModCliente-> idDueño = $_POST["modIdDueño"];
     $objModCliente-> documento = $_POST["modDocumento"];
     $objModCliente-> nombre = $_POST["modNombre"];
     $objModCliente-> apellido = $_POST["modApellido"];
     $objModCliente-> direccion = $_POST["modDireccion"];
     $objModCliente-> telefono = $_POST["modTelefono"];
     $objModCliente-> email = $_POST["modEmail"];
     $objModCliente -> ctrEditar();


}

if (isset($_POST["idDueño"])){
     $objEliminarCliente = new clienteControl();
     $objEliminarCliente ->idDueño=$_POST["idDueño"];
     $objEliminarCliente->ctrEliminar();

}