<?php namespace App\Http\Controllers\Admin;

use Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Input;

use App\Officer;
use App\User;
use App\Penempatan;
use App\Mahkamah;

//use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Contracts\Auth\Registrar;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;

class TetapanController extends Controller {

    protected $redirectPath = 'admin';

    public function __construct(Guard $auth, Registrar $registrar) {
        $this->registrar = $registrar;
        $this->auth = $auth;

        $this->middleware('auth');
        $this->middleware('userLevelOne');
    }

    public function getRegister() {

        $users = User::orderBy('level')->paginate(10);

        return view('admin/tetapan/register')
            ->with('users', $users);
    }

    public function postRegister() {

        $request = Request::all();

        $validation = Validator::make($request, array(
            'name'                  => 'required',
            'email'                 => 'required|email',
            'password'              => 'required|min:3',
            'password_confirmation' => 'required|same:password',
            'level'                 => 'required'
        ));

        if ($validation->fails()) {

            return redirect('admin/tetapan/register')
                ->withInput(Input::except('password'))
                ->withErrors($validation->errors());
        }

        $user = new User;

        $user->name         = Request::input('name');
        $user->email        = strtolower(Request::input('email'));
        $user->password     = Hash::make(Request::Input('password'));
        $user->level        = Request::Input('level');

        if($user->save()) {
            \Session::flash('success', 'Maklumat Pengguna Sistem berjaya direkod');
        } else {
            \Session::flash('fail', 'Maklumat Pengguna Sistem Gagal direkod!!');
        }

        $users = User::orderBy('level')->paginate(10);

        return view('admin/tetapan/register')
            ->with('users', $users);
    }

    public function deleteRegister($id) {

        $user = User::find($id);

        if($user->delete()) {
            \Session::flash('success', 'Berjaya Dihapus');
        } else {
            \Session::flash('fail', 'Gagal Dihapus');
        }

        $users = User::orderBy('level')->paginate(10);

        return view('admin/tetapan/register')
            ->with('users', $users);


    }

    public function getStaff() {

        $officers = Officer::paginate(10);
        $penempatans = Penempatan::all();

        return view('admin/tetapan/staff')
            ->with('officers', $officers)
            ->with('penempatans', $penempatans);
    }

    public function postStaff() {

        $request = Request::all();

        $validation = Validator::make($request, array(
            'name'          => 'required',
            'staffId'       => 'required|numeric|min:7',
            'noKP'          => 'required|numeric|min:12',
            'pangkat'       => 'required',
            'penempatan'    => 'required'
        ));

        if ($validation->fails()) {
            return redirect('admin/staff')
                ->withInput()
                ->withErrors($validation->errors());
        }

        $staff = new Officer;

        $staff->staffId     = Request::input('staffId');
        $staff->noKP        = Request::input('noKP');
        $staff->name        = strtoupper(Request::input('name'));
        $staff->position    = strtoupper(Request::input('pangkat'));
        $staff->penempatan  = Request::input('penempatan');

        if ($staff->save()) {
            \Session::flash('success', 'Maklumat Pegawai Berjaya direkod!');

        } else {
            \Seesion::flash('fail', 'Maklumat Pegawai Gagal Direkod!');
        }

        $officers = Officer::paginate(10);
        $penempatans = Penempatan::all();

        return view('admin/tetapan/staff')
            ->with('officers', $officers);
    }

    public function kemaskiniStaff($id) {

        $officer = Officer::find($id);

        if(count($officer) <= 0) {
            \Session::flash('fail', 'Ralat kemaskini!');

            return redirect('admin/staff');
        }

        return view('admin/tetapan/kemaskiniStaff')
            ->with('officer', $officer);
    }

    public function deleteStaff($id) {

        $staff = Officer::find($id);

        if($staff->delete()) {
            \Session::flash('success', 'Berjaya Dihapus');
        } else {
            \Session::flash('fail', 'Gagal Dihapus');
        }

        $officers = Officer::paginate(10);

        return view('admin/tetapan/staff')
            ->with('officers', $officers);
    }

