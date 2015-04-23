<?php namespace App\Http\Controllers\Admin;

use Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Prefixes;

use Illuminate\Contracts\Auth\Guard;
use Illuminate\Contracts\Auth\Registrar;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Illuminate\Support\Facades\Validator;

class TetapanController extends Controller {

    protected $redirectPath = 'admin';


    public function __construct(Guard $auth, Registrar $registrar) {
        $this->registrar = $registrar;
        $this->auth = $auth;

        $this->middleware('auth');
        $this->middleware('userLevelOne');
    }

    public function getNoCase() {
        return view('admin/tetapan/noKes');
    }

    public function getMemoTerima() {
        return view('admin/tetapan/memoTerima');
    }

    public function getMemoPolis() {
        return view('admin/tetapan/memoPolis');
    }

	public function getMemoSelesai() {

        $prefixes = Prefixes::where('desc', 'memoSelesai')->get();

        return view('admin/tetapan/memoSelesai')
            ->with('prefixes', $prefixes);
    }

    public function postMemoSelesai() {

        $request = Request::all();

        $validation = Validator::make($request, array(
            'prefixMemoSelesai'     => 'required'
        ));

        if($validation->fails()){
            return redirect('admin/tetapan/memoSelesai')
                ->withInput()
                ->withErrors($validation->errors());
        }

        $activeMemo = Prefixes::where('status', 'active')
                            ->where('desc', 'memoSelesai')
                            ->update(['status' => 'inactive']);

        $memoSelesai = new Prefixes;

        $memoSelesai->desc      = 'memoSelesai';
        $memoSelesai->details   = Request::input('prefixMemoSelesai');
        $memoSelesai->status    = 'active';

        if($memoSelesai->save()) {
            \Session::put('success', 'Prefix No Rujukan Memo Selesai Berjaya di Rekod');
        } else {
            \Session::put('fail', 'Gagal di Rekod');
        }

        $prefixes = Prefixes::where('desc', 'memoSelesai')->get();

        return view('admin/tetapan/memoSelesai')
            ->with('prefixes', $prefixes);
    }

}
