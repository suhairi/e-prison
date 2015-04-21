<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Cases extends Model {

	protected $table = 'cases';

    protected $primaryKey = 'caseNo';

    protected $fillable = ['caseNo', 'noKP', 'memoTerima', 'memoPolis', 'memoSelesai', 'noDaftar', 'tarikhDaftar'];

    public $timestamps = false;

}