    public function getPenempatan() {

        $penempatans = Penempatan::paginate(10);

        return view('admin/tetapan/penempatan')
            ->with('penempatans', $penempatans);
    }

    public function postPenempatan() {

        $input = Request::all();

        $validation = Validator::make($input, array(
            'organisasi'    => 'required',
            'alamat'        => 'required',
            'noTel'         => 'required'
        ));

        if($validation->fails()) {
            return redirect('admin\tetapan\penempatan')
                ->withInputs()
                ->withErrors($validation);
        }

        $penempatan = new Penempatan;

        $penempatan->organisasi = Request::input('organisasi');
        $penempatan->alamat     = Request::input('alamat');
        $penempatan->noTel      = Request::input('noTel');

        if($penempatan->save()) {
            \Session::flash('success', 'Berjaya Direkod');
        } else {
            \Session::flash('fail', 'Gagal Direkod');
        }

        $penempatans = Penempatan::paginate(10);

        return view('admin/tetapan/penempatan')
            ->with('penempatans', $penempatans);

    }

    public function deletePenempatan($id) {

        $penempatan = Penempatan::find($id);

        if($penempatan->delete()){
            \Session::flash('success', 'Berjaya Dihapus.');
        } else {
            \Session::flash('fail', 'Gagal Dihapus');
        }

        $penempatans = Penempatan::paginate(10);

        return view('admin/tetapan/penempatan')
            ->with('penempatans', $penempatans);
    }

    public function kemaskiniPenempatan($id) {

        $penempatan = Penempatan::find($id);

        if(count($penempatan) <= 0) {
            \Session::flash('fail', 'Ralat Kemaskini!');

            return redirect('admin/penempatan');
        }

        return view('admin/tetapan/kemaskiniPenempatan')
            ->with('penempatans', $penempatan);
    }

    public function postKemaskiniPenempatan($id) {

        $penempatan = Penempatan::find($id);

        $penempatan->organisasi = Request::input('organisasi');
        $penempatan->alamat     = Request::input('alamat');
        $penempatan->noTel      = Request::input('noTel');

        if($penempatan->save()) {
            \Session::flash('success', 'Berjaya Dikemaskini');
        } else {
            \Session::flash('fail', 'Gagal Dikemaskini');
        }

        $penempatans = Penempatan::paginate(10);

        return view('admin/tetapan/penempatan')
            ->with('penempatans', $penempatans);
    }

    public function getMahkamah() {

        $mahkamahs = Mahkamah::paginate(10);

        return view('admin/tetapan/mahkamah', compact('mahkamahs'));
    }

    public function postMahkamah() {

        //validation
        $input = Request::all();

        $validation = Validator::make($input, array(
            'mahkamah'    => 'required|min:15'
        ));

        if($validation->fails()) {
            return redirect('admin/mahkamah')
                ->withInputs($input)
                ->withErrors($validation);
        }

        $mahkamah = new Mahkamah;

        $mahkamah->name = Request::input('mahkamah');

        if($mahkamah->save()){
            \Session::flash('success', 'Berjaya Direkod');
        } else {
            \Session::flash('fail', 'Gagal Direkod');
        }

        $mahkamahs = Mahkamah::paginate(10);

        return view('admin.tetapan.mahkamah', compact('mahkamahs'));

    }

    public function kemaskiniMahkamah($id) {
        $mahkamahs = Mahkamah::find($id);

        return $mahkamahs;
    }

    public function deleteMahkamah($id) {

        $mahkamahs = Mahkamah::findOrFail($id);

        if($mahkamahs->delete()){
            \Session::flash('success', 'Berjaya Dihapus.');
        } else {
            \Session::flash('fail', 'Gagal Dihapus');
        }

        $mahkamahs = Mahkamah::paginate(10);

        return view('admin/tetapan/mahkamah', compact('mahkamahs'));
    }



}
