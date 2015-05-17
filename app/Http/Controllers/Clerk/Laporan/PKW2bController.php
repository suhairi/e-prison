<?php namespace App\Http\Controllers\Clerk\Laporan;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class PKW2bController extends Controller {

	public function PKW2b() {

        return view('clerk.laporan.pkw2b');
    }

    public function generatePKW2b() {
        return 'here';
    }



}
