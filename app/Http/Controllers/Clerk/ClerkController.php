<?php namespace App\Http\Controllers\Clerk;

use Illuminate\Support\Facades\Validator;
use Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Profile;
use App\Profileext;

//use Illuminate\Http\Request;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Contracts\Auth\Registrar;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;

class ClerkController extends Controller {

    use AuthenticatesAndRegistersUsers;

    protected $redirectPath = 'clerk';


    public function __construct(Guard $auth, Registrar $registrar) {
        $this->registrar = $registrar;
        $this->auth = $auth;

        $this->middleware('auth');
        $this->middleware('userLevelTwo');
    }

    public function index()
    {
        if($this->auth->user()->level == 1) {
            return view('admin.dashboard');
        } else if($this->auth->user()->level == 2) {
            return view('clerk.dashboard');
        } else {
            return view('auth.login');
        }

    }

    public function carian(Request $request) {

        \Session::put('noPKW', Request::input('noKP'));

        return view('clerk.dashboard');
    }


    public function getProfile() {
        return view('clerk.profile');
    }

    public function postProfile() {

        $profile = new Profile;

        $filename = Request::file('image');

        if(Request::hasFile('image')) {

            $file           = Request::file('image');
            $filename       = $file->getClientOriginalName();
            $fileExt        = $file->getClientOriginalExtension();
            $noKP           = Request::input('noKP');
            $filename       = $noKP . '.' . $fileExt;
            $destination    = public_path() . '\uploads\images';
            $profile->photo = $filename;

            $file->move($destination, $filename);
        }

        $validation = Validator::make(Request::all(),array(
                'name'      => 'required|min:3',
                'noKP'      => 'required|min:5|unique:users',
                'race'      => 'required',
                'religion'  => 'required'
        )

        );

        if($validation->fails()){

            return redirect('clerk/profile')
                ->withInput()
                ->withErrors($validation);
        }

        $profile->noKP          = Request::input('noKP');
        $profile->nama          = strtoupper(Request::input('name'));
        $profile->jobDesc       = strtoupper(Request::input('jobDesc'));
        $profile->race          = strtoupper(Request::input('race'));
        $profile->religion      = strtoupper(Request::input('religion'));
        $profile->phone         = Request::input('phone');
        $profile->maritalStatus = strtoupper(Request::input('maritalStatus'));

        if($profile->save()) {
            \Session::flash('success', 'Daftar KPW Berjaya!');
            \Session::put('noPKW', Request::input('noKP'));

        } else {
            \Session::flash('fail', 'Daftar KPW Gagal');
        }

        return view('clerk.profile');

    }

    public function getProfileExt() {
        session()->regenerate();
        return view('clerk.profileExt');
    }

    public function postProfileExt(Request $request) {

        $validation = Validator::make(Request::all(), array(
            'noKP'          => 'required',
            'hairColor'     => 'required',
            'skinColor'     => 'required',
            'weight'        => 'required',
            'placeOB'       => 'required',
            'education'     => 'required',
            'marks'         => 'required'
        ));

        if($validation->fails()) {

            return redirect('clerk/profileExt')
                ->withInput()
                ->withErrors($validation->errors());
        }

        $profileExt = new Profileext;

        $profileExt->noKP       = strtoupper(Request::input('noKP'));
        $profileExt->hairColor  = strtoupper(Request::input('hairColor'));
        $profileExt->skinColor  = strtoupper(Request::input('skinColor'));
        $profileExt->weight     = strtoupper(Request::input('weight'));
        $profileExt->placeOB    = strtoupper(Request::input('placeOB'));
        $profileExt->education  = strtoupper(Request::input('education'));
        $profileExt->marks      = strtoupper(Request::input('marks'));

        if($profileExt->save()) {

            \Session::flash('success', 'Daftar Profil Tambahan Berjaya!');
            \Session::put('noPKW', Request::input('noKP'));

        } else {

            \Session::flash('fail', 'Daftar Profil Tambahan Gagal');
        }

        return view('clerk/profileExt');
    }

    public function getCase() {
        return view('clerk/case');
    }

    public function postCase() {
        return view('clerk/case');
    }

    public function getRemitance() {
        return view('clerk/remitance');
    }

    public function postRemitance() {
        return 'postCase';
    }

    public function getParent() {
        return view('clerk/parent');
    }

    public function postParent() {
        return 'postCase';
    }

    public function getNoPKW() {
        return \Session::get('noPKW');
    }

}
