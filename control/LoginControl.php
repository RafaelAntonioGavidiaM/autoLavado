<?php

include_once "../modelo/loginModelo.php";

class loginControl{

    public $usuario;
    public $contraseña;

    public function ctrlLoguear(){

        $objRespuesta= loginModelo::mdlLoguear($this->usuario,$this->contraseña);
        
        if($objRespuesta==false){

            $registro="No";
            echo json_encode($registro);
        }else{
        $id=$objRespuesta[0];

        echo json_encode($id);

            
        }
        
        
        




    }






}

if(isset($_POST["usuario"])&& isset($_POST["contraseña"])){

    $objLogin = new loginControl();
    $objLogin->usuario=$_POST["usuario"];
    $objLogin->contraseña=$_POST["contraseña"];
    $objLogin->ctrlLoguear();
 


}