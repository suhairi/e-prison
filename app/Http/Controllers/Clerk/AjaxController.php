<?php namespace App\Http\Controllers\Clerk;

use Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Kehadiran;
use App\Cases;


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

}
