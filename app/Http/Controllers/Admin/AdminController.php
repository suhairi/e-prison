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







}
