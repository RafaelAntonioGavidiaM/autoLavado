<?php

require_once "../../modelo/lavadoModelo.php";

require("../librerias/pdf/fpdf.php");

class facturaLavado extends FPDF{

    public $idLavado;

    public function cargarDatosLavado()
    {
        $objRespuesta = lavadoModelo::mdlCargarTablaId($this->idLavado);
        return $objRespuesta;
    }


}

if (isset($_GET["idlavado"])) {

    $objCargarDatos = new facturaLavado('L', 'mm', array(110, 90));
    $objCargarDatos->idLavado = $_GET["idlavado"];
    $datos = $objCargarDatos->cargarDatosLavado();
    
    $objCargarDatos->AddPage();
    $objCargarDatos->SetFont('Arial', 'B', 16);
    $objCargarDatos->SetFont('Arial', 'B', 16);
    
    $objCargarDatos->Cell(0,0,'AutoLavado',0,0,'C');
    $objCargarDatos->Ln(5.5);
    $objCargarDatos->Cell(0,0,'Factura Lavado',0,0,'C');
    $objCargarDatos->Ln(5.5);
    $objCargarDatos->Ln(5.5);
    $objCargarDatos->SetFont('Arial', '', 10);
    $objCargarDatos->Cell(0,0,"Fecha: ".$datos["fecha"],0,0,'R');
    $objCargarDatos->Ln(5.5);
    $objCargarDatos->Cell(0,0,"Vehiculo: ".$datos["modelo"]." ".$datos["placa"],0,0,);
    $objCargarDatos->Ln(5.5);
    $objCargarDatos->Cell(0,0,"Atendido Por: ".$datos["nombre"]." ".$datos["apellidos"],0,0,);
    $objCargarDatos->Ln(5.5);
    $objCargarDatos->Ln(5.5);
    $objCargarDatos->Ln(5.5);

    if($datos["valorPagar"]==0){
        $objCargarDatos->SetFont('Arial', 'B', 17);
    $objCargarDatos->Cell(0,0,"..Promocion Especial..",0,0,'C');
    $objCargarDatos->Ln(5.5);
    $objCargarDatos->Ln(5.5);
    $objCargarDatos->SetFont('Arial', 'I', 15);
    $objCargarDatos->Cell(0,0,"Lavada y Polichada. Gratuitas",0,0,'C');

    }else{

    $objCargarDatos->SetFont('Arial', 'I', 15);
    $objCargarDatos->Cell(0,0,"______________________________",0,0,'C');
    $objCargarDatos->Ln(5.5);
    $objCargarDatos->Cell(0,0,"Valor a Pagar:  $".$datos["valorPagar"],0,0,'C');
    }


    
    $objCargarDatos->Output();
}