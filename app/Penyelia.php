<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Penyelia extends Model {

	protected $table = 'penyelia';

    protected $fillable = ['name'];

    public $timestamps = false;

}
