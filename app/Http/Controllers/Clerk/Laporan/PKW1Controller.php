<?php namespace App\Http\Controllers\Clerk\Laporan;

use Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Contracts\Auth\Guard;
use Illuminate\Contracts\Auth\Registrar;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;

use Anouar\Fpdf\Fpdf;




class PKW1Controller extends Controller {

    use AuthenticatesAndRegistersUsers;

    protected $redirectPath = 'clerk';


    public function __construct(Guard $auth, Registrar $registrar) {
        $this->registrar = $registrar;
        $this->auth = $auth;

        $this->middleware('auth');
        $this->middleware('userLevelTwo');
    }

    public function generatePKW1() {

        if(\Session::get('noPKW') == null){

            \Session::flash('message', 'Sila buat carian No KP dahulu.');

            return view('clerk/dashboard');
        }

//        dd(\Session::get('noPKWFound'));
//
        // ###############      Settings      #############

        $pdf = new Fpdf('L','mm','A4');
        $pdf->AliasNbPages();
        $pdf->SetTitle("e-Prison - Laporan MT");
        $pdf->SetAuthor('');
        $pdf->SetMargins(10, 10, 7);

        // Halaman 1

        $pdf->AddPage();

        $pdf->SetFont('Arial', '', 8);
        $pdf->SetXY(10, 10);
        $pdf->Cell(282, 5, 'PKW Format 1', 0, 1, 'R');
        $pdf->Ln(5);

        $pdf->SetFont('Arial', 'B', 18);
        $pdf->Cell(282, 7, 'BUKU DAFTAR PKW', 0, 1, 'C');
        $pdf->SetFont('Arial', '', 14);
        $pdf->Cell(131, 6, 'DI DAERAH :', 0, 0, 'R');
        $pdf->SetFont('Arial', 'u', 14);
        $pdf->Cell(151, 6, 'BALING / SIK, KEDAH', 0, 1, 'L');
        $pdf->Ln(5);

        // ##################   BORDER, ROWS AND COLUMNS  ##################

        $pdf->SetFont('Arial', '', 10);
        $pdf->SetX(10);
        $pdf->Cell(282, 130, "", 1, 0, 'C');

        $pdf->Line(10, 60, 292, 60);            // Border
        $pdf->Line(23, 38, 293-270, 168);       // 1st Row (w:13)
        $pdf->Line(53, 38, 293-240, 168);       // 2nd Row (w: 30)
        $pdf->Line(83, 38, 293-210, 168);       // 3rd Row (w: 30)
        $pdf->Line(128, 38, 293-165, 168);      // 4th Row (w: 45)
        $pdf->Line(158, 38, 293-135, 168);      // 5th Row (w: 30)
        $pdf->Line(193, 38, 293-100, 168);      // 6th Row (w: 35)
        $pdf->Line(223, 38, 293-70, 168);       // 7th Row (w: 30)
        $pdf->Line(263, 38, 293-30, 168);       // 8th Row (w: 40)


        // ###########   COULUMN 1   ###############

        $pdf->SetXY(10, 47);
        $pdf->Cell(13, 4, "Bil", 0, 1, 'C');

        $pdf->SetY(65);
        $pdf->Cell(13, 4, "1.", 0, 1, 'C');


        // ###########   COULUMN 2   ###############

        $pdf->SetXY(23, 43);        // Line 1
        $pdf->Cell(30, 4, "Nama Pesalah/No", 0, 2, 'C');
        $pdf->Cell(30, 4, "KP/Alamat/No/", 0, 2, 'C');
        $pdf->Cell(30, 4, "Telefon", 0, 2, 'C');

        $pdf->SetXY(23, 65);        // Line 2
        $pdf->Cell(30, 4, "Nama Pesalah : ", 0, 2, 'L');
        $pdf->Cell(30, 4, "MOHD ARIF BIN ", 0, 2, 'L');
        $pdf->Cell(30, 4, "JASNI ", 0, 1, 'L');

        $pdf->SetXY(23, 90);        // Line 3
        $pdf->Cell(30, 4, "No KP : ", 0, 2, 'L');
        $pdf->Cell(30, 4, "900918-02-6209 ", 0, 1, 'L');

        $pdf->SetXY(23, 120);       //Line 4
        $pdf->Cell(30, 4, "Alamat : ", 0, 2, 'L');
        $pdf->Cell(30, 4, "Kampung ", 0, 2, 'L');
        $pdf->Cell(30, 4, "Seberang Wat, ", 0, 2, 'L');
        $pdf->Cell(30, 4, "Jln. Hospital, ", 0, 2, 'L');
        $pdf->Cell(30, 4, "Baling ", 0, 2, 'L');

        $pdf->SetXY(23, 150);       //Line 5
        $pdf->Cell(30, 4, "No. Telefon : ", 0, 2, 'L');
        $pdf->Cell(30, 4, "012-5780003 ", 0, 1, 'L');

        // ###########   COULUMN 3   ###############

        $pdf->SetXY(53, 43);
        $pdf->Cell(30, 4, "Mahkamah /", 0, 2, 'C');
        $pdf->Cell(30, 4, "No Perintah", 0, 1, 'C');


        $pdf->SetXY(53, 65);        // Line 1
        $pdf->Cell(30, 4, "Mahkamah :", 0, 2, 'L');
        $pdf->Cell(30, 4, "Mahkamah", 0, 2, 'L');
        $pdf->Cell(30, 4, "Majistret", 0, 2, 'L');
        $pdf->Cell(30, 4, "Pengkalan Hulu,", 0, 2, 'L');
        $pdf->Cell(30, 4, "Perak", 0, 1, 'L');


        $pdf->SetXY(53, 90);        // Line 2
        $pdf->Cell(30, 4, "No Kes : ", 0, 2, 'L');
        $pdf->Cell(30, 4, "83RS-01-", 0, 2, 'L');
        $pdf->Cell(30, 4, "01/2014", 0, 1, 'L');


        // ###########   COULUMN 4   ###############

        $pdf->SetXY(83, 43);
        $pdf->Cell(45, 4, "No Ruj. Fail", 0, 1, 'C');

        $pdf->SetXY(83, 65);        // Line 1
        $pdf->Cell(30, 4, "Mahkamah :", 0, 2, 'L');
        $pdf->Cell(30, 4, "PKW 0002-14-02-04", 0, 1, 'L');

        // ###########   COULUMN 5   ###############

        $pdf->SetXY(128, 40);
        $pdf->Cell(30, 4, "Tempoh ", 0, 2, 'C');
        $pdf->Cell(30, 4, "Perintah PKW / ", 0, 2, 'C');
        $pdf->Cell(30, 4, "Tarikh Mula / ", 0, 2, 'C');
        $pdf->Cell(30, 4, "Tarikh akhir ", 0, 1, 'C');


        $pdf->SetXY(128, 65);        // Line 1
        $pdf->Cell(30, 4, "Tempoh :", 0, 2, 'L');
        $pdf->Cell(30, 4, "Perintah PKW : ", 0, 2, 'L');
        $pdf->Cell(30, 4, "3 Bulan ", 0, 1, 'L');


        $pdf->SetXY(128, 90);        // Line 2
        $pdf->Cell(30, 4, "Tarikh Mula : ", 0, 2, 'L');
        $pdf->Cell(30, 4, "09/01/2014", 0, 1, 'L');

        $pdf->SetXY(128, 120);        // Line 3
        $pdf->Cell(30, 4, "Tarikh Akhir : ", 0, 2, 'L');
        $pdf->Cell(30, 4, "23/03/2014", 0, 1, 'L');

        // ###########    COULUMN 6   ###############

        $pdf->SetXY(158, 40);
        $pdf->Cell(35, 4, "Nama, alamat dan ", 0, 2, 'C');
        $pdf->Cell(35, 4, "No. Telefon waris ", 0, 2, 'C');
        $pdf->Cell(35, 4, "yang boleh ", 0, 2, 'C');
        $pdf->Cell(35, 4, "dihubungi ", 0, 1, 'C');


        $pdf->SetXY(158, 65);        // Line 1
        $pdf->Cell(35, 4, "Nama Waris :", 0, 2, 'L');
        $pdf->Cell(35, 4, "Mohd Jasni Bin ", 0, 2, 'L');
        $pdf->Cell(35, 4, "Ab Sani ", 0, 1, 'L');


        $pdf->SetXY(158, 90);        // Line 2
        $pdf->Cell(35, 4, "Alamat : ", 0, 2, 'L');
        $pdf->Cell(35, 4, "Kampung ", 0, 2, 'L');
        $pdf->Cell(35, 4, "Seberang Wat, ", 0, 2, 'L');
        $pdf->Cell(35, 4, "Jln. Hospital, ", 0, 2, 'L');
        $pdf->Cell(35, 4, "Baling ", 0, 2, 'L');

        $pdf->SetXY(158, 120);        // Line 3
        $pdf->Cell(35, 4, "No Telefon : ", 0, 2, 'L');
        $pdf->Cell(35, 4, "Tiada", 0, 1, 'L');

        // ###########    COULUMN 7   ###############

        $pdf->SetXY(193, 43);
        $pdf->Cell(30, 4, "Nama  ", 0, 2, 'C');
        $pdf->Cell(30, 4, "Penyelia ", 0, 1, 'C');

        $pdf->SetXY(193, 65);        // Line 1
        $pdf->Cell(30, 4, "Sabari Bin ", 0, 2, 'L');
        $pdf->Cell(30, 4, "Abu Bakar ", 0, 1, 'L');


        // ###########    COULUMN 8   ###############

        $pdf->SetXY(223, 43);
        $pdf->Cell(40, 4, "Nama Pegawai ", 0, 2, 'C');
        $pdf->Cell(40, 4, "penerima kes ", 0, 2, 'C');
        $pdf->Cell(40, 4, "untuk institusi ", 0, 1, 'C');


        $pdf->SetXY(223, 65);        // Line 1
        $pdf->Cell(40, 4, "Mohamad", 0, 2, 'L');
        $pdf->Cell(40, 4, "Azwan Bin ", 0, 2, 'L');
        $pdf->Cell(40, 4, "Bahari (IP) ", 0, 1, 'L');

        // ###########    COULUMN 9   ###############

        $pdf->SetXY(263, 40);
        $pdf->Cell(29, 4, "Catatan ", 0, 1, 'C');


        $pdf->SetXY(263, 65);        // Line 1
        $pdf->Cell(29, 4, "Terima", 0, 2, 'L');
        $pdf->Cell(29, 4, "Pesalah ", 0, 2, 'L');
        $pdf->Cell(29, 4, "daripada ", 0, 2, 'L');
        $pdf->Cell(29, 4, "Mahkamah ", 0, 2, 'L');
        $pdf->Cell(29, 4, "Majistret ", 0, 2, 'L');
        $pdf->Cell(29, 4, "Pengkalan ", 0, 2, 'L');
        $pdf->Cell(29, 4, "Hulu, Perak ", 0, 1, 'L');

        // ################   OUTPUT #####################

        $pdf->Output("Laporan PKW Format 1 - " . \Session::get('noPKW') . ".pdf", "I");
        exit;

    }




}
