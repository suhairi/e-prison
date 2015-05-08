<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Penerima extends Model {

	protected $table = 'penerima';

    protected $fillable = ['name', 'organisasi', 'alamat', 'noTel'];

    public $timestamps = false;

}
