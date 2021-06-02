<?php

include_once "../modelo/parqueaderoModelo.php";

class parqueaderoControl
{
    public $fecha;
    public $idCarro;
    public $horaEntrada;
    public $horaSalida;
    public $tiempo;
    public $valorPagar;
    public $idPersonal;
    public $idParqueadero;


    public function ctrlCargarVehiculos()
    {

        $objRespuesta = parqueaderoModelo::mdlConsultarCarros();

        $hola = "hola";
        echo json_encode($objRespuesta);
    }

    public function ctrlInsertarParqueo()
    {

        $objRespuesta = parqueaderoModelo::mdlInsertarPaqueadero($this->fecha, $this->idCarro, $this->horaEntrada, $this->horaSalida, $this->tiempo, $this->idPersonal, $this->valorPagar);
        echo json_encode($objRespuesta);
    }

    public function ctrlModificar(){

        $objModificar= parqueaderoModelo::mdlModificar($this->idParqueadero,$this->fecha,$this->idCarro,$this->horaEntrada,$this->horaSalida,$this->tiempo,$this->idPersonal,$this->valorPagar);
        echo json_encode($objModificar);


    }

    public function ctrlCargarTabla()
    {
        $objRespuesta = parqueaderoModelo::mdlConsultarTabla();
        echo json_encode($objRespuesta);
    }

    public function ctrlEliminar(){

        $objEliminar=parqueaderoModelo::mdlEliminar($this->idParqueadero);
        echo json_encode($objEliminar);

    }


}

if (isset($_POST["cargarCarro"])) {

    $objCargar = new parqueaderoControl();
    $objCargar->ctrlCargarVehiculos();
}


if (isset($_POST["horaEntrada"]) && isset($_POST["horaSalida"]) && isset($_POST["tiempo"]) && isset($_POST["valorPagar"])) {

    $objInsertar = new parqueaderoControl();
    $objInsertar->fecha = $_POST["fecha"];
    $objInsertar->idCarro = $_POST["idCarro"];
    $objInsertar->horaEntrada = $_POST["horaEntrada"];
    $objInsertar->horaSalida = $_POST["horaSalida"];
    $objInsertar->tiempo = $_POST["tiempo"];
    $objInsertar->valorPagar = $_POST["valorPagar"];
    session_start();
    $objInsertar->idPersonal = $_SESSION["idusuario"];

    $objInsertar->ctrlInsertarParqueo();
}
if (isset($_POST["cargarTabla"]) == "ok") {

    $objCargarTabla = new parqueaderoControl();
    $objCargarTabla->ctrlCargarTabla();
}

if (isset($_POST["horaEntradaM"]) && isset($_POST["horaSalidaM"]) && isset($_POST["tiempoM"]) && isset($_POST["valorPagarM"])) {

     $objModificar = new parqueaderoControl();
    $objModificar->fecha = $_POST["fechaM"];
    $objModificar->idCarro = $_POST["idCarroM"];
    $objModificar->horaEntrada = $_POST["horaEntradaM"];
    $objModificar->horaSalida = $_POST["horaSalidaM"];
    $objModificar->tiempo = $_POST["tiempoM"];
    $objModificar->valorPagar = $_POST["valorPagarM"];
    session_start();
    $objModificar->idPersonal = $_SESSION["idusuario"];
    $objModificar->idParqueadero=$_POST["idParqueadero"];

    $objModificar->ctrlModificar();
}

if (isset($_POST["idEliminar"])) {

    $objEliminar= new parqueaderoControl();
    $objEliminar->idParqueadero=$_POST["idEliminar"];
    $objEliminar->ctrlEliminar();


   

}
