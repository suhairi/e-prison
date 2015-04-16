<?php namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
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

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
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

    public function getRegister() {
        return view('admin.register');
    }

    public function postRegister(Request $request)
    {

        $validator = $this->registrar->validator($request->all());

        if ($validator->fails())
        {
            $this->throwValidationException(
                $request, $validator
            );
        }

        $this->registrar->create($request->all());

        return redirect('admin');
    }

    public function getStaff() {
        return view('admin.staff');
    }

    public function postStaff() {
        return 'postStaff';
    }





}
