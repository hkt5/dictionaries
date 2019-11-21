<?php


namespace App\Http\Controllers;


use App\Strategies\Query\DictionaryItem\FindTrashedDictionaryItemsStrategy;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class FindTrashedDictionaryItemController extends Controller
{

    private $strategy;

    public function __construct(FindTrashedDictionaryItemsStrategy $strategy)
    {

        $this->strategy = $strategy;
    }

    /**
     * Find trashed dictionary item.
     *
     * @requestParam id integer required Id of dictionary item.
     *
     * @response 200 {"content":[{"id":1,"name":"hello","dictionary_id":1,"deleted_at":"2019-11-21 19:20:48","created_at":"2019-11-21 19:20:48","updated_at":"2019-11-21 19:20:48"}],"error_messages":[]}
     * @response 404 {"content":[],"error_messages":{"message":"","code":0}}
     * @response 500 {"content":[],"error_messages":{"message":"Argument 2 passed to App\\Http\\Controllers\\FindTrashedDictionaryItemController::find() must be of the type int, string given","code":0}}
     * @respone 200 {"content":[],"error_messages":[]}
     */
    public function find(Request $request, int $id) : JsonResponse
    {

        $request['id'] = $id;
        return $this->strategy->run($request);
    }
}
