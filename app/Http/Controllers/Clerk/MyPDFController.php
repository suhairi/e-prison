<?php namespace App\Http\Controllers\Clerk;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use Anouar\Fpdf\Fpdf as basePDF;
use Anouar\Fpdf\Fpdf;

class MyPDFController extends Controller {

	public function Footer() {

        $this->setY(-15);

        $this->SetFont('Arial', 'I', 8);

        $this->Cell(0, 10, 'Page ' . $this->PageNo(). '/{nb}', 0, 0, 'C');
    }

	public function index()
	{
        $pdf= new Fpdf('L','mm','A4');
        $pdf->AliasNbPages();
        $pdf->SetTitle("My First PDF");
        $pdf->AddPage();
        $pdf->SetFont('helvetica','',7);
        $pdf->SetXY(20,20);
        $pdf->Cell(15,100,"Hello World",1,0,'C');
        // Send to browser
        $pdf->Output("helloworld.pdf","D");
        exit;
	}


}
