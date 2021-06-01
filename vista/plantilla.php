<?php

session_start();






if ($_SESSION == null) {

    include_once "index.php";
} else {

    include_once "vista/modulos/cabecera.php";


    if (isset($_GET["ruta"])) {

        if (
            $_GET["ruta"] == "personal" || $_GET["ruta"] == "parqueadero"
            || $_GET["ruta"] == "cliente"
        ) {


            include_once "vista/modulos/" . $_GET["ruta"] . ".php";
        }
    }

    include_once "vista/modulos/pie.php";
}
