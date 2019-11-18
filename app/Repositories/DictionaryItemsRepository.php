<?php


namespace App\Repositories;


use App\DictionaryItem;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class DictionaryItemsRepository
{

    private static $instance;

    private function __construct() {}

    public static function getInstance() {
        if(self::$instance === null) {
            self::$instance = new DictionaryItemsRepository();
        }
        return self::$instance;
    }

    public function findAll() : Builder
    {

        return DictionaryItem::withoutTrashed();
    }

    public function findById(Request $request) : DictionaryItem
    {

        return DictionaryItem::find($request->get('id'));
    }

    public function findByName(Request $request) : Builder
    {

        return DictionaryItem::where('name', $request->get('name'));
    }

    public function create(Request $request) : DictionaryItem
    {

        $dictionary_item = new DictionaryItem();
        $dictionary_item->name = $request->get('name');
        $dictionary_item->dictionary_id = $request->get('dictionary_id');
        $dictionary_item->save();
        return $dictionary_item;
    }

    public function update(Request $request) : DictionaryItem
    {

        $dictionary_item = DictionaryItem::find($request->get('id'));
        $dictionary_item->name = $request->get('name');
        $dictionary_item->dictionary_id = $request->get('dictionary_id');
        $dictionary_item->update();
        return $dictionary_item;
    }

    public function delete(Request $request) : DictionaryItem
    {

        $dictionary_item = DictionaryItem::find($request->get('id'));
        $dictionary_item->delete();
        return $dictionary_item;
    }

    public function findTrashed() : Builder
    {

        return DictionaryItem::onlyTrashed();
    }

    public function findTrashedById(Request $request) : Builder
    {

        return DictionaryItem::withTrashed()->where('id', $request->get('id'));
    }

    public function restore(Request $request) : Builder
    {

        $dictionary_item = DictionaryItem::onlyTrashed()->where('id', $request->get('id'));
        $dictionary_item->restore();
        return $dictionary_item;
    }

    public function forceDelete(Request $request) : Builder
    {

        $dictionary_item = DictionaryItem::withTrashed()->where('id', $request->id);
        $dictionary_item->forceDelete();
        return $dictionary_item;
    }
}
