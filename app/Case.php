<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Cases extends Model {

	protected $table = 'case';
    protected $primaryKey = 'id';


    public $timestamps = false;

}
