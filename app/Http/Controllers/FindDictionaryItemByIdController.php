<?php


namespace App\Http\Controllers;


use App\Strategies\Query\DictionaryItem\FindDictionaryItemByIdStrategy;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class FindDictionaryItemByIdController extends Controller
{

    private $strategy;

    public function __construct(FindDictionaryItemByIdStrategy $strategy)
    {

        $this->strategy = $strategy;
    }

    /**
     * Find dictionary item by id.
     *
     * @queryParam id integer required The id of dictionary item.
     *
     * @response 200 {"content":{"dictionary_item":{"id":1,"name":"item","dictionary_id":1,"deleted_at":null,"created_at":"2019-11-21 18:30:11","updated_at":"2019-11-21 18:30:11"},"error_messages":[]}}
     * @response 404 {"content":[],"error_messages":{"message":"","code":0}}
     * @response 500 {"content":[],"error_messages":{"message":"Argument 2 passed to App\\Http\\Controllers\\FindDictionaryItemByIdController::findById() must be of the type int, string given","code":0}}
     * @response 400 {"content":[],"error_messages":{"id":["The selected id is invalid."]}}
     */
    public function findById(Request $request, int $id) : JsonResponse
    {

        $request['id'] = $id;
        return $this->strategy->run($request);
    }
}
