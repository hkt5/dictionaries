<?php


namespace App\Http\Controllers;


use App\Strategies\Command\Dictionary\CreateDictionaryStrategy;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CreateDictionaryController extends Controller
{

    private $strategy;

    public function __construct(CreateDictionaryStrategy $createDictionaryStrategy)
    {

        $this->strategy = $createDictionaryStrategy;
    }


    /**
     * Create dictionary.
     *
     * @bodyParam name string required The name of dictionary.
     *
     * @response 200 {"content":{"dictionary":{"name":"dictionary 1","created_at":"2019-11-20 20:03:16","updated_at":"2019-11-20 20:03:16","id":2}},"error_messages":[]}
     *
     * @response 400 {"content":[],"error_messages":{"name":["The name field is required."]}}
     * @response 400 {"content":[],"error_messages":{"name":["The name must be a string."]}}
     * @response 400 {"content":[],"error_messages":{"name":["The name has already been taken."]}}
     */
    public function create(Request $request) : JsonResponse
    {

        return $this->strategy->run($request);
    }
}
