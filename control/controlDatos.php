<?php

include_once "../modelo/loginModelo.php";

class controlDatos{

    public function ctrlCargarDatos(){
        session_start();
      $usuario=$_SESSION["idusuario"];

      $objRespuesta=loginModelo::mdlConsultarUsuarioLogueado($usuario);
      echo json_encode($objRespuesta);




    }




}

if(isset($_POST["cargar"])=="cargar"){
    $objConsultar = new controlDatos();
    $objConsultar->ctrlCargarDatos();



}