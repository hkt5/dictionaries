<?php


namespace App\Http\Controllers;


use App\Strategies\Command\Dictionary\RestoreDictionaryStrategy;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class RestoreDictionaryController extends Controller
{

    private $strategy;

    public function __construct(RestoreDictionaryStrategy $strategy)
    {
        $this->strategy = $strategy;
    }

    /**
     * Restore dictionary.
     *
     * @bodyParam id integer required
     *
     * @response 400 {"content":[],"error_messages":{"id":["The id field is required."]}}
     * @response 400 {"content":[],"error_messages":{"id":["The id must be an integer."]}}
     * @response 400 {"content":[],"error_messages":{"id":["The selected id is invalid."]}}
     * @response 200 {"content":{"dictionaries":{"id":1,"name":"dictionary","deleted_at":null,"created_at":"2019-11-21 20:05:29","updated_at":"2019-11-21 20:05:29"}},"error_messages":[]}
     */
    public function restore(Request $request) : JsonResponse
    {

        return $this->strategy->run($request);
    }
}
