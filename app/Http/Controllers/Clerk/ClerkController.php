<?php namespace App\Http\Controllers\Clerk;

use Illuminate\Support\Facades\Validator;
use Request;
use App\Http\Requests;

use App\Http\Controllers\Controller;
use App\Profile;
use App\Profileext;
use App\Cases;
use App\Prefixes;
use App\Parents;
use App\Remitance;
use App\User;
use App\Mahkamah;
use App\Officer;

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

            \Session::forget('noPKW');

            return view('clerk.dashboard');
        } else {
            return view('auth.login');
        }

    }

    public function carian() {

        $profiles = Profile::where('noKP', Request::input('noKP'))->get();

        \Session::put('noPKWFound', false);
        \Session::flash('carian', true);
        \Session::put('noPKW', '');

        if(count($profiles) > 0) {
            foreach($profiles as $profile) {
                \Session::put('noPKW', $profile->noKP);
                \Session::put('noPKWFound', true);
            }
        }


        $cases = Cases::where('noKP', '=', Request::input('noKP'))->get();

        foreach($cases as $case) {
            \Session::put('caseNo', $case->caseNo);
        }

        return view('clerk.dashboard')
            ->with('profiles', $profiles)
            ->with('cases', $cases);
    }

    public function getProfile() {
        return view('clerk.profile');
    }

    public function postProfile() {

        $profile = new Profile;

        $filename = Request::file('image');

        if(Request::hasFile('image')) {

            $file           = Request::file('image');
            $fileExt        = strtolower($file->getClientOriginalExtension());
            $filename       = Request::input('noKP') . '.' . $fileExt;
            $destination    = public_path() . '\uploads\images';
            $profile->photo = $filename;

            $file->move($destination, $filename);
        }

        $validation = Validator::make(Request::all(), array(
            'name'      => 'required|min:3',
            'noKP'      => 'required|min:5',
            'race'      => 'required',
            'religion'  => 'required'
        ));

        if($validation->fails()) {
            return redirect('clerk/profile')
                ->withInput()
                ->withErrors($validation->errors());
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
            \Session::flash('fail', 'Daftar PKW Gagal');
        }

        return view('clerk/profileExt');
    }

    public function getProfileExt() {

        if(!\Session::get('noPKWFound')){

            \Session::flash('message', 'Sila buat carian No KP dahulu.');

            return view('clerk/dashboard');
        }

        return view('clerk.profileExt');
    }

    public function postProfileExt() {

        $validation = Validator::make(Request::all(), array(
            'noKP'          => 'required',
            'hairColor'     => 'required',
            'skinColor'     => 'required',
            'weight'        => 'required|numeric',
            'height'        => 'required|numeric',
            'placeOB'       => 'required',
            'education'     => 'required',
            'marks'         => 'required',
            'bodyMarks'     => 'required'
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
        $profileExt->weight     = Request::input('weight');
        $profileExt->weight     = Request::input('height');
        $profileExt->placeOB    = strtoupper(Request::input('placeOB'));
        $profileExt->education  = strtoupper(Request::input('education'));
        $profileExt->marks      = strtoupper(Request::input('marks'));
        $profileExt->bodyMarks      = strtoupper(Request::input('bodyMarks'));


        if($profileExt->save()) {

            \Session::flash('success', 'Daftar Profil Tambahan Berjaya!');
            \Session::put('noPKW', Request::input('noKP'));

        } else {

            \Session::flash('fail', 'Daftar Profil Tambahan Gagal');
        }

        $prefixes = Prefixes::where('status', 'active')->get();

        return view('clerk/case')
            ->with('prefixes', $prefixes);
    }

    public function getCase() {

        if(!\Session::get('noPKWFound')){

            \Session::flash('message', 'Sila buat carian No KP dahulu.');

            return view('clerk/dashboard');
        }

        $cases      = Cases::where('noKP', \Session::get('noPKW'))->get();
        $mahkamahs  = Mahkamah::all();
        $officers   = Officer::all();
        $penyelias  = Penyelia::all();

        \Session::flash('message', 'Profil ini mempunyai ' . count($cases) . ' rekod kes lampau.');

        $prefixes = Prefixes::where('status', 'active')->get();


        return view('clerk/case')
            ->with('prefixes', $prefixes)
            ->with('mahkamahs', $mahkamahs)
            ->with('officers', $officers);
    }

    public function postCase() {

        $request = Request::all();

        dd($request);

        $validation = Validator::make($request, array(
            'noKes'             => 'required',
            'noKP'              => 'required|numeric',
            'memoTerima'        => 'required',
            'memoPolis'         => 'required',
            'memoSelesai'       => 'required',
            'noDaftar'          => 'required',
            'tarikhDaftar'      => 'required',
            'officer'           => 'required',
            'hukuman'           => 'required',
            'mahkamah'          => 'required',
            'seksyenKesalahan'  => 'required'

        ));

        if($validation->fails()) {
            return redirect('clerk/case')
                ->withInput()
                ->withErrors($validation->errors());
        }

        $prefixes = Prefixes::where('status', 'active')->get();

        $case = new Cases;

        $case->noKP             = Request::input('noKP');
        $case->caseNo           = Request::input('noKes');
        $case->seksyenKesalahan = Request::input('seksyenKesalahan');

        foreach($prefixes as $prefix) {
            if($prefix->desc == 'memoTerima')
                $case->memoTerima   = $prefix->details . '(' . Request::input('memoTerima') . ')';
        }

        foreach($prefixes as $prefix) {
            if($prefix->desc == 'memoPolis')
                $case->memoPolis    = $prefix->details . '(' . Request::input('memoPolis') . ')';
        }

        foreach($prefixes as $prefix) {
            if($prefix->desc == 'memoSelesai')
                $case->memoSelesai  = $prefix->details . '(' . Request::input('memoSelesai') . ')';
        }

        $tarikhDaftar = explode('/', Request::input('tarikhDaftar'));
        $tarikhDaftar = $tarikhDaftar[2] . '-' . $tarikhDaftar[0] . '-' . $tarikhDaftar[1];

        $case->noDaftar     = strtoupper(Request::input('noDaftar'));
        $case->hukuman      = strtoupper(Request::input('hukuman'));
        $case->mahkamah     = Request::input('mahkamah');
        $case->officer      = Request::input('officer');
        $case->tarikhMasuk  = $tarikhDaftar;

        if($case->save()) {

            \Session::flash('success', 'Daftar Maklumat Kes Berjaya!');
            \Session::put('caseNo', Request::input('noKes'));

        } else {

            \Session::flash('fail', 'Daftar Maklumat Kes Gagal');
        }

        $cases = Cases::where('caseNo', \Session::get('caseNo'))->get();
        foreach($cases as $case){

            $tarikhMasuk = explode('-', $case->tarikhMasuk);

            $tarikhMasuk = $tarikhMasuk[1] . '/' . $tarikhMasuk[2] . '/' . $tarikhMasuk[0];

            \Session::put('tarikhMasuk', $tarikhMasuk);
        }

        return view('clerk/remitance')
            ->with('prefixes', $prefixes);

    }

    public function getRemitance() {

        if(!\Session::get('noPKWFound')){

            \Session::flash('message', 'Sila buat carian No KP dahulu.');

            return view('clerk/dashboard');
        }

        $cases = Cases::where('caseNo', \Session::get('caseNo'))->get();

        foreach($cases as $case){

            $tarikhMasuk = explode('-', $case->tarikhMasuk);

            $tarikhMasuk = $tarikhMasuk[1] . '/' . $tarikhMasuk[2] . '/' . $tarikhMasuk[0];

            \Session::put('tarikhMasuk', $tarikhMasuk);
        }

        return view('clerk/remitance');
    }

    public function postRemitance() {

        $request = Request::all();

        $validation = Validator::make($request, array(
            'noKP'          => 'required|numeric',
            'caseNo'        => 'required',
            'hukuman'       => 'required',
            'tarikhHukum'   => 'required|date',
            'tarikhLewat'   => 'required|date',
            'tarikhAwal'    => 'required|date'
        ));

        if($validation->fails()) {
            return redirect('clerk/remitance')
                ->withInput()
                ->withErrors($validation->errors());
        }

        $remitance = new Remitance;

        /*
         *  To satisfy the date format in MySQL
         *  MySQL format        : yyyy-mm-dd
         *  Input form format   : mm/dd/yyyy
         */

//        dd($request);
        $tarikhHukum = explode('/', Request::input('tarikhHukum'));
        $tarikhHukum[0] = $tarikhHukum[0] + Request::input('hukuman');
        $tarikhHukum = $tarikhHukum[2] . '-' . $tarikhHukum[0] . '-' . $tarikhHukum[1];

        $tarikhLewat = explode('/', Request::input('tarikhLewat'));
        $tarikhLewat = $tarikhLewat[2] . '-' . $tarikhLewat[0] . '-' . $tarikhLewat[1];

        $tarikhAwal = explode('/', Request::input('tarikhAwal'));
        $tarikhAwal = $tarikhAwal[2] . '-' . $tarikhAwal[0] . '-' . $tarikhAwal[1];


        $remitance->caseNo          = Request::input('caseNo');
        $remitance->tarikhHukum     = $tarikhHukum;
        $remitance->tarikhLewat     = $tarikhLewat;
        $remitance->tarikhAwal      = $tarikhAwal;

        if($remitance->save()){
            \Session::put('success', 'Maklumat Remitan berjaya direkod');
        } else {
            \Session::put('fail', 'Maklumat Remitan Gagal direkod');
        }

        return view('clerk/parent');
    }

    public function getParent() {
        if(!\Session::get('noPKWFound')){

            \Session::flash('message', 'Sila buat carian No KP dahulu.');

            return view('clerk/dashboard');
        }

        return view('clerk/parent');
    }

    public function postParent() {
        $request = Request::all();

        $validation = Validator::make($request, array(
            'noKP'          => 'required|numeric',
            'name'          => 'required',
            'noKPParent'    => 'required|numeric',
            'relationship'  => 'required',
            'address'       => 'required|min:5',
        ));

        if($validation->fails()) {
            return redirect('clerk/parent')
                ->withInput()
                ->withErrors($validation->errors());
        }

        $parent = new Parents;

        $parent->noKP           = Request::input('noKP');
        $parent->noKPParent     = Request::input('noKPParent');
        $parent->name           = Request::input('name');
        $parent->relationship   = Request::input('relationship');
        $parent->address        = Request::input('address');
        $parent->phone          = Request::input('phone');

        if($parent->save()) {

            \Session::flash('success', 'Daftar Maklumat Waris Berjaya!');
        } else {
            \Session::flash('fail', 'Daftar Maklumat Waris Gagal');
        }

        return redirect('clerk/lapoarn/1');
    }


}
