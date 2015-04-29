<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class PusatKehadiran extends Model {

	protected $table = 'pusat_kehadiran';

    protected $fillable = ['desc', 'daerah'];

    public $timestamps = false;
}
