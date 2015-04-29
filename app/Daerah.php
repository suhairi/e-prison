<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Daerah extends Model {

	protected $table = 'daerah';

    protected $fillable = ['desc'];

    public $timestamps = false;

}
