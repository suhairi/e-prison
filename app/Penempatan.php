<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Penempatan extends Model {

	protected $table = 'penempatan';

    protected $fillable = ['organisasi', 'namaPenuh', 'alamat1', 'alamat2', 'alamat3', 'alamat4', 'noTel', 'penempatan'];

    public $timestamps = false;

}
