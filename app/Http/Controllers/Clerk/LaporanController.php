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

        if(!\Session::get('noPKWFound')){

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

        $pdf->Cell(30, 5, "Kepada", 0, 0, 'L');
        $pdf->Cell( 4, 5, ":", 0, 0, 'C');
        $pdf->Cell(77, 5, 'Pengarah Parol Dan Perkhidmatan Komuniti', 0, 1, 'L');
        $pdf->Cell(30, 5, "", 0, 0, 'L');
        $pdf->Cell( 4, 5, "", 0, 0, 'C');
        $pdf->Cell(77, 5, 'Ibu Pejabat Penjara Malaysia', 0, 1, 'L');
        $pdf->Ln(5);

        $pdf->Cell(30, 5, "Daripada", 0, 0, 'L');
        $pdf->Cell( 4, 5, ":", 0, 0, 'C');
        $pdf->Cell(77, 5, 'Pengarah Parol Dan Perkhidmatan Komuniti Daerah ' . Request::input(''), 0, 1, 'L');
        $pdf->Ln(5);

        $pdf->Cell(30, 5, "Salinan", 0, 0, 'L');
        $pdf->Cell( 4, 5, ":", 0, 0, 'C');
        $pdf->Cell(77, 5, 'Pengarah Parol Dan Perkhidmatan Komuniti Kedah ' . Request::input(''), 0, 1, 'L');
        $pdf->Cell(30, 5, "", 0, 0, 'L');
        $pdf->Cell( 4, 5, "", 0, 0, 'C');
        $pdf->Cell(77, 5, 'Ibu Pejabat Penjara Malaysia', 0, 1, 'L');
        $pdf->Ln(5);

        $pdf->Cell(30, 5, "Ruj. Fail", 0, 0, 'L');
        $pdf->Cell( 4, 5, ":", 0, 0, 'C');
        $pdf->Cell(77, 5, "JP/PRL/PKW/BLG/20/2(18)", 0, 1, 'L');
        $pdf->Ln(5);

        $pdf->Cell(30, 5, "Tarikh", 0, 0, 'L');
        $pdf->Cell( 4, 5, ":", 0, 0, 'C');
        $pdf->Cell(77, 5, "09-01-2014", 0, 1, 'L');
        $pdf->Ln(5);

        $pdf->Cell(30, 5, "Perkara", 0, 0, 'L');
        $pdf->Cell( 4, 5, ":", 0, 0, 'C');
        $pdf->Cell(77, 5, "PENERIMAAN PESALAH KEHADIRAN WAHIB DAERAH BALING/SIK", 0, 1, 'L');
        $pdf->Cell(30, 5, "", 0, 0, 'L');
        $pdf->Cell( 4, 5, "", 0, 0, 'C');
        $pdf->Cell(77, 5, 'Ibu Pejabat Penjara Malaysia', 0, 1, 'L');
        $pdf->Ln(5);

        $pdf->Cell(30, 5, "Tuan,", 0, 1, 'L');
        $pdf->Ln(5);

        $pdf->Cell(30, 5, "Adalah saya dengan hormatnya merujuk kepada perkara di atas.", 0, 1, 'L');
        $pdf->Ln(5);

        $pdf->Cell(30, 5, "2.   Bersama-sama ini disertakan :-", 0, 1, 'L');
        $pdf->Ln(5);

        $pdf->Cell(30, 5, "1) Salinan Perintah Kehadiran Wajib,", 0, 1, 'L');
        $pdf->Cell(30, 5, "2) Salinan Buku Daftar PKW Format 1,", 0, 1, 'L');
        $pdf->Cell(30, 5, "3) Salinan Rekod Pesalah PKD Format 2,", 0, 1, 'L');
        $pdf->Cell(30, 5, "4) Salinan Borang PKW 4,", 0, 1, 'L');
        $pdf->Cell(30, 5, "5) Remitan.", 0, 1, 'L');
        $pdf->Ln(5);

        $pdf->Cell(30, 5, "bagi pesalah bernama ", 0, 0, 'L');
        $pdf->setFont('arial', 'u', 12);
        $pdf->SetX(60);
        $pdf->Cell(60, 5, "MOHD ARIF BIN MOHD JASNI  ", 0, 1, 'L');
        $pdf->SetFont('arial', '', 12);
        $pdf->Cell(30, 5, "No. Daftar  ", 0, 0, 'L');
        $pdf->setFont('arial', 'u', 12);
        $pdf->SetX(40);
        $pdf->Cell(25, 5, "PKW 0002-14-02-04      ", 0, 0, 'L');
        $pdf->SetFont('arial', '', 12);
        $pdf->SetX(100);
        $pdf->Cell(30, 5, "untuk makluman dan tindakan pihak tuan", 0, 1, 'L');
        $pdf->Cell(30, 5, "selanjutnya.", 0, 1, 'L');
        $pdf->Ln(5);

        $pdf->Cell(30, 5, "Sekian, terima kasih.", 0, 1, 'L');
        $pdf->Ln(15);


        $pdf->Cell(30, 5, "Saya yang menurut perintah,.", 0, 1, 'L');
        $pdf->Ln(15);

        $pdf->Cell(30, 5, "................................", 0, 1, 'L');
        $pdf->Cell(30, 5, "Mohamad Azwan Bin Bahari (IP)", 0, 1, 'L');


        // Halaman 2
        $pdf->addPage();
        $pdf->SetFont('arial', '', 12);
        $pdf->SetXY(20,20);
        $pdf->Image(public_path() . '\images\logo_penjara.png', 90, 5, 30);
        $pdf->Ln(20);
        $pdf->Cell(190, 5, "BORANG PENGHANTARAN DOKUMEN", 0, 1, 'C');
        $pdf->Cell(190, 5, "TERPERINGKAT SULIT/TERHAD MELALUI MESIN/FAKSIMILI", 0, 1, 'C');
        $pdf->Ln(5);

        $pdf->SetFont('arial', '', 12);

        // Halaman 3
        $pdf->addPage();
        $pdf->SetFont('arial', '', 12);
        $pdf->SetXY(20,20);
        $pdf->Image(public_path() . '\images\logo_penjara.png', 90, 5, 30);
        $pdf->Ln(20);
        $pdf->Cell(190, 5, "BORANG PENGHANTARAN DOKUMEN", 0, 1, 'C');
        $pdf->Cell(190, 5, "TERPERINGKAT SULIT/TERHAD MELALUI MESIN/FAKSIMILI", 0, 1, 'C');
        $pdf->Ln(5);


        // Send to browser
        $pdf->Output("Laporan MT - " . \Session::get('noPKW') . ".pdf", "I");
        exit;

    }

}
