<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Mahkamah extends Model {

	protected $table = 'mahkamah';

    protected $fillable = ['name'];

    public $timestamps = false;

}
