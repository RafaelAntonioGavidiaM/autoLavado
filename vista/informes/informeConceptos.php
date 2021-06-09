<?php


require_once "../../modelo/conexion.php";
require_once "../../modelo/lavadoModelo.php";
require_once "../../modelo/parqueaderoModelo.php";
require("../librerias/pdf/fpdf.php");

class informeConceptos extends FPDF
{

    public function mdlConsultarLavado()
    {
        $objRespuesta = conexion::conectar()->prepare("SELECT sum(valorPagar) as Total  from lavado");
        $objRespuesta->execute();

        $data = $objRespuesta->fetchAll();

        $retorno = array();
        foreach ($data as $key => $value) {
            $retorno[] = array("$" . $value["Total"]);
        }
        return $retorno;
    }
    public function mdlConsultarPaqueadero()
    {
        $objRespuesta = conexion::conectar()->prepare("SELECT sum(valorPagar) as Total from parqueadero");
        $objRespuesta->execute();

        $data = $objRespuesta->fetchAll();

        $retorno = array();
        foreach ($data as $key => $value) {
            $retorno[] = array("$" . $value["Total"]);
        }
        return $retorno;
    }

    function BasicTable($header, $data)
    {
        // Cabecera
        foreach ($header as $col)
            $this->Cell(32, 7, $col, 1);
            
        $this->Ln();
        // Datos
        foreach ($data as $row) {
            foreach ($row as $col)
                $this->Cell(32, 6, $col, 1);
            $this->Ln();
        }
    }

    function mdlCargarLavados()
    {
        $objRespuesta = lavadoModelo::mdlCargarTabla();

        $retorno = array();
        foreach ($objRespuesta as $key => $value) {
            $retorno[] = array($value["fecha"],$value["modelo"], $value["placa"], "$" . $value["valorPagar"]);
        }
        return $retorno;
    }

    function mdlCargarParqueo()
    {

        $objRespuesta = parqueaderoModelo::mdlConsultarTabla();

        $retorno = array();
        foreach ($objRespuesta as $key => $value) {
            $retorno[] = array($value["fecha"],$value["modelo"], $value["placa"], $value["horaEntrada"], $value["horaSalida"], $value["tiempo"], "$" . $value["valorPagar"]);
        }
        return $retorno;
    }
}
if (isset($_GET["proceso"])) {

    $objConcepto = new informeConceptos();
    $objConcepto->AddPage('L');
    $objConcepto->SetFont('Arial', 'B', 16);
    $objConcepto->Cell(300, 10, "Informe Por Concepto", 0, 0, "C");
    $objConcepto->Ln(5.6);
    $objConcepto->Ln(5.6);
    $objConcepto->SetFont('Arial', 'B', 14);
    $objConcepto->Cell(300, 10, "Concepto Lavado", 0, 0, "C");
    $objConcepto->Ln(5.6);
    $objConcepto->Ln(5.6);
    $objConcepto->Ln(5.6);
    $objConcepto->Ln(5.6);
    $objConcepto->SetFont('Arial', '', 12);
    
    
    $headerCarrosLavados = array('Fecha', 'Modelo', 'Placa', 'Valor Pagado');
    $datosLavados = $objConcepto->mdlCargarLavados();
    $objConcepto->BasicTable($headerCarrosLavados, $datosLavados);


    $objConcepto->Ln(5.6);
    $headerLavado = array('Total Lavados');
    $dataLvado = $objConcepto->mdlConsultarLavado();
    $objConcepto->BasicTable($headerLavado, $dataLvado);
    $objConcepto->SetFont('Arial', 'B', 14);


    $objConcepto->Cell(300, 10, "Concepto Parqueadero", 0, 0, "C");

    $objConcepto->Ln(5.6);
    $objConcepto->Ln(5.6);
    $objConcepto->Ln(5.6);
    $objConcepto->Ln(5.6);
    $objConcepto->SetFont('Arial', '', 12);
    $headerCarrosParqueadero = array('Fecha','Modelo', 'Placa', 'Hora Entrada', 'Hora Salida', 'Tiempo', 'Valor Pagado');
    $datosCarroParqueo = $objConcepto->mdlCargarParqueo();
    $objConcepto->BasicTable($headerCarrosParqueadero, $datosCarroParqueo);
    $objConcepto->Ln(5.6);


    $headerParqueadero = array('Total Parqueo');
    $dataParqueo = $objConcepto->mdlConsultarPaqueadero();
    $objConcepto->BasicTable($headerParqueadero, $dataParqueo);









    $objConcepto->Output();
}
