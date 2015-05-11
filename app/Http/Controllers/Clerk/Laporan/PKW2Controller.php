<?php namespace App\Http\Controllers\Clerk\Laporan;

use Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Contracts\Auth\Guard;
use Illuminate\Contracts\Auth\Registrar;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;

use Anouar\Fpdf\Fpdf;




class PKW2Controller extends Controller {

    use AuthenticatesAndRegistersUsers;

    protected $redirectPath = 'clerk';


    public function __construct(Guard $auth, Registrar $registrar) {
        $this->registrar = $registrar;
        $this->auth = $auth;

        $this->middleware('auth');
        $this->middleware('userLevelTwo');
    }

    public function generatePKW2() {

        if(\Session::get('noPKW') == null){

            \Session::flash('message', 'Sila buat carian No KP dahulu.');

            return view('clerk/dashboard');
        }

//        dd(\Session::get('noPKWFound'));
//
        // ###############      Settings      #############

        $pdf = new Fpdf('P','mm','A4');
        $pdf->AliasNbPages();
        $pdf->SetTitle("e-Prison - Laporan MT");
        $pdf->SetAuthor('');
        $pdf->SetMargins(10, 10, 7);

        // Halaman 1

        $pdf->AddPage();

        $pdf->SetFont('Arial', '', 8);
        $pdf->SetXY(10, 10);
        $pdf->Cell(195, 5, 'PKW Format 1', 0, 1, 'R');
        $pdf->Ln(5);

        $pdf->SetX(10);
        $pdf->SetFont('Arial', 'B', 18);
        $pdf->Cell(35, 7, 'No Daftar', 0, 0, 'L');
        $pdf->Cell(7, 7, 'P', 1, 0, 'C');
        $pdf->Cell(7, 7, 'K', 1, 0, 'C');
        $pdf->Cell(7, 7, 'W', 1, 0, 'C');
        $pdf->Cell(7, 7, '0', 1, 0, 'C');
        $pdf->Cell(7, 7, '0', 1, 0, 'C');
        $pdf->Cell(7, 7, '0', 1, 0, 'C');
        $pdf->Cell(7, 7, '2', 1, 0, 'C');
        $pdf->Cell(7, 7, '-', 1, 0, 'C');
        $pdf->Cell(7, 7, '1', 1, 0, 'C');
        $pdf->Cell(7, 7, '4', 1, 0, 'C');
        $pdf->Cell(7, 7, '-', 1, 0, 'C');
        $pdf->Cell(7, 7, '0', 1, 0, 'C');
        $pdf->Cell(7, 7, '2', 1, 0, 'C');
        $pdf->Cell(7, 7, '-', 1, 0, 'C');
        $pdf->Cell(7, 7, '0', 1, 0, 'C');
        $pdf->Cell(7, 7, '4', 1, 1, 'C');
        $pdf->Ln(5);

        $pdf->SetX(15);
        $pdf->SetFont('Arial', 'U', 14);
        $pdf->Cell(35, 7, 'REKOD PESALAH PERINTAH KEHADIRAN WAJIB', 0, 1, 'L');
        $pdf->Ln(5);

        $pdf->SetX(15);
        $pdf->SetFont('Arial', '', 10);
        $pdf->Cell(5, 7, 'A. ', 0, 0, 'L');
        $pdf->Cell(35, 7, 'BUTIR-BUTIR PERIBADI', 0, 2, 'L');
        $pdf->Cell(15, 7, 'Pusat :', 0, 0, 'L');
        $pdf->Cell(35, 7, 'PUSAT KEHADIRAN WAJIB DAERAH BALING/SIK', 0, 2, 'L');

        $pdf->SetX(20);
        $pdf->Cell(35, 7, 'Nama (Huruf Besar) :', 0, 0, 'L');
        $pdf->Cell(35, 7, 'SABU BIN HASSAN', 0, 2, 'L');

        $pdf->SetX(20);
        $pdf->Cell(37, 7, 'No. Kad Pengenalan :', 0, 0, 'L');
        $pdf->Cell(30, 7, '900918-02-6209', 0, 2, 'L');










        // ################   OUTPUT #####################

        $pdf->Output("Laporan PKW Format 1 - " . \Session::get('noPKW') . ".pdf", "I");
        exit;

    }




}
