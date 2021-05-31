<?php 

include_once "../modelo/clienteModelo.php";

class clienteControl {

    public $idDueño
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




}


if (isset($_POST["documento"])&& isset($_POST["nombre"]) && isset($_POST["apellido"])&& isset($_POST["direccion"])&& isset($_POST["telefono"])&& isset($_POST["email"])){

    $objCliente = new clienteControl();
    $objCliente-> documento = $_POST["documento"];
    $objCliente ->nombre =$_POST["nombre"];
    $objCliente ->apellido =$_POST["apellido"];
    $objCliente ->telefono =$_POST["telefono"];
    $objCliente ->direccion =$_POST["direccion"];
    $objCliente ->email =$_POST["email"];
    $objCliente ->ctrInsertar();

}

if(isset($_POST["listaCliente"])=="ok")){

    $objListarCliente= new clienteControl();
    $objListarCliente->ctrListarTodos();
}