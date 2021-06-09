<?php

require_once "../../modelo/informeCarroModelo.php";
require_once "../../modelo/lavadoModelo.php";

require("../librerias/pdf/fpdf.php");

class informeVehiculos extends FPDF
{

    public $idCarro;


    public function mdlCargarDatosVehiculos()
    {

        $objRespuesta = informeCarroModelo::mdlConsultar($this->idCarro);
        return $objRespuesta;
    }

    public function mdlCargarPromociones()
    {

        $objRespuesta = lavadoModelo::mdlCargarTablaInformePorCarroPromocion($this->idCarro);
        return $objRespuesta;
    }

    public function mdlCargarLavados()
    {

        $objRespuesta = lavadoModelo::mdlCargarTablaInformePorCarro($this->idCarro);
        return $objRespuesta;
    }

    

    public function cargarDatosPromocion($array)
    {

        $retorno = array();

        foreach ($array as $key => $value) {
            $retorno[] = array($value["fecha"], $value["nombre"] . " " . $value["apellidos"]);
        }
        return $retorno;
    }

    public function cargarDatosSinPromocion($array)
    {
        $retorno = array();

        foreach ($array as $key => $value) {
            $retorno[] = array($value["fecha"], $value["nombre"] . " " . $value["apellidos"], "$" . $value["valorPagar"]);
        }
        return $retorno;
    }

    function TablaSinPromocion($header, $data)
    {
        // Cabecera
        foreach ($header as $col)
            $this->Cell(40, 7, $col, 1);
        $this->Ln();
        // Datos
        foreach ($data as $row) {
            foreach ($row as $col)
                $this->Cell(40, 6, $col, 1);
            $this->Ln();
        }
    }

    function TablaPromocion($header, $data)
    {
        // Cabecera
        foreach ($header as $col)
            $this->Cell(40, 7, $col, 1);
        $this->Ln();
        // Datos
        foreach ($data as $row) {
            foreach ($row as $col)
                $this->Cell(40, 6, $col, 1);
            $this->Ln();
        }
    }
}

if (isset($_GET["idCarro"])) {
    $objDatos = new informeVehiculos();
    $objDatos->idCarro = $_GET["idCarro"];
    $datosCarro = $objDatos->mdlCargarDatosVehiculos();


    $rutaImagen = "../../";



    $objDatos->AddPage();
    $objDatos->SetFont('Arial', 'B', 20);
   
    $objDatos->Cell(200,0,"Informe Lavado Vehiculo", 0, 0, "C");

    $objDatos->Ln(5.6);
    $objDatos->Ln(5.6);
    $objDatos->Ln(5.6);
    $objDatos->Ln(5.6);
    




    $objDatos->Image($rutaImagen . $datosCarro["imagen"], 10, NULL, 50, 50);
    $objDatos->Ln(5.6);
    
    $objDatos->SetFont('Arial', 'B', 14);
   
    $objDatos->Cell(74,15,"|"."Modelo: ". $datosCarro["modelo"], 0, 0, "C");
    $objDatos->Ln(5.6);
    $objDatos->Cell(53,15,"|"."Placa: ".$datosCarro["placa"], 0, 0, "C");
    $objDatos->Ln(5.6);
    $objDatos->Cell(135,15,"|"."Cliente: ".$datosCarro["nombre"] . " " . $datosCarro["apellidos"], 0, 0, "C");
    $objDatos->Ln(5.6);
    $objDatos->Ln(5.6);
    $objDatos->Ln(5.6);




    $headerSinDescuento = array('Fecha', 'Atendido Por ', 'Valor a Pagar');
    $headerConDescuento = array('Fecha', 'Atendido Por ');

    $datosSinPromocion = $objDatos->mdlCargarLavados();
    $datosPromocion = $objDatos->mdlCargarPromociones();

    $dataPromocion = $objDatos->cargarDatosPromocion($datosPromocion);
    $data = $objDatos->cargarDatosSinPromocion($datosSinPromocion);
    $objDatos->SetFont('Arial', 'B', 18);
    $objDatos->Cell(90, 0);

    $objDatos->Cell(20, 10, "Lavado Sin Descuentos ", 0, 0, "C");
    $objDatos->Ln(5.6);
    $objDatos->Ln(5.6);
    $objDatos->Ln(5.6);
   

    $objDatos->SetFont('Arial', 'I', 12);
    $objDatos->TablaSinPromocion($headerSinDescuento, $data);
    $objDatos->Ln(5.6);
    $objDatos->Ln(5.6);
    $objDatos->Ln(5.6);
    $objDatos->SetFont('Arial', 'B', 18);
    $objDatos->Cell(90, 0);
    $objDatos->Cell(20, 10, "Lavado Sin Descuentos ", 0, 0, "C");
    $objDatos->Ln(5.6);
    $objDatos->Ln(5.6);
    $objDatos->Ln(5.6);
    

    $objDatos->SetFont('Arial', '', 12);
    $objDatos->TablaPromocion($headerConDescuento, $dataPromocion);

    $objDatos->Output();
}
