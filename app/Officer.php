<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Officer extends Model {

	protected $table = 'officer';

    protected $primaryKey = 'staffId';

    protected $fillable = ['staffId', 'noKP', 'name', 'position'];

    public $timestamps = false;

}
