<?php namespace App\Http\Controllers\Admin;

use Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Input;

use App\Officer;
use App\User;

//use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Contracts\Auth\Registrar;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;

class AdminController extends Controller {

    use AuthenticatesAndRegistersUsers;

    protected $redirectPath = 'admin';


    public function __construct(Guard $auth, Registrar $registrar) {
        $this->registrar = $registrar;
        $this->auth = $auth;

        $this->middleware('auth');
        $this->middleware('userLevelOne', ['except' => 'index']);
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

    public function getRegister() {

        $users = User::orderBy('level')->paginate(10);

        return view('admin/register')
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

            return redirect('admin/register')
                ->withInput(Input::except('password'))
                ->withErrors($validation->errors());
        }

        $user = new User;

        $user->name         = strtoupper(Request::input('name'));
        $user->email        = strtolower(Request::input('email'));
        $user->password     = Hash::make(Request::Input('password'));
        $user->level        = Request::Input('level');

        if($user->save()) {
            \Session::flash('success', 'Maklumat Pengguna Sistem berjaya direkod');
        } else {
            \Session::flash('fail', 'Maklumat Pengguna Sistem Gagal direkod!!');
        }

        $users = User::orderBy('level')->paginate(10);

        return view('admin/register')
            ->with('users', $users);
    }

    public function getStaff() {

        $officers = Officer::paginate(10);

        return view('admin.staff')
            ->with('officers', $officers);
    }

    public function postStaff()
    {

        $request = Request::all();

        $validation = Validator::make($request, array(
            'name' => 'required',
            'staffId' => 'required|numeric|min:7',
            'noKP' => 'required|numeric|min:12',
            'pangkat' => 'required|min:4'
        ));

        if ($validation->fails()) {
            return redirect('admin/staff')
                ->withInput()
                ->withErrors($validation->errors());
        }

        $staff = new Officer;

        $staff->staffId = Request::input('staffId');
        $staff->noKP = Request::input('noKP');
        $staff->name = strtoupper(Request::input('name'));
        $staff->position = strtoupper(Request::input('pangkat'));

        if ($staff->save()) {
            \Session::flash('success', 'Maklumat Pegawai Berjaya direkod!');

        } else {
            \Seesion::flash('fail', 'Maklumat Pegawai Gagal Direkod!');
        }

        $officers = Officer::paginate(10);

        return view('admin/staff')
            ->with('officers', $officers);
    }





}
