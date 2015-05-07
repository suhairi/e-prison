<?php namespace App\Http\Controllers\Clerk;

use Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Cases;
use App\Profile;
use App\Kehadiran;

use Illuminate\Contracts\Auth\Guard;
use Illuminate\Contracts\Auth\Registrar;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;


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

        if(!\Session::get('noPKWFound')) {

            \Session::flash('message', 'Sila buat carian No KP dahulu');
            return view('clerk\dashboard');

        }


        $cases      = Cases::where('noKP', \Session::get('noPKW'))->get();

//        foreach($cases as $case) {
//            var_dump($case->memoTerima);
//        }
        $profile    = Profile::where('noKP', \Session::get('noPKW'))->first();
        $kehadirans  = Kehadiran::all();

//        $tarikhMasuk = explode('-', $cases->tarikhMasuk);
//
//        $tarikhMasuk =  $tarikhMasuk[2] . '/' . $tarikhMasuk[1] . '/' . $tarikhMasuk[0];

        return view('clerk/laporan/mt')
            ->with('cases', $cases)
            ->with('profile', $profile)
            ->with('kehadirans', $kehadirans);
    }

    public function postOne() {

        return 'here';

    }

}
