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

        $cases  = DB::table('cases')
            ->join('mahkamah', 'mahkamah.id', '=', 'cases.mahkamah')
            ->join('kehadiran', 'kehadiran.id', '=', 'cases.kehadiran')
            ->select('cases.tarikhMasuk', 'cases.seksyenKesalahan', 'cases.hukuman', 'mahkamah.name', 'kehadiran.desc')
            ->where('noKP', \Session::get('noPKW'))
            ->where('caseNo', '!=', \Session::get('caseNo'))
            ->get();

//        dd($cases);

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
        $pdf->SetFont('Arial', 'B', 14);
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

        $pdf->SetX(15);
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(30, 7, 'Tarikh', 0, 0, 'C');
        $pdf->Cell(30, 7, 'Kesalahan', 0, 0, 'C');
        $pdf->Cell(30, 7, 'Hukuman', 0, 0, 'C');
        $pdf->Cell(30, 7, 'Mahkamah', 0, 0, 'C');
        $pdf->Cell(30, 7, 'Penjara', 0, 0, 'C');
        $pdf->Ln(5);

        if(count($cases) > 0){
            $pdf->Ln(3);
            $pdf->SetX(15);
            $pdf->SetFont('Arial', '', 9);

            foreach($cases as $case) {
                $hukuman    = $this->strTrim($case->hukuman, 8);
                $mahkamah   = $this->strTrim($case->name, 8);
                $penjara    = $this->strTrim($case->desc, 8);


                $pdf->Cell(30, 4, $case->tarikhMasuk, 0, 0, 'C');
                $pdf->Cell(30, 4, $case->seksyenKesalahan, 0, 0, 'C');
                for($i=0; $i<count($hukuman); $i++){
                    $pdf->SetX(75);
                    $pdf->Cell(30, 4, $hukuman[$i], 0, 2, 'C');
                }

                $pdf->SetY($pdf->GetY() - (4 * count($hukuman)));

                for($i=0; $i<count($mahkamah); $i++){
                    $pdf->SetX(105);
                    $pdf->Cell(30, 4, $mahkamah[$i], 0, 2, 'C');
                }

                $pdf->SetY($pdf->GetY() - (4 * count($mahkamah)));

                for($i=0; $i<count($penjara); $i++){
                    $pdf->SetX(135);
                    $pdf->Cell(30, 4, $penjara[$i], 0, 2, 'C');
                }

                $pdf->Ln(5);
            }

        } else {
            $pdf->Ln(5);
            $pdf->SetX(15);
            $pdf->SetFont('Arial', '', 9);
            $pdf->Cell(30, 7, 'Tiada', 0, 0, 'C');
            $pdf->Cell(30, 7, 'Tiada', 0, 0, 'C');
            $pdf->Cell(30, 7, 'Tiada', 0, 0, 'C');
            $pdf->Cell(30, 7, 'Tiada', 0, 0, 'C');
            $pdf->Cell(30, 7, 'Tiada', 0, 0, 'C');
            $pdf->Ln(5);
        }

        // ###############   ROW 2   ######################

        $pdf->Line(10, 130, 200, 130);

        $pdf->SetXY(15, 135);
        $pdf->SetX(15);
        $pdf->SetFont('Arial', 'B', 14);
        $pdf->Cell(35, 7, 'F. PEKERJAAN / AKTIVITI / PROGRAM YANG DITENTUKAN', 0, 1, 'L');
        $pdf->Ln(5);

        $catatan = $this->strTrim(Request::input('catatan'), 100);

        $pdf->SetFont('Arial', 'U', 10);
        for($i=0; $i<count($catatan); $i++) {
            $pdf->Cell(30, 7, $catatan[$i], 0, 2, 'L');
        }

        for($j=0; $j<(8-count($catatan)); $j++)
            $pdf->Ln(5);

        // ###############   ROW 3   ######################

        $pdf->SetXY(15, 160);

        $pdf->SetX(15);
        $pdf->SetFont('Arial', '', 12);
        $pdf->Rect(35, 210, 30, 40);
        $pdf->Line(35, 218, 65, 218);
        $pdf->SetXY(35, 211);
        $pdf->Cell(30, 6, 'CIJK - Masuk', 0, 1, 'C');

        $pdf->Rect(125, 210, 30, 40);
        $pdf->Line(125, 218, 155, 218);
        $pdf->SetXY(125, 211);
        $pdf->Cell(30, 6, 'CIJK - Masuk', 0, 1, 'C');
        $pdf->Ln(5);

        // ###############   ROW 4   ######################

        $pdf->SetXY(25, 160);

        $pdf->SetFont('Arial', '', 10);
        $pdf->Line(25, 273, 75, 273);
        $pdf->Line(115, 273, 165, 273);

        $pdf->SetXY(27, 273);
        $pdf->Cell(30, 5, 'Tandatangan Pegawai PKW', 0, 2, 'L');
        $pdf->Cell(30, 5, 'Tarikh : ', 0, 0, 'L');

        $pdf->SetXY(117, 273);
        $pdf->Cell(30, 5, 'Tandatangan Pegawai PKW', 0, 2, 'L');
        $pdf->Cell(30, 5, 'Tarikh : ', 0, 0, 'L');


        $pdf->SetFont('Arial', '', 7);
        $pdf->SetXY(27, 290);
        $pdf->Cell(170, 5, '*CIJK - Cop ibu jari kanan pesalah', 0, 0, 'L');


        // ################   OUTPUT #####################

        $pdf->Output("Laporan PKW Format 2 (b) - " . \Session::get('noPKW') . ".pdf", "I");
        exit;

    }

    function strTrim($str, $length) {

        $address = explode(' ', $str);

        $addressLine[] = '';
        $j = 0;
        $str = '';
        $strCombined = false;

        for($i=0; $i<count($address); $i++) {

            if($j > 0) {
                $k = $j - 1;
                $str = $addressLine[$k] . ' ' . $address[$i];
                $strCombined = true;
            } else {
                $str = $address[$i];
            }

            if(strlen($str) <= $length){

                if($strCombined)
                    $j = $j - 1;
                $addressLine[$j] = $str;
                $j++;
            } else {
                $addressLine[$j] = $address[$i];
                $j++;
            }
            $strCombined = false;
        }

        return $addressLine;
    }


}
