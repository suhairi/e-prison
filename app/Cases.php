<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Cases extends Model {

	protected $table = 'cases';

    protected $primaryKey = 'id';

    protected $fillable = [
        'caseNo',
        'noKP',
        'seksyenKesalahan',
        'placeArrested',
        'memoTerima',
        'memoPolis',
        'memoSelesai',
        'noDaftar',
        'officer',
        'penyelia',
        'hukuman',
        'mahkamah',
        'kehadiran',
        'tarikhDaftar'
    ];

    public $timestamps = false;

}
