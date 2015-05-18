<?php namespace App\Http\Controllers\Clerk\Laporan;

use Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Cases;
use App\Profile;

//use Illuminate\Http\Request;

use Illuminate\Contracts\Auth\Guard;
use Illuminate\Contracts\Auth\Registrar;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;

use Anouar\Fpdf\Fpdf;

class PKW4Controller extends Controller {

    use AuthenticatesAndRegistersUsers;

    protected $redirectPath = 'clerk';


    public function __construct(Guard $auth, Registrar $registrar) {
        $this->registrar = $registrar;
        $this->auth = $auth;

        $this->middleware('auth');
        $this->middleware('userLevelTwo');
    }

    public function PKW4(){

        $cases      = Cases::where('noKP', \Session::get('noPKW'))->get();

        return view('clerk.laporan.pkw4')
            ->with('cases', $cases);
    }

    public function generatePKW4() {

        if(\Session::get('noPKW') == null){

            \Session::flash('message', 'Sila buat carian No KP dahulu.');

            return view('clerk/dashboard');
        }


        $profile        = Profile::where('noKP', \Session::get('noPKW'))->first();
        $cases          = Cases::where('caseNo', \Session::get('caseNo'))->first();

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
        $pdf->Cell(195, 5, 'PKW Format 4', 0, 1, 'R');
        $pdf->Ln(5);


        // ###############     Row 1    ######################

        $pdf->SetFont('Arial', 'B', 14);
        $pdf->Cell(195, 8, 'BORANG AKU JANJI', 0, 1, 'C');
        $pdf->SetFont('Arial', 'B', 14);
        $pdf->Cell(195, 8, 'PERINTAH KEHADIRAN WAJIB (PKW)', 0, 1, 'C');
        $pdf->Ln(5);

        // ###############     Section 1    ######################

        $pdf->SetFont('Arial', '', 12);
        $pdf->Cell(15, 8, 'Saya   ', 0, 0, 'L');
        $pdf->SetFont('Arial', 'U', 12);
        $pdf->Cell(185, 8, $profile->nama, 0, 1, 'L');
        $pdf->Ln(5);

        $pdf->SetFont('Arial', '', 12);
        $pdf->Cell(45, 8, 'No. Kad Pengenalan :    ', 0, 0, 'L');
        $pdf->SetFont('Arial', 'U', 12);
        $pdf->Cell(185, 8, $profile->noKP, 0, 1, 'L');
        $pdf->Ln(5);

        $pdf->SetFont('Arial', '', 12);
        $pdf->Cell(100, 8, 'diletakkan di bawah Perintah Kehadiran Wajib oleh ', 0, 0, 'L');
        $pdf->SetFont('Arial', 'U', 12);
        $pdf->Cell(185, 8, '.....................', 0, 1, 'L');
        $pdf->Ln(5);

        $pdf->SetFont('Arial', '', 12);
        $pdf->Cell(15, 8, 'selama  ', 0, 0, 'L');
        $pdf->SetFont('Arial', 'U', 12);
        $pdf->Cell(30, 8, '.................', 0, 0, 'L');
        $pdf->Cell(30, 8, 'bermula  ', 0, 0, 'L');
        $pdf->SetFont('Arial', 'U', 12);
        $pdf->Cell(30, 8, '.................', 0, 0, 'L');
        $pdf->Cell(15, 8, 'hingga  ', 0, 0, 'L');
        $pdf->SetFont('Arial', 'U', 12);
        $pdf->Cell(30, 8, '.................', 0, 1, 'L');
        $pdf->Ln(5);

        $pdf->SetFont('Arial', '', 12);
        $pdf->Cell(10, 8, 'di ', 0, 0, 'L');
        $pdf->SetFont('Arial', 'U', 12);
        $pdf->Cell(185, 8, '.....................', 0, 1, 'L');
        $pdf->Ln(5);
        $pdf->Ln(5);

        $pdf->SetFont('Arial', '', 12);
        $pdf->Cell(100, 8, 'akan akur dengan syarat-syarat berikut :- ', 0, 0, 'L');
        $pdf->SetFont('Arial', 'U', 12);
        $pdf->Cell(185, 8, '.....................', 0, 1, 'L');
        $pdf->Ln(5);
        $pdf->Ln(5);


        // ###############     Section 2    ######################

        $pdf->SetFont('Arial', 'B', 14);
        $pdf->Cell(195, 5, 'SYARAT-SYARAT PKW', 0, 1, 'C');
        $pdf->Ln(5);
        $pdf->Ln(5);

        $pdf->SetFont('Arial', '', 12);
        $pdf->Cell(7, 8, 'i. ', 0, 0, 'L');
        $pdf->Cell(100, 8, 'Mematuhi tempoh PKW seperti yang telah ditetapkan oleh perintah mahkamah.', 0, 1, 'L');
        $pdf->Ln(5);

        $pdf->SetFont('Arial', '', 12);
        $pdf->Cell(7, 8, 'ii. ', 0, 0, 'L');
        $pdf->Cell(100, 8, 'Mematuhi setiap peraturan yang ditetapkan oleh Pusat Kehadiran Wajib.', 0, 1, 'L');
        $pdf->Ln(5);

        $pdf->SetFont('Arial', '', 12);
        $pdf->Cell(7, 8, 'iii. ', 0, 0, 'L');
        $pdf->Cell(100, 8, 'Menghadirkan diri di PKW pada tarikh dan waktu yang telah ditetapkan oleh ', 0, 2, 'L');
        $pdf->Cell(100, 8, 'Menghadirkan diri di PKW pada tarikh dan waktu yang telah ditetapkan oleh ', 0, 1, 'L');
        $pdf->Ln(5);

        $pdf->SetFont('Arial', '', 12);
        $pdf->Cell(7, 8, 'iv. ', 0, 0, 'L');
        $pdf->Cell(100, 8, 'Sekiranya gagal menjalani kerja wajib kerana masalah kesihatan, saya mestilah ', 0, 2, 'L');
        $pdf->Cell(100, 8, 'menghubungi Penyelia terlebih dahulu dan mengemukakan surat perubatan atau ', 0, 2, 'L');
        $pdf->Cell(100, 8, 'sijil sakit daripada Pegawai Perubatan Kerajaan.', 0, 1, 'L');
        $pdf->Ln(5);

        $pdf->SetFont('Arial', '', 12);
        $pdf->Cell(7, 8, 'v. ', 0, 0, 'L');
        $pdf->Cell(100, 8, 'Mengikuti arahan dan melaksanakan kerja wajib yang diberikan kepada saya oleh  ', 0, 2, 'L');
        $pdf->Cell(100, 8, 'penyelia. ', 0, 1, 'L');
        $pdf->Ln(5);

        $pdf->SetFont('Arial', '', 12);
        $pdf->Cell(7, 8, 'vi. ', 0, 0, 'L');
        $pdf->Cell(100, 8, 'Menghindarkan diri daripada melakukan apa sahaja aktiviti yang tidak bermoral,  ', 0, 2, 'L');
        $pdf->Cell(100, 8, 'jenayah dan perkara yang bertentangan dengan undang-undang semasa serta ', 0, 2, 'L');
        $pdf->Cell(100, 8, 'peraturan PKW semasa menjalankan kerja wajib; saya akan dipantau dan diselia  ', 0, 2, 'L');
        $pdf->Cell(100, 8, 'oleh Pegawai Pusat Kehadiran Wajib, Penyelia dan Pegawai Penjara yang dilantik.', 0, 1, 'L');
        $pdf->Ln(5);


        // Halaman 2

        $pdf->AddPage();

        $pdf->SetFont('Arial', '', 8);
        $pdf->SetXY(10, 10);
        $pdf->Cell(195, 5, 'PKW Format 4', 0, 1, 'R');
        $pdf->Ln(5);

        $pdf->SetFont('Arial', '', 12);
        $pdf->Cell(7, 5, 'vii. ', 0, 0, 'L');
        $pdf->Cell(100, 5, 'Menepati masa.', 0, 1, 'L');
        $pdf->Ln(5);
        $pdf->Ln(5);

        $pdf->SetFont('Arial', '', 12);
        $pdf->Cell(7, 5, 'viii. ', 0, 0, 'L');
        $pdf->Cell(100, 5, 'Berpakaian kemas dan tertib semasa menghadirkan diri di PKW dan sepanjang  ', 0, 2, 'L');
        $pdf->Cell(100, 5, 'menjalankan kerja wajib. ', 0, 1, 'L');
        $pdf->Ln(5);
        $pdf->Ln(5);

        $pdf->SetFont('Arial', '', 12);
        $pdf->Cell(7, 5, 'ix. ', 0, 0, 'L');
        $pdf->Cell(100, 5, 'Berbudi bahasa dan bersopan santun. ', 0, 1, 'L');
        $pdf->Ln(5);
        $pdf->Ln(5);

        $pdf->SetFont('Arial', '', 12);
        $pdf->Cell(7, 5, 'x. ', 0, 0, 'L');
        $pdf->Cell(100, 5, 'Tidak memilikki dan menyalahgunakan dadah, tidak merokok, minum minuman keras ', 0, 2, 'L');
        $pdf->Cell(100, 5, 'dan lain-lain bahan memabukkan serta artikel larangan. ', 0, 1, 'L');
        $pdf->Ln(5);
        $pdf->Ln(5);

        $pdf->SetFont('Arial', '', 12);
        $pdf->Cell(7, 5, 'xi. ', 0, 0, 'L');
        $pdf->Cell(100, 5, ' Menghormati pegawai dan kakitangan institusi. ', 0, 1, 'L');
        $pdf->Ln(5);
        $pdf->Ln(5);

        $pdf->SetFont('Arial', '', 12);
        $pdf->Cell(7, 5, 'xii. ', 0, 0, 'L');
        $pdf->Cell(100, 5, 'Tidak dibenarkan berhubung, menghubungi ahli keluarga atau kenalan semasa ', 0, 2, 'L');
        $pdf->Cell(100, 5, 'melaksanakan kerja wajib tanpa kebenaran penyelia / pegawai yang  dilantik. ', 0, 1, 'L');
        $pdf->Ln(5);
        $pdf->Ln(5);

        $pdf->SetFont('Arial', '', 12);
        $pdf->Cell(7, 5, 'xiii. ', 0, 0, 'L');
        $pdf->Cell(100, 5, 'Tidak membawa apa-apa bahan atau alat yang membahayakan ', 0, 1, 'L');
        $pdf->Ln(5);
        $pdf->Ln(5);

        $pdf->SetFont('Arial', '', 12);
        $pdf->Cell(7, 5, 'xiv. ', 0, 0, 'L');
        $pdf->Cell(100, 5, 'Tidak mengganggu ketenteraman penghuni. ', 0, 1, 'L');
        $pdf->Ln(5);
        $pdf->Ln(5);

        $pdf->SetFont('Arial', '', 12);
        $pdf->Cell(7, 5, 'xv. ', 0, 0, 'L');
        $pdf->Cell(100, 5, 'Tidak merosakkan harta benda kerajaan dan awam ', 0, 1, 'L');
        $pdf->Ln(5);
        $pdf->Ln(5);

        $pdf->SetFont('Arial', '', 12);
        $pdf->Cell(7, 5, 'xvi. ', 0, 0, 'L');
        $pdf->Cell(100, 5, 'Tidak boleh mempengaruhi penghuni. ', 0, 1, 'L');
        $pdf->Ln(5);
        $pdf->Ln(5);


        // ###############   Section 3   ######################

//        $pdf->SetXY(25, 160);

        $pdf->SetFont('Arial', '', 10);
        $pdf->Line(25, 233, 75, 233);
        $pdf->Line(120, 233, 183, 233);

        $pdf->SetXY(27, 233);
        $pdf->Cell(30, 5, '(Cop Ibu Jari Kanan Pesalah', 0, 2, 'L');

        $pdf->SetXY(123, 233);
        $pdf->Cell(30, 5, '(Tandatangan Peg. PKW/Penyelia)', 0, 2, 'L');



        // ################   OUTPUT #####################

        $pdf->Output("Laporan PKW Format 2 - " . \Session::get('noPKW') . ".pdf", "I");
        exit;

    }



}
