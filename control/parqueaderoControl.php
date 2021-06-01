<?php

include_once "../modelo/parqueaderoModelo.php";

class parqueaderoControl{

public function ctrlCargarVehiculos(){

    $objRespuesta= parqueaderoModelo::mdlConsultarCarros();

    $hola="hola";
    echo json_encode($objRespuesta);



}


}

if(isset($_POST["cargarCarro"])){

    $objCargar = new parqueaderoControl();
    $objCargar->ctrlCargarVehiculos();

}