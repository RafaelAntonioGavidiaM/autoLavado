<?php

include_once "../modelo/vehiculosModelo.php";

class vehiculosControl{
    public $modelo;
    public $dueño;
    public $color;
    public $placa;
    public $imagen;
    public $idCarro;

    public function ctrInsertar(){
        $ObjRespuesta = vehiculosModelo::mdlInsertar($this->modelo,$this->dueño,$this->color,$this->placa,$this->imagen);
        echo json_encode($ObjRespuesta);
    }

    public function ctrModificar(){
        $ObjRespuesta = vehiculosModelo::mdlModificar($this->idCarro,$this->modelo,$this->dueño,$this->color,$this->placa,$this->imagen);
        echo json_encode($ObjRespuesta);
    }

    public function ctrEliminar(){
        $objRespuesta = vehiculosModelo::mdlEliminar($this->idcarro);
        echo json_encode($objRespuesta);
    }

    public function ctrListarTodos(){
        $ObjRespuesta = vehiculosModelo::mdlListarTodos();
        echo json_encode($ObjRespuesta);
    }

}

if (isset($_POST["modelo"]) && isset($_POST["dueño"]) && isset($_POST["color"]) && isset($_POST["placa"]) && isset($_POST["imagen"])){
    $ObjVehiculos = new vehiculosControl();
    $ObjVehiculos->modelo = $_POST["modelo"];
    $ObjVehiculos->dueño = $_POST["dueño"];
    $ObjVehiculos->color = $_POST["color"];
    $ObjVehiculos->placa = $_POST["placa"];
    $ObjVehiculos->imagen = $_POST["imagen"];
    $ObjVehiculos->ctrInsertar();
}

if (isset($_POST["listaVehiculos"]) == "ok"){
    $ObjListarVehiculos = new vehiculosControl();
    $ObjListarVehiculos->ctrListarTodos();
 }

 if (isset($_POST["modIdCarro"]) && isset($_POST["modModelo"]) && isset($_POST["modDueño"]) && isset($_POST["modColor"])  && isset($_POST["modPlaca"]) && isset($_POST["modImagen"])){
    $ObjModCarro = new vehiculosControl();
    $$ObjModCarro->idCarro = $_POST["modIdCarro"];
    $$ObjModCarro->modelo = $_POST["modModelo"];
    $$ObjModCarro->dueño = $_POST["modDueño"];
    $$ObjModCarro->color = $_POST["modColor"];
    $$ObjModCarro->placa = $_POST["modPlaca"];
    $$ObjModCarro->imagen = $_POST["modImagen"];
    $$ObjModCarro->ctrModificar();
}

if (isset($_POST["eliminarId"])){
    $objRespuesta = new vehiculosControl();
    $objRespuesta->idCarro = $_POST["eliminarId"];
    $objRespuesta->ctrEliminar();
}