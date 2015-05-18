<?php namespace App\Http\Controllers\Clerk\Laporan;

use Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Mahkamah;
use App\Cases;
use App\Profile;
use App\Parents;
use App\Officer;
use App\Penyelia;
use App\Remitance;
use App\Kehadiran;

use Illuminate\Contracts\Auth\Guard;
use Illuminate\Contracts\Auth\Registrar;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;

use Anouar\Fpdf\Fpdf;
class RemitanceController extends Controller {

    use AuthenticatesAndRegistersUsers;

    protected $redirectPath = 'clerk';


    public function __construct(Guard $auth, Registrar $registrar) {
        $this->registrar = $registrar;
        $this->auth = $auth;

        $this->middleware('auth');
        $this->middleware('userLevelTwo');
    }

	public function remitance() {

        if(\Session::get('noPKW') == null){

            \Session::flash('message', 'Sila buat carian No KP dahulu.');

            return view('clerk/dashboard');
        }

        $cases      = Cases::where('noKP', \Session::get('noPKW'))->get();

        return view('clerk/laporan/remitance', compact('cases', 'cases'));
    }

    public function generateRemitance() {

        if(\Session::get('noPKW') == null){

            \Session::flash('message', 'Sila buat carian No KP dahulu.');

            return view('clerk/dashboard');
        }

        $profile        = Profile::where('noKP', \Session::get('noPKW'))->first();
        $cases          = Cases::where('caseNo', \Session::get('caseNo'))->first();
        $officer        = Officer::find($cases->officer);
        $remitance      = Remitance::where('caseNo', \Session::get('caseNo'))->first();
        $mahkamah       = Mahkamah::find($cases->mahkamah);
        $kehadiran      = Kehadiran::find($cases->kehadiran);
        $penyelia       = Penyelia::find($cases->penyelia);

        // ###############      Settings      #############

        $pdf = new Fpdf('P','mm','A4');
        $pdf->AliasNbPages();
        $pdf->SetTitle("e-Prison - Laporan MT");
        $pdf->SetAuthor('');
        $pdf->SetMargins(10, 10, 7);
        $pdf->SetAutoPageBreak('on', -7);

        // Halaman 1

        $pdf->AddPage();

        // ###############     Section 1    ######################

        $pdf->SetFont('Arial', 'B', 14);
        $pdf->Cell(195, 8, 'PERKIRAAN REMITAN PKW', 0, 1, 'C');


        $pdf->SetFont('Arial', '', 12);
        $pdf->SetXY(15, 20);
        $pdf->Cell(35, 8, 'NAMA PESALAH', 0, 0, 'l');
        $pdf->Cell(5, 8, ' : ', 0, 0, 'l');
        $pdf->Cell(70, 8, $profile->nama, 0, 1, 'l');

        $pdf->SetFont('Arial', '', 12);
        $pdf->SetX(15);
        $pdf->Cell(35, 8, 'NO. DAFTAR ', 0, 0, 'l');
        $pdf->Cell(5, 8, ' : ', 0, 0, 'l');
        $pdf->Cell(70, 8, $cases->noDaftar, 0, 1, 'l');
        $pdf->Ln(5);

        // ###############     Section 2    ######################

        //Rectangle
        $pdf->Rect(14, 41, 160, 105);

        // Lines
        $pdf->Line(14, 56, 174, 56);
        $pdf->Line(14, 66, 174, 66);
        $pdf->Line(14, 76, 174, 76);
        $pdf->Line(14, 86, 174, 86);
        $pdf->Line(14, 96, 174, 96);
        $pdf->Line(14, 106, 174, 106);
        $pdf->Line(14, 116, 174, 116);
        $pdf->Line(14, 126, 174, 126);
//        $pdf->Line(14, 136, 174, 136);
//        $pdf->Line(14, 146, 174, 146);

        //  Columns

        $pdf->Line(130, 56, 130, 146);
        $pdf->Line(145, 56, 145, 146);
//        $pdf->Line(160, 56, 160, 156);

        $tarikhHukum    = explode('-', $remitance->tarikhHukum);
        $tahun          = substr($tarikhHukum[0], 2, 2);
        $bulan          = $tarikhHukum[1];
        $hari           = $tarikhHukum[2];

        $bulanHukuman   = substr($cases->hukuman, 0, 1);


        $pdf->SetXY(14, 41);
        $pdf->Cell(160, 15, 'REMITAN PKW', 0, 1, 'C');

        $pdf->SetXY(14, 56);
        $pdf->Cell(116, 10, 'Tarikh Jatuh Hukum 1', 1, 1, 'L');

        $pdf->SetXY(130, 56);
        $pdf->Cell(15, 10, $hari, 1, 0, 'C');
        $pdf->Cell(15, 10, $bulan, 1, 0, 'C');
        $pdf->Cell(14, 10, $tahun, 1, 0, 'C');

        $pdf->SetXY(14, 66);
        $pdf->Cell(116, 10, 'Campur Hukuman', 1, 1, 'L');

        $pdf->SetXY(130, 66);
        $pdf->Cell(15, 10, '0', 1, 0, 'C');
        $pdf->Cell(15, 10, $bulanHukuman, 1, 0, 'C');
        $pdf->Cell(14, 10, '0', 1, 0, 'C');

        $jumlah1 = $bulan + $bulanHukuman;

        $pdf->SetXY(130, 76);
        $pdf->Cell(15, 10, $hari, 1, 0, 'C');
        $pdf->Cell(15, 10, $jumlah1, 1, 0, 'C');
        $pdf->Cell(14, 10, $tahun, 1, 0, 'C');

        $pdf->SetXY(14, 86);
        $pdf->Cell(116, 10, 'Tolak 1 Hari', 1, 1, 'L');

        $pdf->SetXY(130, 86);
        $pdf->Cell(15, 10, '1', 1, 0, 'C');
        $pdf->Cell(15, 10, '0', 1, 0, 'C');
        $pdf->Cell(14, 10, '0', 1, 0, 'C');

        $pdf->SetXY(14, 96);
        $pdf->Cell(116, 5, 'Tarikh Lewat Tamat', 0, 2, 'L');
        $pdf->Cell(116, 5, 'PKW', 0, 1, 'L');

        $jumlah2 = $hari - 1;

        $pdf->SetXY(130, 96);
        $pdf->Cell(15, 10, $jumlah2, 1, 0, 'C');
        $pdf->Cell(15, 10, $jumlah1, 1, 0, 'C');
        $pdf->Cell(14, 10, $tahun, 1, 0, 'C');

        $pdf->SetXY(14, 106);
        $pdf->Cell(116, 10, 'Tolak Remitan 1/6', 1, 1, 'L');

        $remitan = $bulanHukuman * 5;

        $pdf->SetXY(130, 106);
        $pdf->Cell(15, 10, $remitan, 1, 0, 'C');
        $pdf->Cell(15, 10, '0', 1, 0, 'C');
        $pdf->Cell(14, 10, '0', 1, 0, 'C');

        $pdf->SetXY(14, 116);
        $pdf->Cell(116, 10, ' ', 1, 1, 'L');

        if($jumlah2 < $remitan){
            $jumlah1--;
            $jumlah3 = cal_days_in_month(CAL_GREGORIAN, $jumlah1, $tahun) - $remitan + $jumlah2;
        } else {
            $jumlah3 = $jumlah2 - $remitan;
        }

        $pdf->SetXY(130, 116);
        $pdf->Cell(15, 10, $jumlah3, 1, 0, 'C');
        $pdf->Cell(15, 10, $jumlah1, 1, 0, 'C');
        $pdf->Cell(14, 10, $tahun, 1, 0, 'C');

        $pdf->SetXY(14, 126);
        $pdf->Cell(116, 10, 'Campur 1 Hari', 1, 1, 'L');

        $pdf->SetXY(130, 126);
        $pdf->Cell(15, 10, '1', 1, 0, 'C');
        $pdf->Cell(15, 10, '0', 1, 0, 'C');
        $pdf->Cell(14, 10, '0', 1, 0, 'C');

        $pdf->SetXY(14, 136);
        $pdf->Cell(116, 10, 'Tarikh Awal Tamat PKW ', 1, 1, 'L');

        $jumlah4 = $jumlah3 + 1;

        $pdf->SetXY(130, 136);
        $pdf->Cell(15, 10, $jumlah4, 1, 0, 'C');
        $pdf->Cell(15, 10, $jumlah1, 1, 0, 'C');
        $pdf->Cell(14, 10, $tahun, 1, 0, 'C');



        // ###############     Section 3    ######################


        $pdf->SetXY(15, 186);
        $pdf->Cell(40, 10, 'Disahkan : ', 0, 1, 'L');

        $pdf->SetFont('Arial', '', 12);
        $pdf->Line(25, 233, 80, 233);
        $pdf->Line(120, 233, 188, 233);

        $pdf->SetXY(25, 233);
        $pdf->Cell(55, 5, 'Disediakan oleh : ', 0, 2, 'C');
        $pdf->Cell(55, 5, '(' . $penyelia->name . ')', 0, 2, 'C');
        $pdf->Cell(55, 5, 'Tarikh : ' . $this->tarikhReFormat($remitance->tarikhHukum), 0, 2, 'C');


        $pdf->SetXY(125, 233);
        $pdf->Cell(55, 5, 'Penyesahan', 0, 2, 'C');
        $pdf->Cell(55, 5, 'Pegawai Pusat Kehadiran Wajib', 0, 2, 'C');
        $pdf->Cell(55, 5, 'Tarikh : ' . $this->tarikhReFormat($remitance->tarikhHukum), 0, 2, 'C');


        // ################   OUTPUT #####################

        $pdf->Output("Laporan PKW Format 2 - " . \Session::get('noPKW') . ".pdf", "I");
        exit;

    }

    function tarikhReFormat($date) {

        $tarikh = explode('-', $date);

        $tarikh = $tarikh[2] . '/' . $tarikh[1] . '/' . $tarikh[0];

        return $tarikh;
    }

}
