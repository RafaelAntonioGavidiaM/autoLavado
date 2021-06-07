<?php

include_once "../modelo/vehiculosModelo.php";

class vehiculosControl{
    public $modelo;
    public $dueño;
    public $color;
    public $placa;
    public $imagen;
    public $idCarro;
    public $imagenAntigua;

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

    public function ctrlCargarDuenos(){

        $objRespuesta=VehiculosModelo::mdlCargarDuenos();
        echo json_encode($objRespuesta);

    }
    public function ctrModCarro_1(){

        $objRespuesta =  vehiculosModelo::mdlModificarSinCambioImagen($this->idCarro,$this->modelo,$this->dueño,$this->color,$this->placa,$this->imagen);
        echo json_encode($objRespuesta);

    }
    public function ctrModCarro_2(){

        $objRespuesta = vehiculosModelo::mdlModificarConCambioImagen($this->idCarro,$this->modelo,$this->dueño,$this->color,$this->placa,$this->imagen,$this->imagenAntigua);
        echo json_encode($objRespuesta);

    }

}

if (isset($_POST["modelo"]) && isset($_POST["dueño"]) && isset($_POST["color"]) && isset($_POST["placa"])){
    $ObjVehiculos = new vehiculosControl();
    $ObjVehiculos->modelo = $_POST["modelo"];
    $ObjVehiculos->dueño = $_POST["dueño"];
    $ObjVehiculos->color = $_POST["color"];
    $ObjVehiculos->placa = $_POST["placa"];
    $ObjVehiculos->imagen = $_FILES["imagen"];
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

if (isset($_POST["eliminarId"]) && isset($_POST["deleteImagen"])){
    $objRespuesta = new vehiculosControl();
    $objRespuesta->idCarro = $_POST["eliminarId"];
    $objDeletePersonal->imagen = $_POST["deleteImagen"];
    $objRespuesta->ctrEliminar();
}

if (isset($_POST["cargarDueno"])) {
    $objRespuesta = new vehiculosControl();
    $objRespuesta->ctrlCargarDuenos();
}

if ( isset($_POST["opcion3"]) == "imagenNormal") {
    
    $ObjModCarro=  new vehiculosControl();
    $ObjModCarro->idPersonal = $_POST["idModCarro"];   
    $ObjModCarro->modelo = $_POST["modModelo"];
    $ObjModCarro->dueño = $_POST["modDueño"];
    $ObjModCarro->color = $_POST["modColor"];
    $ObjModCarro->placa = $_POST["modPlaca"];
    $ObjModCarro->imagen = $_POST["modImagen"];
    $ObjModCarro-> ctrModCarro_1();
}

if ( isset($_POST["opcion4"]) == "imagenArray"){

    $ObjModCarro =  new vehiculosControl();
    $ObjModCarro->idCarro = $_POST["idModCarro"];   
    $ObjModCarro->modelo = $_POST["modModelo"];
    $ObjModCarro->dueño = $_POST["modDueño"];
    $ObjModCarro->color = $_POST["modColor"];
    $ObjModCarro->placa = $_POST["modPlaca"];
    $ObjModCarro->imagen = $_FILES["modImagen"];
    $ObjModCarro->ImagenAntigua = $_POST["ImagenAnterior"];
    $ObjModCarro-> ctrModCarro_2();
}