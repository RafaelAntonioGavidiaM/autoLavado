<?php



require_once "../../modelo/perosnalmodelo.php";

require("../librerias/pdf/fpdf.php");

class PDF extends fpdf{

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
    $rutaImagenColsis = "../../vista/imagenesPersonal/logo autolavado.png";
    $rutaImagenSena = "../../vista/imagenesPersonal/sena.png";
    $rutaImagenQr = "../../vista/imagenesPersonal/codigoQR.png";
    $RutaImagenCarnet = "../../vista/imagenesPersonal/FondocarnetN.jpg";
    $rutaImagenCarnetTrasero = "../../vista/imagenesPersonal/trasera.jpg";


    
    $objPdf->AddPage();
    $objPdf->Image($RutaImagenCarnet, 0, 0, 200, 110);
    $objPdf->Image($rutaImagene . $datos["foto"], 10, null, 25, 25);
    $objPdf->Image($rutaImagenColsis, 140, -1, 50, 50);
    $objPdf->Image($rutaImagenSena, 160, 80, 25, 25);
    $objPdf->ln(8.5);
    $objPdf->SetTextColor(0, 0, 0);
    $objPdf->SetFont('Arial', 'B', 24);
    $objPdf->Cell(40, 10,$datos["nombre"] . ' ' . $datos["apellidos"], "L");
    $objPdf->ln(12);
    $objPdf->SetFont('Arial', 'I', 16);
    $objPdf->Cell(40, 10,'Documento :' . ' ' . $datos["documento"],'L');
    $objPdf->AddPage();
    $objPdf->Image($rutaImagenCarnetTrasero, 0, 0, 200, 110);
    $objPdf->Image($rutaImagenQr, 150, 60, 50, 50);
    $objPdf->SetFont('Arial', 'I', 16);
    $objPdf->Cell(40, 60,'Correo :'.' '.'CarWash@autolavdo.co');
    $objPdf->Ln(6.5);
    $objPdf->SetFont('Arial', 'I', 16);
    $objPdf->Cell(40, 65,'Contacto :'.' '.'7753020-313425678');
    $objPdf->Output();


}
