<?php


namespace App;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DictionaryItem extends Model
{

    use SoftDeletes;

    protected $table = 'dictionary_items';
    protected $primaryKey = 'id';

    protected $fillable = ['id', 'name', 'dictionary_id'];
}
