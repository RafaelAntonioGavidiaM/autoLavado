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

    $objCargarDatos = new pdf('L', 'mm', array(110, 90));
    $objCargarDatos->idParqueadero = $_GET["idParqueadero"];

    $datos = $objCargarDatos->cargarDatosParqueo();
    $objCargarDatos->AddPage();
    $objCargarDatos->SetFont('Arial', 'B', 16);
    
    $objCargarDatos->Cell(0,0,'AutoLavado',0,0,'C');
    $objCargarDatos->Ln(5.5);
    $objCargarDatos->Cell(0,0,'Factura Parqueo',0,0,'C');
    $objCargarDatos->Ln(5.5);
    $objCargarDatos->Ln(5.5);
    
    
    

    $objCargarDatos->SetFont('Arial', '', 10);
    $objCargarDatos->Cell(0,0,"Fecha: ".$datos["fecha"],0,0,'R');
    $objCargarDatos->Ln(5.5);
    

    $objCargarDatos->Cell(0,0,"Vehiculo: ".$datos["modelo"]." ".$datos["placa"],0,0,);
    $objCargarDatos->Ln(5.5);
    $objCargarDatos->Cell(0,0,"Hora Entrada: ".$datos["horaEntrada"],0,0,);
    $objCargarDatos->Ln(5.5);
    $objCargarDatos->Cell(0,0,"Hora Salida: ".$datos["horaSalida"],0,0,);
    $objCargarDatos->Ln(5.5);
    $objCargarDatos->Cell(0,0,"Tiempo total:  ".$datos["tiempo"],0,0,);
    $objCargarDatos->Ln(5.5);
    $objCargarDatos->Ln(5.5);
   
    $objCargarDatos->SetFont('Arial', 'I', 15);
    $objCargarDatos->Cell(0,0,"______________________________",0,0,'C');
    $objCargarDatos->Ln(5.5);
    $objCargarDatos->Cell(0,0,"Valor a Pagar:  $".$datos["valorPagar"],0,0,'C');






    $objCargarDatos->Output();
}
