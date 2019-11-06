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

    public int $id;
    public string $name;
    private Carbon $created_at;
    private Carbon $updated_at;
    private Carbon $deleted_at;
}
