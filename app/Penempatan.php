<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Penempatan extends Model {

	protected $table = 'penempatan';

    protected $fillable = ['organisasi', 'namaPenuh', 'alamat', 'noTel', 'penempatan'];

    public $timestamps = false;

}
