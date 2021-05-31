<?php

session_start();

    




 if ($_SESSION==null) {
    
    include_once "index.php";
 }else{   

include_once "vista/modulos/cabecera.php";


if (isset($_GET["ruta"])) {
  
    if ($_GET["ruta"]== "parqueadero") {
       
      
    include_once "vista/modulos/".$_GET["ruta"].".php";

   }

}

include_once "vista/modulos/pie.php";
 }









