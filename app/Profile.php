<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model {

	protected $table = 'profile';

    protected $primaryKey = 'noKP';

    protected $fillable = ['noKP', 'nama', 'jobDesc', 'race', 'religion', 'phone', 'maritalStatus', 'photo'];

    public $timestamps = false;



}
