<?php




include_once "vista/modulos/cabecera.php";


if (isset($_GET["ruta"])) {
    
    if ($_GET["ruta"] == "personal" || $_GET["ruta"] = "clientes" || $_GET["registro"] == "registroVehiculos"
    || $_GET["ruta"] == "parqueadero" || $_GET["lavado"]) {
        

        include_once "vista/modulos/".$_GET["ruta"].".php";
    }
}

include_once "vista/modulos/pie.php";







