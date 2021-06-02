<?php

require_once "../../modelo/parqueaderoModelo.php";

require("../librerias/pdf/fpdf.php");

class pdf extends FPDF
{
    public $idParqueadero;

    public function cargarDatosParqueo()
    {

        $objRespuesta = parqueaderoModelo::mdlConsultarFactura($this->idParqueadero);
        return $objRespuesta;
    }
}

if (isset($_GET["idParqueadero"])) {

    $objCargarDatos = new pdf('L', 'mm', array(100, 200));
    $objCargarDatos->idParqueadero = $_GET["idParqueadero"];

    $datos = $objCargarDatos->cargarDatosParqueo();
    $objCargarDatos->AddPage();
    $objCargarDatos->SetFont('Arial', 'B', 16);
    $objCargarDatos->Cell(40, 10, '¡Hola, Mundo!');
    $objCargarDatos->Output();
}
