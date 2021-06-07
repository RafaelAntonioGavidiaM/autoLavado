<?php

include_once "../modelo/lavadoModelo.php";
class lavadoControl{

    public $idLavado;
    public $fecha;
    public $idCarro;
    public $idPersonal;
    public $valorPagar;


    public function ctrlCargarDuenos(){
        $objRespuesta= lavadoModelo::mdlCargarDuenos();
        echo json_encode($objRespuesta);





    }

    public function ctrlInsertar(){

        $objRespuesta=lavadoModelo::mdlInsertar($this->fecha,$this->idCarro,$this->idPersonal,$this->valorPagar);
        echo json_encode($objRespuesta);



    }

    public function ctrlConsultarTabla(){

        $objRespuesta=lavadoModelo::mdlCargarTabla();
        echo json_encode($objRespuesta);



    }

    public function ctrlModificarLavado(){

        $objRespuesta=lavadoModelo::mdlModificar($this->idLavado,$this->fecha,$this->idCarro,$this->idPersonal);
        echo json_encode($objRespuesta);


        


    }

    public function ctrlEliminar(){
        $objRespuesta= lavadoModelo::mdlEliminar($this->idLavado);
        echo json_encode($objRespuesta);



    }



}

if (isset($_POST["cargarDuenosLavado"])=="ok") {

    $objCargar = new lavadoControl();
    $objCargar->ctrlCargarDuenos();

  
}

if (isset($_POST["fechaLavado"]) && isset($_POST["idCarro"]) && isset($_POST["valorPagar"]) ) {
    
    $objInsertar = new lavadoControl();
    $objInsertar->fecha=$_POST["fechaLavado"];
    $objInsertar->idCarro=$_POST["idCarro"];
    $objInsertar->valorPagar=$_POST["valorPagar"];
    session_start();
    $objInsertar->idPersonal=$_SESSION["idusuario"];
    $objInsertar->ctrlInsertar();



}

if(isset($_POST["cargarTablaLavado"])=="cargarDatos"){
    
    $objCargarDatos= new lavadoControl();
    $objCargarDatos->ctrlConsultarTabla();


}

if (isset($_POST["fechaMod"]) && isset($_POST["carroMod"]) && isset($_POST["idLavadoMod"]) ) {
   
    $objModificar = new lavadoControl();
    $objModificar->idLavado=$_POST["idLavadoMod"];
    $objModificar->fecha=$_POST["fechaMod"];
    $objModificar->idCarro=$_POST["carroMod"];
    session_start();
    $objModificar->idPersonal=$_SESSION["idusuario"];
    $objModificar->ctrlModificarLavado();



}

if (isset($_POST["idEliminar"])) {
    $objEliminar = new lavadoControl();
    $objEliminar->idLavado=$_POST["idEliminar"];
    $objEliminar->ctrlEliminar();

    
}
