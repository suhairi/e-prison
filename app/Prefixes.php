<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Prefixes extends Model {

	protected $table = 'prefixes';

    protected $primaryKey = 'id';

    protected $fillable = ['desc', 'details', 'status'];

    public $timestamps = false;

}
