<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Parents extends Model {

    protected $table = 'parent';

    protected $primaryKey = 'id';

    protected $fillable = ['noKP', 'noKPParent', 'name', 'relationship', 'address', 'phone'];

    public $timestamps = false;

}
