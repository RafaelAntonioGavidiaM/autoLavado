<?php

include_once "../modelo/perosnalmodelo.php";
class personalControl{

    public $idPersonal;
    public $documento;
    public $nombre;
    public $apellidos;
    public $foto;
    public $contraseña;
    public $fotoAntigua;

    public function ctrListarPersonal(){

        $objRespuesta = PersonalModelo::mdlListarPersonal();
        echo json_encode($objRespuesta);

    }

    public function ctrRegPersonal(){

        $objRespuesta = PersonalModelo::mdlRegPersonal($this->documento,$this->nombre,$this->apellidos,$this->foto,$this->contraseña);
        echo json_encode($objRespuesta);


    }

    public function ctrModPersonal_1(){




    }

    public function ctrModPersonal_2(){

        


    }

    public function ctrDeletePersonal(){

        $objRespuesta = PersonalModelo::mdlEliminarPersonal($this->idPersonal,$this->foto);
        echo json_encode($objRespuesta);

    }

}

if (isset($_POST["listaPersonal"])== "ok") {
    
    $objlistaPersonal = new personalControl();
    $objlistaPersonal->ctrListarPersonal();
}

if (isset($_POST["documento"])  && isset($_POST["nombre"])  && isset($_POST["apellidos"]) && isset($_POST["contraseña"])) {
    
    $objRegPersonal =  new personalControl();
    $objRegPersonal->documento = $_POST["documento"];
    $objRegPersonal->nombre = $_POST["nombre"];
    $objRegPersonal->apellidos = $_POST["apellidos"];
    $objRegPersonal->foto = $_FILES["foto"];
    $objRegPersonal->contraseña = $_POST["contraseña"];
    $objRegPersonal->ctrRegPersonal();

}


if (isset($_POST["idDeletePersonal"]) && isset($_POST["deleteFoto"])) {
    
    $objDeletePersonal =  new personalControl();
    $objDeletePersonal->idPersonal = $_POST["idDeletePersonal"];
    $objDeletePersonal->foto = $_POST["deleteFoto"];
    $objDeletePersonal-> ctrDeletePersonal();

}


if ( isset($_POST["opcion1"]) == "fotoNormal") {
    
    $objModPersonal =  new personalControl();
    $objModPersonal->idPersonal = $_POST["idModPersonal"];   
    $objModPersonal->documento = $_POST["modDocumento"];
    $objModPersonal->nombre = $_POST["modNombre"];
    $objModPersonal->apellidos = $_POST["modApellidos"];
    $objModPersonal->foto = $_POST["modFoto"];
    $objModPersonal->contraseña = $_POST["modContraseña"];
    $objModPersonal-> ctrModPersonal_1();
    
}

if ( isset($_POST["opcion2"]) == "fotoArray"){

    $objModPersonal =  new personalControl();
    $objModPersonal->idPersonal = $_POST["idModPersonal"];   
    $objModPersonal->documento = $_POST["modDocumento"];
    $objModPersonal->nombre = $_POST["modNombre"];
    $objModPersonal->apellidos = $_POST["modApellidos"];
    $objModPersonal->foto = $_FILES["modFoto"];
    $objModPersonal->fotoAntigua = $_POST["fotoAnterior"];
    $objModPersonal->contraseña = $_POST["modContraseña"];
    $objModPersonal-> ctrModPersonal_2();
}


