<?php


namespace App\Repositories;


use App\Dictionary;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

class DictionaryRepository
{

    private static $instance;

    private function __construct() {}

    public static function getInstance() {
        if(self::$instance === null) {
            self::$instance = new DictionaryRepository();
        }
        return self::$instance;
    }

    public function findAll() : Builder
    {

        return Dictionary::withoutTrashed();
    }

    public function findById(Request $request) : Dictionary
    {

        return Dictionary::find($request->get('id'));
    }

    public function findByName(Request $request) : Builder
    {

        return Dictionary::where('name', $request->get('name'));
    }

    public function create(Request $request) : Dictionary
    {

        $dictionary = new Dictionary();
        $dictionary->name = $request->get('name');
        $dictionary->setCreatedAt(Carbon::now());
        $dictionary->setUpdatedAt(Carbon::now());
        $dictionary->save();
        return $dictionary;
    }

    public function update(Request $request) : Dictionary
    {

        $dictionary = Dictionary::find($request->get('id'));
        $dictionary->name = $request->get('name');
        $dictionary->setCreatedAt(Carbon::now());
        $dictionary->setUpdatedAt(Carbon::now());
        $dictionary->update();
        return $dictionary;
    }

    public function delete(Request $request) : Dictionary
    {

        $dictionary = Dictionary::find($request->get('id'));
        $dictionary->delete();
        return $dictionary;
    }

    public function findTrashed() : Builder
    {

        return Dictionary::onlyTrashed()->where('deleted_at', '!=', 'null');
    }

    public function findTrashedById(Request $request) : Collection
    {

        return Dictionary::onlyTrashed()->where('id', $request->get('id'))
            ->where('deleted_at', '!=', 'null')->get();
    }

    public function restore(Request $request) : ?Dictionary
    {

        $dictionary = Dictionary::onlyTrashed()->where('id', $request->get('id'))
            ->where('deleted_at', '!=', 'null')->first(['*']);
        if(is_null($dictionary)) return null;
        $dictionary->restore();
        return $dictionary;
    }

    public function forceDelete(Request $request) : Builder
    {

        $dictionary = Dictionary::withTrashed()->where('id', $request->get('id'));
        $dictionary->forceDelete();
        return $dictionary;
    }
}
