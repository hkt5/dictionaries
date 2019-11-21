<?php


namespace App\Http\Controllers;


use App\Strategies\Command\DictionaryItem\CreateDictionaryItemStrategy;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CreateDictionaryItemController extends Controller
{

    private $strategy;

    public function __construct(CreateDictionaryItemStrategy $strategy)
    {

        $this->strategy = $strategy;
    }

    /**
     * Create dictionary item.
     *
     * @response 200 {"content":{"dictionary_item":{"name":"item 2","dictionary_id":1,"updated_at":"2019-11-20 20:12:53","created_at":"2019-11-20 20:12:53","id":2}},"error_messages":[]}
     *
     * @response 400 {"content":[],"error_messages":{"name":["The name field is required."]}}
     * @response 400 {"content":[],"error_messages":{"name":["The name must be a string."]}}
     * @response 400 {"content":[],"error_messages":{"dictionary_id":["The dictionary id field is required."]}}
     * @response 400 {"content":[],"error_messages":{"dictionary_id":["The dictionary id must be an integer."]}}
     * @response 400 {"content":[],"error_messages":{"dictionary_id":["The selected dictionary id is invalid."]}}
     *
     */
    public function create(Request $request) : JsonResponse
    {

        return $this->strategy->run($request);
    }
}
