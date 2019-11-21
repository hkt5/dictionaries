<?php


namespace App\Http\Controllers;


use App\Strategies\Command\DictionaryItem\ForceDeleteItemStrategy;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ForceDeleteDictionaryItemController extends Controller
{

    private $strategy;

    public function __construct(ForceDeleteItemStrategy $strategy)
    {

        $this->strategy = $strategy;
    }

    /**
     * Force delete dictionary item.
     *
     * @bodyParam id integer required The id of dictionary item.
     *
     * @response 400 {"content":[],"error_messages":{"id":["The id field is required."]}}
     * @response 400 {"content":[],"error_messages":{"id":["The id must be an integer."]}}
     * @response 400 {"content":[],"error_messages":{"id":["The selected id is invalid."]}}
     * @response 200 {"content":{"dictionary_item":{}},"error_messages":[]}
     */
    public function forceDelete(Request $request) : JsonResponse
    {

        return $this->strategy->run($request);
    }
}
