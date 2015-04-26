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

        $prefixes = Prefixes::where('desc', 'memoTerima')->orderBy('status')->get();

        return view('admin/tetapan/memoTerima')
            ->with('prefixes', $prefixes);
    }

    public function postMemoTerima() {

        $request = Request::all();

        $validation = Validator::make($request, array(
            'prefixMemoTerima'  => 'required|min:10'
        ));

        if($validation->fails()) {
            return redirect('admin/prefix-memo-terima')
                ->withInput()
                ->withErrors($validation->errors());
        }

        $activeMemo = Prefixes::where('status', 'active')
            ->where('desc', 'memoSelesai')
            ->update(['status' => 'inactive']);

        $prefix = new Prefixes;

        $prefix->desc       = 'memoTerima';
        $prefix->details    = strtoupper(Request::input('prefixMemoTerima'));
        $prefix->status     = 'active';

        if($prefix->save()) {
            \Session::flash('success', 'Prefix No Rujukan Memo Terima berjaya direkod');
        } else {
            \Session::flash('fail', 'Prefix No Rujukan Memo Terima gagal direkod');
        }

        $prefixes = Prefixes::where('desc', 'memoTerima')->orderBy('status')->get();

        return view('admin/tetapan/memoTerima')
            ->with('prefixes', $prefixes);

    }

    public function getMemoPolis() {

        $prefixes = Prefixes::where('desc', 'memoPolis')->orderBy('status')->get();

        return view('admin/tetapan/memoPolis')
            ->with('prefixes', $prefixes);
    }

    public function postMemoPolis() {

        $request = Request::all();



        $validation = Validator::make($request, array(
            'prefixMemoPolis'   => 'required|min:10'
        ));

        if($validation->fails()) {
            return redirect('admin\prefix-memo-polis')
                ->withInput()
                ->withErrors($validation->errors());
        }

//        dd($request);

        $activeMemo = Prefixes::where('status', 'active')
            ->where('desc', 'memoPolis')
            ->update(['status' => 'inactive']);

        $prefix = new Prefixes;

        $prefix->desc       = 'memoPolis';
        $prefix->details    = strtoupper(Request::input('prefixMemoPolis'));
        $prefix->status     = 'active';

        if($prefix->save()) {
            \Session::flash('success', 'Prefix No Rujukan Memo Polis berjaya direkod');
        } else {
            \Session::flash('fail', 'Prefix No Rujukan Memo Terima berjaya direkod');
        }

        $prefixes = Prefixes::where('desc', 'memoPolis')->orderBy('status')->get();

        return view('admin/tetapan/memoPolis')
            ->with('prefixes', $prefixes);
    }


	public function getMemoSelesai() {

        $prefixes = Prefixes::where('desc', 'memoSelesai')->orderBy('status')->get();

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
            \Session::flash('success', 'Prefix No Rujukan Memo Selesai Berjaya di Rekod');
        } else {
            \Session::flash('fail', 'Gagal di Rekod');
        }

        $prefixes = Prefixes::where('desc', 'memoSelesai')->orderBy('active')->get();

        return view('admin/tetapan/memoSelesai')
            ->with('prefixes', $prefixes);
    }

}
