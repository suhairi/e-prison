<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Profileext extends Model {

	protected $table = 'profileext';

    protected $primaryKey = 'noKP';

    protected $fillable = ['noKP', 'hairColor', 'skinColor', 'weight', 'height', 'placeOB', 'education', 'marks'];

    public $timestamps = false;

}
