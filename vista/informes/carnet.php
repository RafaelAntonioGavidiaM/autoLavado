<?php



require_once "../../modelo/perosnalmodelo.php";

require("../librerias/pdf/fpdf.php");

class PDF extends FPDF
{

    public $idPersonal;

    public function cargarDatos()
    {
        $objRespuesta = PersonalModelo::mdlBuscarPersonal($this->idPersonal);
        return $objRespuesta;
    }
}

if (isset($_GET["personal"])) {


    $objPdf = new PDF('L', 'mm', array(200, 110));
    $objPdf->idPersonal = $_GET["personal"];
    $datos = $objPdf->cargarDatos();

    $rutaImagene = "../../";
    $rutaImagenColsis = "../../vista/imagenesPersonal/colsis_logotipo.png";
    $rutaImagenSena = "../../vista/imagenesPersonal/sena.png";
    $rutaImagenQr = "../../vista/imagenesPersonal/qr.jpg";
    $RutaImagenCarnet = "../../vista/imagenesPersonal/fondoCarnet.jpg";

    
    $objPdf->AddPage();
    $objPdf->Image($RutaImagenCarnet, 0, 0, 200, 110);
    $objPdf->Image($rutaImagene . $datos["foto"], 90, null, 25, 25);
    $objPdf->Image($rutaImagenColsis, 12, -1, 35, 35);
    $objPdf->Image($rutaImagenSena, 160, 10, 25, 25);
    $objPdf->Image($rutaImagenQr, 160, 70, 35, 35);
    $objPdf->ln(6.5);
    $objPdf->SetTextColor(255, 255, 255);
    $objPdf->SetFont('Arial', 'B', 24);
    $objPdf->Cell(40, 10, $datos["nombre"] . ' ' . $datos["apellidos"], "L");
    $objPdf->ln(12);
    $objPdf->SetFont('Arial', 'I', 16);
    $objPdf->Cell(40, 10, 'Documento :' . ' ' . $datos["documento"]);
    $objPdf->ln(6.5);
    $objPdf->Output();

}
