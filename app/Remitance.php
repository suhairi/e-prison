<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Remitance extends Model {

	protected $table = 'remitance';

    protected $primaryKey = 'id';

    protected $fillable = ['caseNo', 'tarikhHukum', 'tarikhLewat', 'tarikhAwal'];

    public $timestamps = false;

}
