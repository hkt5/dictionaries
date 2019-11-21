<?php


namespace App\Http\Controllers;


use App\Strategies\Query\Dictionary\FindDictionaryByNameStrategy;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class FindDictionaryByNameController extends Controller
{

    private $strategy;

    public function __construct(FindDictionaryByNameStrategy $strategy)
    {

        $this->strategy = $strategy;
    }

    /**
     * Find dictionary by name.
     *
     * @queryParam name string required The name of dictionary.
     *
     * @response 200 {"content":{"dictionary":{"id":1,"name":"dictionary","deleted_at":null,"created_at":"2019-11-21 18:19:37","updated_at":"2019-11-21 18:19:37"}},"error_messages":[]}
     * @response 404 {"content":[],"error_messages":{"message":"","code":0}}
     * @response 400 {"content":[],"error_messages":{"name":["The selected name is invalid."]}}
     */
    public function findByName(Request $request, string $name) : JsonResponse
    {

        $request['name'] = $name;
        return $this->strategy->run($request);
    }
}
