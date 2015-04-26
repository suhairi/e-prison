<?php namespace App\Http\Controllers\Clerk;

use Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Cases;
use App\Profile;

//use Illuminate\Http\Request;

class LaporanController extends Controller {

	public function getOne() {

        $cases = Cases::where('noKP', \Session::get('noPKW'))->first();
        $profile = Profile::where('noKP', \Session::get('noPKW'))->first();

        return view('clerk/laporan/mt')
            ->with('cases', $cases)
            ->with('profile', $profile);
    }

}
