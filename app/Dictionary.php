<?php


namespace App;


use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Dictionary extends Model
{

    use SoftDeletes;

    protected $table = 'dictionaries';
    protected $primaryKey = 'id';

    protected $fillable = ['id', 'name'];

    public function dictionaryItems()
    {
        return $this->hasMany('App\DictionaryItem');
    }
}
