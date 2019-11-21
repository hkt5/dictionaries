<?php


namespace App\Http\Controllers;


use App\Strategies\Command\Dictionary\ForceDeleteStrategy;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ForceDeleteDictionaryController extends Controller
{

    private $strategy;

    public function __construct(ForceDeleteStrategy $strategy)
    {

        $this->strategy = $strategy;
    }

    /**
     * Force delete dictionary.
     *
     * @bodyParam id integer required The id of dictionary.
     *
     * @response 400 {"content":[],"error_messages":{"id":["The id field is required."]}}
     * @response 400 {"content":[],"error_messages":{"id":["The id must be an integer."]}}
     * @response 400 {"content":[],"error_messages":{"id":["The selected id is invalid."]}}
     * @response 200 {"content":{"dictionary":{}},"error_messages":[]}
     */
    public function forceDelete(Request $request) : JsonResponse
    {

        return $this->strategy->run($request);
    }
}
