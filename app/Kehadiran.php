<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Kehadiran extends Model {

	protected $table = 'kehadiran';

    protected $fillable = ['desc', 'negeri'];

    public $timestamps = false;

}
