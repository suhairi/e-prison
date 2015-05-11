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

        // ################    GAMBAR   #######################

        $pdf->Image(public_path() . '/uploads/images/900918026209.jpg', 152, 36, 25);

        // ###############   SECTION 1   ######################

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

        $pdf->SetX(20);
        $pdf->Cell(22, 7, 'Tarikh Lahir :', 0, 0, 'L');
        $pdf->Cell(63, 7, '18/09/1990', 0, 0, 'L');
        $pdf->Cell(40, 7, 'Umur Masa masuk : ', 0, 0, 'L');
        $pdf->Cell(40, 7, '23 Thn 4 Bln', 0, 2, 'L');

        $pdf->SetX(20);
        $pdf->Cell(22, 7, 'Pekerjaan :', 0, 0, 'L');
        $pdf->Cell(63, 7, 'Pembantu kedai makan', 0, 0, 'L');
        $pdf->Cell(40, 7, 'Bekerja/Tidak Masa Ditangkap *', 0, 2, 'L');

        $pdf->SetX(20);
        $pdf->Cell(22, 7, 'Keturunan :', 0, 0, 'L');
        $pdf->Cell(63, 7, 'Melayu', 0, 0, 'L');
        $pdf->Cell(15, 7, 'Ugama : ', 0, 0, 'L');
        $pdf->Cell(40, 7, 'Islam', 0, 2, 'L');

        $pdf->SetX(20);
        $pdf->Cell(22, 7, 'Nama Waris :', 0, 0, 'L');
        $pdf->Cell(63, 7, 'Mohd Jasni Bin Ab Sani', 0, 0, 'L');
        $pdf->Cell(28, 7, 'Persaudaraan  : ', 0, 0, 'L');
        $pdf->Cell(40, 7, 'Bapa', 0, 2, 'L');

        $pdf->SetX(20);
        $pdf->Cell(58, 7, 'No. Telefon Yang Boleh Dihubungi :', 0, 0, 'L');
        $pdf->Cell(63, 7, '012-5780003', 0, 2, 'L');

        // ############### SECTION 2 ######################

        $pdf->Line(15, 110, 210-10, 110);

        $pdf->SetXY(15, 112);
        $pdf->Cell(5, 7, "B.", 0, 0, 'L');
        $pdf->Cell(40, 7, "MAKLUMAT KESALAHAN", 0, 1);

        $pdf->SetX(20);
        $pdf->Cell(42, 7, 'Alamat Masa Ditangkap :', 0, 0, 'L');
        $pdf->Cell(35, 7, 'Pengkalan Hulu, Perak', 0, 1, 'L');

        $pdf->SetX(20);
        $pdf->Cell(30, 7, 'No Waran ', 0, 0, 'L');
        $pdf->Cell(3, 7, ':', 0, 0, 'L');
        $pdf->Cell(60, 7, 'Tiada ', 0, 0, 'L');
        $pdf->Cell(30, 7, 'No. Kes ', 0, 0, 'L');
        $pdf->Cell(3, 7, ':', 0, 0, 'L');
        $pdf->Cell(30, 7, '83RS-01-01/2014 ', 0, 2, 'L');


        $pdf->SetX(20);
        $pdf->Cell(30, 7, 'Kesalahan ', 0, 0, 'L');
        $pdf->Cell(3, 7, ':', 0, 0, 'L');
        $pdf->Cell(30, 7, 'Sek 380 KK ', 0, 2, 'L');

        $pdf->SetX(20);
        $pdf->Cell(30, 7, 'Hukuman ', 0, 0, 'L');
        $pdf->Cell(3, 7, ':', 0, 0, 'L');
        $pdf->Cell(30, 7, '3 bulan dan 4 jam sehari ', 0, 2, 'L');

        $pdf->SetX(20);
        $pdf->Cell(30, 7, 'Mahkamah ', 0, 0, 'L');
        $pdf->Cell(3, 7, ':', 0, 0, 'L');
        $pdf->Cell(30, 7, 'Mahkamah Majistret Pengkalan Hulu, Perak ', 0, 2, 'L');

        $pdf->SetX(20);
        $pdf->Cell(30, 7, 'Tarikh Dibicara ', 0, 0, 'L');
        $pdf->Cell(3, 7, ':', 0, 0, 'L');
        $pdf->Cell(60, 7, '3 bulan dan 4 jam sehari ', 0, 0, 'L');
        $pdf->Cell(30, 7, 'Tarikh Dibicara ', 0, 0, 'L');
        $pdf->Cell(3, 7, ':', 0, 0, 'L');
        $pdf->Cell(30, 7, '3 bulan dan 4 jam sehari ', 0, 2, 'L');


        // ############### SECTION 3 ######################

        $pdf->Line(15, 164, 210-10, 164);

        $pdf->SetXY(15, 166);
        $pdf->Cell(5, 7, "C.", 0, 0, 'L');
        $pdf->Cell(40, 7, "CIRI-CIRI FIZIKAL", 0, 1);

        $pdf->SetX(20);
        $pdf->Cell(30, 7, 'Warna Rambut ', 0, 0, 'L');
        $pdf->Cell(3, 7, ':', 0, 0, 'L');
        $pdf->Cell(60, 7, 'Hitam ', 0, 0, 'L');
        $pdf->Cell(30, 7, 'Warna Kulit ', 0, 0, 'L');
        $pdf->Cell(3, 7, ':', 0, 0, 'L');
        $pdf->Cell(30, 7, 'Hitam Manis ', 0, 2, 'L');

        $pdf->SetX(20);
        $pdf->Cell(30, 7, 'Berat Badan ', 0, 0, 'L');
        $pdf->Cell(3, 7, ':', 0, 0, 'L');
        $pdf->Cell(60, 7, '51 KG ', 0, 0, 'L');
        $pdf->Cell(30, 7, 'Tinggi ', 0, 0, 'L');
        $pdf->Cell(3, 7, ':', 0, 0, 'L');
        $pdf->Cell(30, 7, '163 cm', 0, 2, 'L');

        $pdf->SetX(20);
        $pdf->Cell(30, 7, 'Tempat Lahir ', 0, 0, 'L');
        $pdf->Cell(3, 7, ':', 0, 0, 'L');
        $pdf->Cell(60, 7, 'Hospital Daerah Baling, Kedah ', 0, 0, 'L');
        $pdf->Cell(30, 7, 'Pelajaran', 0, 0, 'L');
        $pdf->Cell(3, 7, ':', 0, 0, 'L');
        $pdf->Cell(30, 7, 'Tingkatan 5', 0, 2, 'L');

        $pdf->SetX(20);
        $pdf->Cell(37, 7, 'Tanda-tanda Di Tubuh ', 0, 0, 'L');
        $pdf->Cell(3, 7, ':', 0, 0, 'L');
        $pdf->Cell(30, 7, 'Parut cacar di lengan kiri dan parut luka dibawah lengan kiri', 0, 2, 'L');


        // ############### SECTION 3 ######################

        $pdf->Line(15, 204, 215-10, 204);

        $pdf->SetXY(15, 205);
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
        $pdf->Cell(130, 7, "Tarikh : 09/01/2014", 0, 0, 'L');
        $pdf->Cell(50, 7, "Tarikh : 09/01/2014", 0, 2, 'L');








        // ################   OUTPUT #####################

        $pdf->Output("Laporan PKW Format 2 - " . \Session::get('noPKW') . ".pdf", "I");
        exit;

    }




}
