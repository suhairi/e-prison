<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Penempatan extends Model {

	protected $table = 'penempatan';

    protected $fillable = ['organisasi', 'alamat', 'noTel'];

    public $timestamps = false;

}
