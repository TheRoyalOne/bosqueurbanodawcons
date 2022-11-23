<?php
tcpdf();

class MYPDF extends TCPDF 
{

    //Page header
    public function Header() {
        // Logo
        

        //$image_file = K_PATH_IMAGES.'';
        $image_file = base_url()."/imagenes/extralogocolor.png";
        $this->Image($image_file, 80, 5, 55, '', 'PNG', '', 'T', false, 300, '', false, false, 0, false, false, false);
        // Set font
        $this->SetFont('helvetica', 'B', 20);
        // Title
//        $this->Cell(0, 15, '<< TCPDF Example 003 >>', 0, false, 'C', 0, '', 0, false, 'M', 'M');
    }

    // Page footer
    public function Footer() {
		$this->SetTextColor(50,95,50);
        // Position at 15 mm from bottom
        $this->SetY(-15);
        // Set font
        $this->SetFont('helvetica', 'I', 8);
        // Page number
        $this->Cell(50, 0, 'Reporte Evento de Adopcion', 0, false, 'C', 0, '', 0, false, 'T', 'M');
        $this->Cell(100, 0,  date('d-m-Y H:i:s',time()), 0, false, 'C', 0, '', 0, false, 'T', 'M');
        $this->Cell(50, 0, ' '.$this->getAliasNumPage().'/'.$this->getAliasNbPages(), 0, false, 'C', 0, '', 0, false, 'T', 'M');
    }
}



$obj_pdf = new MYPDF('P', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
$obj_pdf->SetPrintHeader(true);



$obj_pdf->SetMargins(PDF_MARGIN_LEFT, 12, PDF_MARGIN_RIGHT);
$obj_pdf->SetFont('helvetica', '', 9);
$obj_pdf->AddPage();
ob_start();
	include('/plantilla.php');
    $content = ob_get_contents();    
//die("");
ob_end_clean();

$obj_pdf->writeHTML(utf8_encode($content), true, false, true, false, '');
$obj_pdf->Output('output.pdf', 'I');
?>
