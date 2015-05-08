<?php namespace App\Http\Controllers\Clerk;

use Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Kehadiran;
use App\Cases;
use App\Officer;
use App\Penempatan;
use App\Penerima;


class AjaxController extends Controller {

    public function ajax() {}

	public function getNegeri($id) {

        if(Request::ajax()) {
            if($id != '') {

//                dd($id);

                $kehadiran = Kehadiran::find($id);

                $output = $kehadiran->negeri;

                return $output;
            }
        }
    }

    public function getDaerah($id) {

        if(Request::ajax()) {
            if($id != '') {

//                dd($id);

                $kehadiran = Kehadiran::find($id);

                $output = $kehadiran->desc;

                return $output;
            }
        }
    }

    public function getTarikh($id) {

        if(Request::ajax()) {
            if($id != '') {

                $case = Cases::find($id);

                $output2 = $case->tarikhMasuk;

                $output = explode('-', $output2);

                $output = $output[2] . '-' . $output[1] . '-' . $output[0];

                return $output;
            }
        }
    }

    public function getNoDaftar($id) {

        if(Request::ajax()) {
            if($id != '') {

                $case = Cases::find($id);

                $output = $case->noDaftar;

                return $output;
            }
        }
    }

    public function getNoKes($id) {

        if(Request::ajax()) {
            if($id != '') {

                $case = Cases::find($id);

                $output = $case->memoTerima;

                return $output;
            }
        }
    }

    public function getNamaPengirim($id) {

        if(Request::ajax()) {
            if($id != '') {

                $pengirim = Officer::find($id);

                $output = $pengirim->name;

                return $output;
            }
        }
    }

    public function getOrganisasiPengirim($id) {

        if(Request::ajax()) {
            if($id != '') {

                $pengirim = Officer::find($id);

                $output = Penempatan::find($pengirim->penempatan);

                $output = $output->organisasi;

                return $output;
            }
        }
    }

    public function getAlamatPengirim($id) {

        if(Request::ajax()) {
            if($id != '') {

                $pengirim = Officer::find($id);

                $output = Penempatan::find($pengirim->penempatan);

                $output = $output->alamat;

                return $output;
            }
        }
    }

    public function getNoTelPengirim($id) {

        if(Request::ajax()) {
            if($id != '') {

                $pengirim = Officer::find($id);

                $output = Penempatan::find($pengirim->penempatan);

                $output = $output->noTel;

                return $output;
            }
        }
    }

    public function getOrganisasiPenerima($id) {

        if(Request::ajax()) {
            if($id != '') {

                $penerima = Penerima::find($id);

                $output = $penerima->organisasi;

                return $output;
            }
        }
    }


}
