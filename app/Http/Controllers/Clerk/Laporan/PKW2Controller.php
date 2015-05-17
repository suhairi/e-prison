<?php namespace App\Http\Controllers\Clerk\Laporan;

use Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Mahkamah;
use App\Cases;
use App\Kehadiran;
use App\Profile;
use App\Parents;
use App\Remitance;
use App\Profileext;

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

    public function PKW2() {

        $cases      = Cases::where('noKP', \Session::get('noPKW'))->get();
        $mahkamahs  = Mahkamah::paginate(10);

        return view('clerk/laporan/pkw2')
            ->with('mahkamahs', $mahkamahs)
            ->with('cases', $cases);

    }

    public function generatePKW2() {

        if(\Session::get('noPKW') == null){

            \Session::flash('message', 'Sila buat carian No KP dahulu.');

            return view('clerk/dashboard');
        }

        $cases      = Cases::where('caseNo', Request::input('noKes'))->first();
        $kehadiran  = Kehadiran::where('id', $cases->kehadiran)->first();
        $profile    = Profile::find(\Session::get('noPKW'));
        $parent     = Parents::where('noKP', \Session::get('noPKW'))->first();
        $mahkamah   = Mahkamah::find($cases->mahkamah);
        $remitance  = Remitance::where('caseNo', $cases->caseNo)->first();
        $profileExt = Profileext::find($cases->noKP);


//        dd($parent);

        $nodaftar = str_replace(' ', '', $cases->noDaftar);

        for($i=0; $i<strlen($nodaftar); $i++)
            $noDaftar[] =substr($nodaftar, $i, 1);

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
        $pdf->Cell(195, 5, 'PKW Format 2', 0, 1, 'R');
        $pdf->Ln(5);

        $pdf->SetX(10);
        $pdf->SetFont('Arial', 'B', 18);
        $pdf->Cell(35, 7, 'No Daftar', 0, 0, 'L');
        for($i=0; $i<count($noDaftar); $i++)
            $pdf->Cell(7, 7, $noDaftar[$i], 1, 0, 'C');
        $pdf->Ln(10);

        $pdf->SetX(15);
        $pdf->SetFont('Arial', 'U', 14);
        $pdf->Cell(35, 7, 'REKOD PESALAH PERINTAH KEHADIRAN WAJIB', 0, 1, 'L');
        $pdf->Ln(5);

        // ################    GAMBAR   #######################

        $pdf->Image(public_path() . '/uploads/images/' . $profile->noKP . '.jpg', 152, 36, 25);

        // ###############   SECTION 1   ######################

        $pdf->SetX(15);
        $pdf->SetFont('Arial', '', 10);
        $pdf->Cell(5, 7, 'A. ', 0, 0, 'L');
        $pdf->Cell(35, 7, 'BUTIR-BUTIR PERIBADI', 0, 2, 'L');
        $pdf->Cell(15, 7, 'Pusat :', 0, 0, 'L');
        $pdf->Cell(35, 7, $kehadiran->desc, 0, 2, 'L');

        $pdf->SetX(20);
        $pdf->Cell(35, 7, 'Nama (Huruf Besar) :', 0, 0, 'L');
        $pdf->Cell(35, 7, $profile->nama, 0, 2, 'L');

        $pdf->SetX(20);
        $pdf->Cell(37, 7, 'No. Kad Pengenalan :', 0, 0, 'L');
        $pdf->Cell(30, 7, $profile->noKP, 0, 2, 'L');

        $pdf->SetX(20);
        $pdf->Cell(22, 7, 'Tarikh Lahir :', 0, 0, 'L');
        $pdf->Cell(63, 7, '18/09/1990', 0, 0, 'L');
        $pdf->Cell(40, 7, 'Umur Masa masuk : ', 0, 0, 'L');
        $pdf->Cell(40, 7, '???', 0, 2, 'L');

        $pdf->SetX(20);
        $pdf->Cell(22, 7, 'Pekerjaan :', 0, 0, 'L');
        $pdf->Cell(63, 7, $profile->jobDesc, 0, 0, 'L');
        $pdf->Cell(40, 7, 'Bekerja/Tidak Masa Ditangkap *', 0, 2, 'L');

        $pdf->SetX(20);
        $pdf->Cell(22, 7, 'Keturunan :', 0, 0, 'L');
        $pdf->Cell(63, 7, $profile->race, 0, 0, 'L');
        $pdf->Cell(15, 7, 'Ugama : ', 0, 0, 'L');
        $pdf->Cell(40, 7, $profile->religion, 0, 2, 'L');

        $pdf->SetX(20);
        $pdf->Cell(22, 7, 'Nama Waris :', 0, 0, 'L');
        $pdf->Cell(63, 7, $parent->name, 0, 0, 'L');
        $pdf->Cell(28, 7, 'Persaudaraan  : ', 0, 0, 'L');
        $pdf->Cell(40, 7, $parent->relationship, 0, 2, 'L');

        $pdf->SetX(20);
        $pdf->Cell(58, 7, 'No. Telefon Yang Boleh Dihubungi :', 0, 0, 'L');
        $pdf->Cell(63, 7, $parent->phone, 0, 2, 'L');

        // ############### SECTION 2 ######################

        $pdf->Line(15, 110, 210-10, 110);

        $pdf->SetXY(15, 112);
        $pdf->Cell(5, 7, "B.", 0, 0, 'L');
        $pdf->Cell(40, 7, "MAKLUMAT KESALAHAN", 0, 1);

        $pdf->SetX(20);
        $pdf->Cell(42, 7, 'Alamat Masa Ditangkap :', 0, 0, 'L');
        $pdf->Cell(35, 7, $cases->placeArrested, 0, 1, 'L');

        $pdf->SetX(20);
        $pdf->Cell(30, 7, 'No Waran ', 0, 0, 'L');
        $pdf->Cell(3, 7, ':', 0, 0, 'L');
        $pdf->Cell(60, 7, 'Tiada ', 0, 0, 'L');
        $pdf->Cell(30, 7, 'No. Kes ', 0, 0, 'L');
        $pdf->Cell(3, 7, ':', 0, 0, 'L');
        $pdf->Cell(30, 7, $cases->caseNo, 0, 2, 'L');


        $pdf->SetX(20);
        $pdf->Cell(30, 7, 'Kesalahan ', 0, 0, 'L');
        $pdf->Cell(3, 7, ':', 0, 0, 'L');
        $pdf->Cell(30, 7, $cases->seksyenKesalahan, 0, 2, 'L');

        $pdf->SetX(20);
        $pdf->Cell(30, 7, 'Hukuman ', 0, 0, 'L');
        $pdf->Cell(3, 7, ':', 0, 0, 'L');
        $pdf->Cell(30, 7, $cases->hukuman, 0, 2, 'L');

        $pdf->SetX(20);
        $pdf->Cell(30, 7, 'Mahkamah ', 0, 0, 'L');
        $pdf->Cell(3, 7, ':', 0, 0, 'L');
        $pdf->Cell(30, 7, $mahkamah->name, 0, 2, 'L');

        $pdf->SetX(20);
        $pdf->Cell(30, 7, 'Tarikh Dibicara ', 0, 0, 'L');
        $pdf->Cell(3, 7, ':', 0, 0, 'L');
        $pdf->Cell(60, 7, $this->tarikhReFormat($remitance->tarikhHukum), 0, 0, 'L');
        $pdf->Cell(30, 7, 'Tarikh Dibicara ', 0, 0, 'L');
        $pdf->Cell(3, 7, ':', 0, 0, 'L');
        $pdf->Cell(30, 7, $this->tarikhReFormat($remitance->tarikhHukum), 0, 2, 'L');

        $pdf->SetX(20);
        $pdf->Cell(30, 7, 'Tarikh Dihukum ', 0, 0, 'L');
        $pdf->Cell(3, 7, ':', 0, 0, 'L');
        $pdf->Cell(60, 7, $this->tarikhReFormat($remitance->tarikhHukum), 0, 0, 'L');
        $pdf->Cell(30, 7, 'Tarikh Tamat ', 0, 0, 'L');
        $pdf->Cell(3, 7, ':', 0, 0, 'L');
        $pdf->Cell(30, 7, $this->tarikhReFormat($remitance->tarikhAwal), 0, 2, 'L');


        // ############### SECTION 3 ######################

        $pdf->Line(15, 170, 210-10, 170);

        $pdf->SetXY(15, 172);
        $pdf->Cell(5, 7, "C.", 0, 0, 'L');
        $pdf->Cell(40, 7, "CIRI-CIRI FIZIKAL", 0, 1);

        $pdf->SetX(20);
        $pdf->Cell(30, 7, 'Warna Rambut ', 0, 0, 'L');
        $pdf->Cell(3, 7, ':', 0, 0, 'L');
        $pdf->Cell(60, 7, $profileExt->hairColor, 0, 0, 'L');
        $pdf->Cell(30, 7, 'Warna Kulit ', 0, 0, 'L');
        $pdf->Cell(3, 7, ':', 0, 0, 'L');
        $pdf->Cell(30, 7, $profileExt->skinColor, 0, 2, 'L');

        $pdf->SetX(20);
        $pdf->Cell(30, 7, 'Berat Badan ', 0, 0, 'L');
        $pdf->Cell(3, 7, ':', 0, 0, 'L');
        $pdf->Cell(60, 7, $profileExt->weight . ' kg', 0, 0, 'L');
        $pdf->Cell(30, 7, 'Tinggi ', 0, 0, 'L');
        $pdf->Cell(3, 7, ':', 0, 0, 'L');
        $pdf->Cell(30, 7, $profileExt->height . ' cm', 0, 2, 'L');

        $pdf->SetX(20);
        $pdf->Cell(30, 7, 'Tempat Lahir ', 0, 0, 'L');
        $pdf->Cell(3, 7, ':', 0, 0, 'L');
        $pdf->Cell(60, 7, $profileExt->placeOB, 0, 0, 'L');
        $pdf->Cell(30, 7, 'Pelajaran', 0, 0, 'L');
        $pdf->Cell(3, 7, ':', 0, 0, 'L');
        $pdf->Cell(30, 7, $profileExt->education, 0, 2, 'L');

        $pdf->SetX(20);
        $pdf->Cell(37, 7, 'Tanda-tanda Di Tubuh ', 0, 0, 'L');
        $pdf->Cell(3, 7, ':', 0, 0, 'L');
        $pdf->Cell(30, 7, $profileExt->marks, 0, 2, 'L');


        // ############### SECTION 3 ######################

        $pdf->Line(15, 209, 215-10, 209);

        $pdf->SetXY(15, 209);
        $pdf->Cell(5, 7, "C.", 0, 0, 'L');
        $pdf->Cell(40, 7, "PENGAKUAN", 0, 1);

        $pdf->SetX(20);
        $pdf->Cell(30, 5, 'Kandungan dan penerangan syarat Perintah Kehadiran Wajib telah diterangkan kepada pesalah ', 0, 2, 'L');
        $pdf->Cell(30, 5, 'dan diakui faham.', 0, 2, 'L');

        $pdf->SetXY(20, 264);
        $pdf->Cell(130, 7, "...............................................", 0, 0, 'L');
        $pdf->Cell(50, 7, "...............................................", 0, 2, 'L');

        $pdf->SetXY(20, 270);
        $pdf->Cell(130, 7, "Cop Ibu Jari Kanan Pesalah", 0, 0, 'L');
        $pdf->Cell(50, 7, "Tanda Tangan Pegawai PKW ", 0, 2, 'L');

        $pdf->SetXY(20, 275);
        $pdf->Cell(130, 7, "Tarikh : " . $this->tarikhReFormat($remitance->tarikhHukum), 0, 0, 'L');
        $pdf->Cell(50, 7, "Tarikh : " . $this->tarikhReFormat($remitance->tarikhHukum), 0, 2, 'L');








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
