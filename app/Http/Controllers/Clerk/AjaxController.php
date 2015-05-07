<?php namespace App\Http\Controllers\Clerk;

use Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Kehadiran;


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

    public function getTarikh() {

        $id = Request::input('data');
        console.log(Request::input('data'));
        if(Request::ajax()) {
            if($id != '') {

                $case = Cases::find($id);

                $output = $case->tarikhMasuk;

                console.log($output);
            }
        }
    }

}
