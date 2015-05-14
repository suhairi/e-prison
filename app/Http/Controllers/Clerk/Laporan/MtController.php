<?php namespace App\Http\Controllers\Clerk\Laporan;

use Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

use App\Cases;
use App\Profile;
use App\Kehadiran;
use App\Officer;
use App\Penempatan;
use App\Penerima;

//use Illuminate\Http\Request;

use Illuminate\Contracts\Auth\Guard;
use Illuminate\Contracts\Auth\Registrar;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;

use Anouar\Fpdf\Fpdf;

class MtController extends Controller {

    use AuthenticatesAndRegistersUsers;

    protected $redirectPath = 'clerk';


    public function __construct(Guard $auth, Registrar $registrar) {
        $this->registrar = $registrar;
        $this->auth = $auth;

        $this->middleware('auth');
        $this->middleware('userLevelTwo');
    }

    public function getOne() {

        if(\Session::get('noPKW') == null){

            \Session::flash('message', 'Sila buat carian No KP dahulu.');

            return view('clerk/dashboard');
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

        $request = Request::all();

        $validation = Validator::make($request, array(
            'kehadiran'     => 'required',
            'memoTerima'    => 'required',
            'pegawai'       => 'required',
            'penerima'      => 'required',
            'penerima2'     => 'required'
        ));

        if($validation->fails()) {

            return 'Error !!!';
        }

        $kehadiran      = Kehadiran::find(Request::input('kehadiran'));
        $case           = Cases::find(Request::input('memoTerima'));
        $officer        = Officer::find(Request::input('pegawai'));
        $penempatan     = Penempatan::find($officer->penempatan);
        $profile        = Profile::find($case->noKP);
        $penerima       = Penerima::find(Request::input('penerima'));
        $penerima2      = Penerima::find(Request::input('penerima2'));


//        dd($case->memoTerima);

        $pdf = new Fpdf('P','mm','A4');
        $pdf->AliasNbPages();
        $pdf->SetTitle("e-Prison - Laporan MT");
        $pdf->SetAuthor(Request::input('pengirim'));
        $pdf->SetMargins(10, 10, 7);

        // Halaman 1

        $pdf->AddPage();

        $pdf->SetFont('Arial', 'B', 14);
        $pdf->SetXY(20,20);
        $pdf->Image(public_path() . '\images\logo_penjara.png', 90, 5, 30);
        $pdf->Ln(20);
        $pdf->Cell(190, 5, "MEMO", 0, 1, 'C');
        $pdf->Cell(190, 5, "JABATAN PENJARA MALAYSIA", 0, 1, 'C');
        $pdf->Cell(190, 5, $kehadiran->desc, 0, 1, 'C');
        $pdf->Ln(5);


        // FIXED - no changes
        $pdf->SetFont('Arial', '', 12);
        $pdf->Cell(30, 5, "Kepada", 0, 0, 'L');
        $pdf->Cell( 4, 5, ":", 0, 0, 'C');
        $pdf->Cell(77, 5, 'Pengarah Parol Dan Perkhidmatan Komuniti', 0, 1, 'L');
        $pdf->Cell(30, 5, "", 0, 0, 'L');
        $pdf->Cell( 4, 5, "", 0, 0, 'C');
        $pdf->Cell(77, 5, 'Ibu Pejabat Penjara Malaysia', 0, 1, 'L');
        $pdf->Ln(5);

        // FIXED - no changes
        $pdf->Cell(30, 5, "Daripada", 0, 0, 'L');
        $pdf->Cell( 4, 5, ":", 0, 0, 'C');
        $pdf->Cell(77, 5, 'Pegawai ' . ucWords(strtolower($kehadiran->desc)), 0, 1, 'L');
        $pdf->Ln(5);

        // FIXED - no changes
        $pdf->Cell(30, 5, "Salinan", 0, 0, 'L');
        $pdf->Cell( 4, 5, ":", 0, 0, 'C');
        $pdf->Cell(77, 5, 'Pengarah Parol Dan Perkhidmatan Komuniti Kedah ' . Request::input(''), 0, 1, 'L');
        $pdf->Cell(30, 5, "", 0, 0, 'L');
        $pdf->Cell( 4, 5, "", 0, 0, 'C');
        $pdf->Cell(77, 5, 'Ibu Pejabat Penjara Malaysia', 0, 1, 'L');
        $pdf->Ln(5);

        $pdf->Cell(30, 5, "Ruj. Fail", 0, 0, 'L');
        $pdf->Cell( 4, 5, ":", 0, 0, 'C');
        $pdf->Cell(77, 5, $case->memoTerima, 0, 1, 'L');
        $pdf->Ln(5);
//
        $tarikh = explode('-', $case->tarikhMasuk);
        $tarikh = $tarikh[2] . '-' . $tarikh[1] . '-' . $tarikh[0];
//
        $pdf->Cell(30, 5, "Tarikh", 0, 0, 'L');
        $pdf->Cell( 4, 5, ":", 0, 0, 'C');
        $pdf->Cell(77, 5, $tarikh, 0, 1, 'L');
        $pdf->Ln(5);

        $pdf->Cell(30, 5, "Perkara", 0, 0, 'L');
        $pdf->Cell( 4, 5, ":", 0, 0, 'C');
        $pdf->setFont('Arial', 'B', 12);
        $pdf->Cell(77, 5, "PENERIMAAN PESALAH ". str_replace('PUSAT ', "", $kehadiran->desc), 0, 1, 'L');
        $pdf->Cell(30, 5, "", 0, 0, 'L');
        $pdf->Ln(5);

        $pdf->setFont('Arial', '', 12);
        $pdf->Cell(30, 5, "Tuan,", 0, 1, 'L');
        $pdf->Ln(5);

        $pdf->Cell(30, 5, "Adalah saya dengan hormatnya merujuk kepada perkara di atas.", 0, 1, 'L');
        $pdf->Ln(5);

        $pdf->Cell(30, 5, "2.   Bersama-sama ini disertakan :-", 0, 1, 'L');
        $pdf->Ln(5);

        $pdf->Cell(30, 5, "1) Salinan Perintah Kehadiran Wajib,", 0, 1, 'L');
        $pdf->Cell(30, 5, "2) Salinan Buku Daftar PKW Format 1,", 0, 1, 'L');
        $pdf->Cell(30, 5, "3) Salinan Rekod Pesalah PKW Format 2,", 0, 1, 'L');
        $pdf->Cell(30, 5, "4) Salinan Borang PKW 4,", 0, 1, 'L');
        $pdf->Cell(30, 5, "5) Remitan.", 0, 1, 'L');
        $pdf->Ln(5);

        $pdf->Cell(30, 5, "bagi pesalah bernama ", 0, 0, 'L');
        $pdf->setFont('Arial', 'u', 12);
        $pdf->SetX(60);
        $pdf->Cell(60, 5, $profile->nama . '     ', 0, 1, 'L');
        $pdf->SetFont('Arial', '', 12);
        $pdf->Cell(30, 5, "No. Daftar  ", 0, 0, 'L');
        $pdf->setFont('Arial', 'u', 12);
        $pdf->SetX(40);
        $pdf->Cell(25, 5, $case->noDaftar . "      ", 0, 0, 'L');
        $pdf->SetFont('Arial', '', 12);
        $pdf->SetX(100);
        $pdf->Cell(30, 5, "untuk makluman dan tindakan pihak tuan", 0, 1, 'L');
        $pdf->Cell(30, 5, "selanjutnya.", 0, 1, 'L');
        $pdf->Ln(5);

        $pdf->Cell(30, 5, "Sekian, terima kasih.", 0, 1, 'L');
        $pdf->Ln(15);


        $pdf->Cell(30, 5, "Saya yang menurut perintah,.", 0, 1, 'L');
        $pdf->Ln(15);

        $pdf->Cell(30, 5, "...........................................................", 0, 1, 'L');
        $pdf->Cell(30, 5, $officer->name . ' (' . $officer->position . ') ', 0, 1, 'L');


        // ###########################     Halaman 2       ###########################

        $pdf->addPage();
        $pdf->SetFont('Arial', '', 12);
        $pdf->SetXY(20,20);
        $pdf->Image(public_path() . '\images\logo_penjara.png', 90, 5, 30);
        $pdf->Ln(20);
        $pdf->Cell(190, 5, "BORANG PENGHANTARAN DOKUMEN", 0, 1, 'C');
        $pdf->Cell(190, 5, "TERPERINGKAT SULIT/TERHAD MELALUI MESIN/FAKSIMILI", 0, 1, 'C');
        $pdf->Ln(5);

        $pdf->SetFont('Arial', '', 10);
        $pdf->SetX(20);
        $pdf->Cell(175, 220, "", 1, 1, 'C');

        $pdf->SetXY(25, 60);
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(30, 5, "MAKLUMAT DOKUMEN", 0, 1, 'L');
        $pdf->Ln(5);

        $pdf->SetX(25);
        $pdf->SetFont('Arial', '', 10);
        $pdf->Cell(55, 5, "NO. RUJUKAN", 0, 0, 'L');
        $pdf->Cell(3, 5, ":", 0, 0, 'L');
        $pdf->Cell(30, 5, $case->memoTerima, 0, 1, 'L');
        $pdf->Ln(5);

        $pdf->SetX(25);
        $pdf->SetFont('Arial', '', 10);
        $pdf->Cell(55, 5, "TARIKH DOKUMEN DIHANTAR", 0, 0, 'L');
        $pdf->Cell(3, 5, ":", 0, 0, 'L');
        $pdf->Cell(30, 5, $tarikh, 0, 1, 'L');
        $pdf->Ln(5);

        $pdf->SetX(25);
        $pdf->Cell(55, 5, "PERKARA/TAJUK", 0, 0, 'L');
        $pdf->Cell(3, 5, ":", 0, 0, 'L');
        $pdf->Cell(30, 5, "Penerimaan Pesalah ". ucWords(strtolower(str_replace('PUSAT ', "", $kehadiran->desc))), 0, 1, 'L');
        $pdf->Ln(5);

        $pdf->SetX(25);
        $pdf->Cell(55, 5, "BIL. MUKA SURAT", 0, 0, 'L');
        $pdf->Cell(3, 5, ":", 0, 0, 'L');
        $pdf->Cell(30, 5, "(10) termasuk halaman ini", 0, 1, 'L');
        $pdf->Ln(5);

        $pdf->Line(20, 110, 210-15, 110);

        $pdf->SetXY(25, 115);
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(30, 5, "MAKLUMAT PENERIMA", 0, 1, 'L');
        $pdf->Ln(5);

        $pdf->SetX(25);
        $pdf->SetFont('Arial', '', 10);
        $pdf->Cell(55, 5, "NAMA PEGAWAI", 0, 0, 'L');
        $pdf->Cell(3, 5, ":", 0, 0, 'L');
        $pdf->Cell(30, 5, $penerima->name, 0, 1, 'L');
        $pdf->Ln(5);

        $pdf->SetX(25);
        $pdf->SetFont('Arial', '', 10);
        $pdf->Cell(55, 5, "NAMA ORGANISASI", 0, 0, 'L');
        $pdf->Cell(3, 5, ":", 0, 0, 'L');
        $pdf->Cell(30, 5, $penerima->organisasi, 0, 1, 'L');
        $pdf->Ln(5);

        $pdf->SetX(25);
        $pdf->Cell(55, 5, "ALAMAT", 0, 0, 'L');
        $pdf->Cell(3, 5, ":", 0, 0, 'L');
        $pdf->Cell(30, 5, $penerima->alamat1, 0, 2, 'L');
        $pdf->Cell(30, 5, $penerima->alamat2, 0, 2, 'L');
        $pdf->Cell(30, 5, $penerima->alamat3, 0, 2, 'L');
        $pdf->Cell(30, 5, $penerima->alamat4, 0, 1, 'L');
        $pdf->Ln(5);

        $pdf->SetX(25);
        $pdf->Cell(55, 5, "NO. TELEFAX", 0, 0, 'L');
        $pdf->Cell(3, 5, ":", 0, 0, 'L');
        $pdf->Cell(30, 5, $penerima->noTel, 0, 1, 'L');
        $pdf->Ln(5);

        $pdf->Line(20, 180, 210-15, 180);

        $pdf->Line(20, 110, 210-15, 110);

        $pdf->SetXY(25, 185);
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(30, 5, "MAKLUMAT PENGIRIM", 0, 1, 'L');
        $pdf->Ln(5);

        $pdf->SetX(25);
        $pdf->SetFont('Arial', '', 10);
        $pdf->Cell(55, 5, "NAMA PEGAWAI", 0, 0, 'L');
        $pdf->Cell(3, 5, ":", 0, 0, 'L');
        $pdf->Cell(30, 5, ucWords(strtolower($officer->name)), 0, 1, 'L');
        $pdf->Ln(5);

        $pdf->SetX(25);
        $pdf->SetFont('Arial', '', 10);
        $pdf->Cell(55, 5, "NAMA ORGANISASI", 0, 0, 'L');
        $pdf->Cell(3, 5, ":", 0, 0, 'L');
        $pdf->Cell(30, 5, ucWords(strtolower($penempatan->namaPenuh)), 0, 1, 'L');
        $pdf->Ln(5);

        $pdf->SetX(25);
        $pdf->Cell(55, 5, "ALAMAT", 0, 0, 'L');
        $pdf->Cell(3, 5, ":", 0, 0, 'L');
        $pdf->Cell(30, 5, ucWords(strtolower($penempatan->alamat1)), 0, 2, 'L');
        $pdf->Cell(30, 5, ucWords(strtolower($penempatan->alamat2)), 0, 2, 'L');
        $pdf->Cell(30, 5, ucWords(strtolower($penempatan->alamat3)), 0, 2, 'L');
        $pdf->Cell(30, 5, ucWords(strtolower($penempatan->alamat4)), 0, 1, 'L');
        $pdf->Ln(5);

        $pdf->SetX(25);
        $pdf->Cell(55, 5, "NO. TELEFAX", 0, 0, 'L');
        $pdf->Cell(3, 5, ":", 0, 0, 'L');
        $pdf->Cell(30, 5, $penempatan->noTel, 0, 1, 'L');
        $pdf->Ln(5);

        $pdf->SetX(25);
        $pdf->Cell(55, 5, "PESANAN", 0, 0, 'L');
        $pdf->Cell(3, 5, ":", 0, 0, 'L');
        $pdf->Cell(30, 5, "", 0, 1, 'L');
        $pdf->Ln(5);
        $pdf->Line(20, 180, 210-15, 180);

        // ###########################     Halaman 3       ###########################

        $pdf->addPage();
        $pdf->SetFont('Arial', '', 12);
        $pdf->SetXY(20,20);
        $pdf->Image(public_path() . '\images\logo_penjara.png', 90, 5, 30);
        $pdf->Ln(20);
        $pdf->Cell(190, 5, "BORANG PENGHANTARAN DOKUMEN", 0, 1, 'C');
        $pdf->Cell(190, 5, "TERPERINGKAT SULIT/TERHAD MELALUI MESIN/FAKSIMILI", 0, 1, 'C');
        $pdf->Ln(5);

        $pdf->SetFont('Arial', '', 10);
        $pdf->SetX(20);
        $pdf->Cell(175, 220, "", 1, 1, 'C');

        $pdf->SetXY(25, 60);
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(30, 5, "MAKLUMAT DOKUMEN", 0, 1, 'L');
        $pdf->Ln(5);

        $pdf->SetX(25);
        $pdf->SetFont('Arial', '', 10);
        $pdf->Cell(55, 5, "NO. RUJUKAN", 0, 0, 'L');
        $pdf->Cell(3, 5, ":", 0, 0, 'L');
        $pdf->Cell(30, 5, $case->memoTerima, 0, 1, 'L');
        $pdf->Ln(5);

        $pdf->SetX(25);
        $pdf->SetFont('Arial', '', 10);
        $pdf->Cell(55, 5, "TARIKH DOKUMEN DIHANTAR", 0, 0, 'L');
        $pdf->Cell(3, 5, ":", 0, 0, 'L');
        $pdf->Cell(30, 5, $tarikh, 0, 1, 'L');
        $pdf->Ln(5);

        $pdf->SetX(25);
        $pdf->Cell(55, 5, "PERKARA/TAJUK", 0, 0, 'L');
        $pdf->Cell(3, 5, ":", 0, 0, 'L');
        $pdf->Cell(30, 5, "Penerimaan Pesalah ". ucWords(strtolower(str_replace('PUSAT ', "", $kehadiran->desc))), 0, 1, 'L');
        $pdf->Ln(5);

        $pdf->SetX(25);
        $pdf->Cell(55, 5, "BIL. MUKA SURAT", 0, 0, 'L');
        $pdf->Cell(3, 5, ":", 0, 0, 'L');
        $pdf->Cell(30, 5, "(10) termasuk halaman ini", 0, 1, 'L');
        $pdf->Ln(5);

        $pdf->Line(20, 110, 210-15, 110);

        $pdf->SetXY(25, 115);
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(30, 5, "MAKLUMAT PENERIMA", 0, 1, 'L');
        $pdf->Ln(5);

        $pdf->SetX(25);
        $pdf->SetFont('Arial', '', 10);
        $pdf->Cell(55, 5, "NAMA PEGAWAI", 0, 0, 'L');
        $pdf->Cell(3, 5, ":", 0, 0, 'L');
        $pdf->Cell(30, 5, $penerima2->name, 0, 1, 'L');
        $pdf->Ln(5);

        $pdf->SetX(25);
        $pdf->SetFont('Arial', '', 10);
        $pdf->Cell(55, 5, "NAMA ORGANISASI", 0, 0, 'L');
        $pdf->Cell(3, 5, ":", 0, 0, 'L');
        $pdf->Cell(30, 5, $penerima2->organisasi, 0, 1, 'L');
        $pdf->Ln(5);

        $pdf->SetX(25);
        $pdf->Cell(55, 5, "ALAMAT", 0, 0, 'L');
        $pdf->Cell(3, 5, ":", 0, 0, 'L');
        $pdf->Cell(30, 5, $penerima2->alamat1, 0, 2, 'L');
        $pdf->Cell(30, 5, $penerima2->alamat2, 0, 2, 'L');
        if($penerima2->alamat3 != '')
            $pdf->Cell(30, 5, $penerima2->alamat3, 0, 2, 'L');

        if($penerima2->alamat4 != '')
            $pdf->Cell(30, 5, $penerima2->alamat4, 0, 1, 'L');

        $pdf->Ln(5);

        $pdf->SetX(25);
        $pdf->Cell(55, 5, "NO. TELEFAX", 0, 0, 'L');
        $pdf->Cell(3, 5, ":", 0, 0, 'L');
        $pdf->Cell(30, 5, $penerima2->noTel, 0, 1, 'L');
        $pdf->Ln(5);

        $pdf->Line(20, 180, 210-15, 180);

        $pdf->Line(20, 110, 210-15, 110);

        $pdf->SetXY(25, 185);
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(30, 5, "MAKLUMAT PENGIRIM", 0, 1, 'L');
        $pdf->Ln(5);

        $pdf->SetX(25);
        $pdf->SetFont('Arial', '', 10);
        $pdf->Cell(55, 5, "NAMA PEGAWAI", 0, 0, 'L');
        $pdf->Cell(3, 5, ":", 0, 0, 'L');
        $pdf->Cell(30, 5, ucWords(strtolower($officer->name)), 0, 1, 'L');
        $pdf->Ln(5);

        $pdf->SetX(25);
        $pdf->SetFont('Arial', '', 10);
        $pdf->Cell(55, 5, "NAMA ORGANISASI", 0, 0, 'L');
        $pdf->Cell(3, 5, ":", 0, 0, 'L');
        $pdf->Cell(30, 5, ucWords(strtolower($penempatan->namaPenuh)), 0, 1, 'L');
        $pdf->Ln(5);

        $pdf->SetX(25);
        $pdf->Cell(55, 5, "ALAMAT", 0, 0, 'L');
        $pdf->Cell(3, 5, ":", 0, 0, 'L');
        $pdf->Cell(30, 5, ucWords(strtolower($penempatan->alamat1)), 0, 2, 'L');
        $pdf->Cell(30, 5, ucWords(strtolower($penempatan->alamat2)), 0, 2, 'L');
        if($penempatan->alamat3 != '')
            $pdf->Cell(30, 5, ucWords(strtolower($penempatan->alamat3)), 0, 2, 'L');
        if($penempatan->alamat4 != '')
            $pdf->Cell(30, 5, ucWords(strtolower($penempatan->alamat4)), 0, 1, 'L');
        $pdf->Ln(5);

        $pdf->SetX(25);
        $pdf->Cell(55, 5, "NO. TELEFAX", 0, 0, 'L');
        $pdf->Cell(3, 5, ":", 0, 0, 'L');
        $pdf->Cell(30, 5, $penempatan->noTel, 0, 1, 'L');
        $pdf->Ln(5);

        $pdf->SetX(25);
        $pdf->Cell(55, 5, "PESANAN", 0, 0, 'L');
        $pdf->Cell(3, 5, ":", 0, 0, 'L');
        $pdf->Cell(30, 5, "", 0, 1, 'L');
        $pdf->Ln(5);
        $pdf->Line(20, 180, 210-15, 180);


        // Send to browser
        $pdf->Output("Laporan MT - " . \Session::get('noPKW') . ".pdf", "I");
        exit;

    }
}
