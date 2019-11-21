<?php


namespace App\Http\Controllers;


use App\Strategies\Command\DictionaryItem\UpdateDictionaryItemStrategy;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UpdateDictionaryItemController extends Controller
{

    private $strategy;

    public function __construct(UpdateDictionaryItemStrategy $strategy)
    {

        $this->strategy = $strategy;
    }

    /**
     * Update dictionary item.
     *
     * @bodyParam id integer required Id of dictionary item.
     * @bodyParam name string required The name of dictionary item.
     * @bodyParam dictionary_id integer required The name of dictionary item.
     *
     * @response 400 {"content":[],"error_messages":{"id":["The id field is required."]}}
     * @response 4000 {"content":[],"error_messages":{"id":["The id must be an integer."]}}
     * @response 400 {"content":[],"error_messages":{"id":["The selected id is invalid."]}}
     * @response 400 {"content":[],"error_messages":{"name":["The name field is required."]}}
     * @response 400 {"content":[],"error_messages":{"name":["The name must be a string."]}}
     * @response 400 {"content":[],"error_messages":{"dictionary_id":["The dictionary id field is required."]}}
     * @response 400 {"content":[],"error_messages":{"dictionary_id":["The dictionary id must be an integer."]}}
     * @response 400 {"content":[],"error_messages":{"dictionary_id":["The selected dictionary id is invalid."]}}
     * @response 400 {"content":{"dictionary":{"id":1,"name":"item","dictionary_id":1,"deleted_at":null,"created_at":"2019-11-21 20:53:10","updated_at":"2019-11-21 20:53:10"}},"error_messages":[]}
     * @response 200 {"content":{"dictionary":{"id":1,"name":"item","dictionary_id":1,"deleted_at":null,"created_at":"2019-11-21 20:51:59","updated_at":"2019-11-21 20:51:59"}},"error_messages":[]}
     */
    public function update(Request $request) : JsonResponse
    {

        return $this->strategy->run($request);
    }
}
