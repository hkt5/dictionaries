<?php


namespace App\Repositories;


use App\Dictionary;
use Carbon\Carbon;
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

    public function findAll()
    {

        return Dictionary::withoutTrashed();
    }

    public function findById(Request $request)
    {

        return Dictionary::find($request->get('id'));
    }

    public function findByName(Request $request)
    {

        return Dictionary::where('name', $request->get('name'));
    }

    public function create(Request $request)
    {

        $dictionary = new Dictionary();
        $dictionary->name = $request->get('name');
        $dictionary->setCreatedAt(Carbon::now());
        $dictionary->setUpdatedAt(Carbon::now());
        $dictionary->save();
        return $dictionary;
    }

    public function update(Request $request)
    {

        $dictionary = Dictionary::find($request->get('id'));
        $dictionary->name = $request->get('name');
        $dictionary->setCreatedAt(Carbon::now());
        $dictionary->setUpdatedAt(Carbon::now());
        $dictionary->update();
        return $dictionary;
    }

    public function delete(Request $request)
    {

        $dictionary = Dictionary::find($request->get('id'));
        $dictionary->delete();
        return $dictionary;
    }

    public function findTrashed()
    {

        return Dictionary::withTrashed();
    }

    public function findTrashedById(Request $request)
    {

        return Dictionary::withTrashed()->where('id', $request->get('id'))->get();
    }

    public function restore(Request $request)
    {

        $dictionary = Dictionary::withTrashed()->where('id', $request->get('id'));
        $dictionary->restore();
        return $dictionary;
    }

    public function forceDelete(Request $request)
    {

        $dictionary = Dictionary::withTrashed()->where('id', $request->get('id'));
        $dictionary->forceDelete();
        return $dictionary;
    }
}
