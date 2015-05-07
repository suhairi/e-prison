<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Cases extends Model {

	protected $table = 'cases';

    protected $primaryKey = 'id';

    protected $fillable = ['caseNo', 'noKP', 'memoTerima', 'memoPolis', 'memoSelesai', 'noDaftar', 'hukuman', 'tarikhDaftar'];

    public $timestamps = false;

}
