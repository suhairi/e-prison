<?php namespace App\Http\Controllers\Clerk\Laporan;

use Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

//use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Cases;
use App\Mahkamah;
use App\Kehadiran;

use Illuminate\Contracts\Auth\Guard;
use Illuminate\Contracts\Auth\Registrar;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;

use Anouar\Fpdf\Fpdf;


class PKW2bController extends Controller {

    use AuthenticatesAndRegistersUsers;

    protected $redirectPath = 'clerk';


    public function __construct(Guard $auth, Registrar $registrar) {
        $this->registrar = $registrar;
        $this->auth = $auth;

        $this->middleware('auth');
        $this->middleware('userLevelTwo');
    }

	public function PKW2b() {

        if(\Session::get('noPKW') == null){

            \Session::flash('message', 'Sila buat carian No KP dahulu.');

            return view('clerk/dashboard');
        }

        $cases  = DB::table('cases')
                    ->join('mahkamah', 'mahkamah.id', '=', 'cases.mahkamah')
                    ->join('kehadiran', 'kehadiran.id', '=', 'cases.kehadiran')
                    ->select('cases.tarikhMasuk', 'cases.seksyenKesalahan', 'cases.hukuman', 'mahkamah.name', 'kehadiran.desc')
                    ->where('noKP', \Session::get('noPKW'))
                    ->where('caseNo', '!=', \Session::get('caseNo'))
                    ->get();

//        dd($cases);


        return view('clerk.laporan.pkw2b')
            ->with('cases', $cases);
    }

    public function generatePKW2b() {

        if(\Session::get('noPKW') == null){

            \Session::flash('message', 'Sila buat carian No KP dahulu.');

            return view('clerk/dashboard');
        }

        // ###############      Settings      #############

        $pdf = new Fpdf('P','mm','A4');
        $pdf->AliasNbPages();
        $pdf->SetTitle("e-Prison - Laporan MT");
        $pdf->SetAuthor('');
        $pdf->SetMargins(10, 10, 7);
        $pdf->SetAutoPageBreak('on', -7);

        // Halaman 1

        $pdf->AddPage();

        $pdf->SetFont('Arial', '', 8);
        $pdf->SetXY(10, 10);
        $pdf->Cell(195, 5, 'PKW Format 2 (b)', 0, 1, 'R');
        $pdf->Ln(5);

        $pdf->SetX(15);
        $pdf->SetFont('Arial', '', 14);
        $pdf->Cell(35, 7, 'E. REKOD KESALAHAN LAMPAU', 0, 1, 'L');
        $pdf->Ln(5);

        // ##################   BORDER, ROWS AND COLUMNS  ##################

        $pdf->SetFont('Arial', '', 10);
        $pdf->SetX(15);
        $pdf->Cell(150, 90, "", 1, 0, 'C');

        $pdf->Line(15, 38, 165, 38);            // Border
        $pdf->Line(45, 32, 293-248, 122);       // 1st Row (w:13)
        $pdf->Line(75, 32, 293-218, 122);       // 2nd Row (w: 30)
        $pdf->Line(105, 32, 293-188, 122);       // 3rd Row (w: 30)
        $pdf->Line(135, 32, 293-158, 122);      // 4th Row (w: 45)

        // ###############   ROW 1   ######################

        $pdf->SetX(18);
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(17, 7, 'Tarikh', 0, 0, 'C');
        $pdf->Cell(30, 7, 'Kesalahan', 0, 0, 'C');
        $pdf->Cell(20, 7, 'Hukuman', 0, 0, 'C');
        $pdf->Cell(20, 7, 'Mahkamah', 0, 0, 'C');
        $pdf->Cell(20, 7, 'Penjara', 0, 0, 'C');


        // ################   OUTPUT #####################

        $pdf->Output("Laporan PKW Format 2 - " . \Session::get('noPKW') . ".pdf", "I");
        exit;

    }



}
