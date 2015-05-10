<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Penerima extends Model {

	protected $table = 'penerima';

    protected $fillable = ['name', 'organisasi', 'alamat1', 'alamat2', 'alamat3', 'alamat4', 'noTel'];

    public $timestamps = false;

}
