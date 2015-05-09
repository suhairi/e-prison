<?php namespace App\Http\Controllers\Clerk;

use Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Cases;
use App\Profile;
use App\Kehadiran;
use App\Officer;
use App\Penempatan;
use App\Penerima;

use Illuminate\Contracts\Auth\Guard;
use Illuminate\Contracts\Auth\Registrar;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;

use Anouar\Fpdf\Fpdf;


class LaporanController extends Controller {

    use AuthenticatesAndRegistersUsers;

    protected $redirectPath = 'clerk';


    public function __construct(Guard $auth, Registrar $registrar) {
        $this->registrar = $registrar;
        $this->auth = $auth;

        $this->middleware('auth');
        $this->middleware('userLevelTwo');
    }

	public function getOne() {

        if(!\Session::get('noPKWFound')) {

            \Session::flash('message', 'Sila buat carian No KP dahulu');
            return view('clerk\dashboard');

        }


        $cases          = Cases::where('noKP', \Session::get('noPKW'))->get();
        $profile        = Profile::where('noKP', \Session::get('noPKW'))->first();
        $kehadirans     = Kehadiran::all();
        $officers       = Officer::all();
        $penempatans    = Penempatan::all();
        $penerimas      = Penerima::all();


        return view('clerk/laporan/mt')
            ->with('cases', $cases)
            ->with('profile', $profile)
            ->with('kehadirans', $kehadirans)
            ->with('officers', $officers)
            ->with('penempatans', $penempatans)
            ->with('penerimas', $penerimas);
    }

    public function postOne() {

        function Header()
        {
            // Logo
            $this->Image('logo.png',10,6,30);
            // Arial bold 15
            $this->SetFont('Arial','B',15);
            // Move to the right
            $this->Cell(80);
            // Title
            $this->Cell(30,10,'Title',1,0,'C');
            // Line break
            $this->Ln(20);
        }

        // Page footer
        function Footer()
        {
            // Position at 1.5 cm from bottom
            $this->SetY(-15);
            // Arial italic 8
            $this->SetFont('Arial','I',8);
            // Page number
            $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
        }


        $pdf = new Fpdf('P','mm','A4');
        $pdf->AliasNbPages();
        $pdf->SetTitle("e-Prison - Laporan MT");
        $pdf->SetAuthor(Request::input('pengirim'));
        $pdf->SetMargins(10, 10, 7);

        // Halaman 1
        $pdf->AddPage();

        $pdf->SetFont('arial', 'B', 14);
        $pdf->SetXY(20,20);
        $pdf->Image(public_path() . '\images\logo_penjara.png', 90, 5, 30);
        $pdf->Ln(20);
        $pdf->Cell(190, 5, "MEMO", 0, 1, 'C');
        $pdf->Cell(190, 5, "JABATAN PENJARA MALAYSIA", 0, 1, 'C');
        $pdf->Cell(190, 5, "PUSAT KEHADIRAN WAJIB DAERAH BALING/SIK KEDAH", 0, 1, 'C');
        $pdf->Ln(5);

        $pdf->SetFont('arial', '', 12);
        $pdf->Cell(30, 5, "KEPADA", 0, 0, 'L');
        $pdf->Cell( 4, 5, ":", 0, 0, 'C');
        $pdf->Cell(77, 5, 'Pengarah Parol Dan Perkhidmatan Komuniti', 0, 1, 'L');
        $pdf->Cell(30, 5, "", 0, 0, 'L');
        $pdf->Cell( 4, 5, "", 0, 0, 'C');
        $pdf->Cell(77, 5, 'Ibu Pejabat Penjara Malaysia', 0, 1, 'L');



        // Halaman 2
        $pdf->addPage();
        $pdf->Cell(150,100, "Laporan 2");

        // Halaman 3
        $pdf->addPage();
        $pdf->Cell(150,100, "Laporan 2");


        // Send to browser
        $pdf->Output("Laporan MT - " . \Session::get('noPKW') . ".pdf","D");
        exit;

    }

}
