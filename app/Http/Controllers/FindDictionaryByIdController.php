<?php


namespace App\Http\Controllers;


use App\Strategies\Query\Dictionary\FindDictionaryByIdStrategy;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class FindDictionaryByIdController extends Controller
{

    private $strategy;

    public function __construct(FindDictionaryByIdStrategy $strategy)
    {

        $this->strategy = $strategy;
    }

    /**
     * Find dictionary by id.
     *
     * @queryParam id integer required The id of dictionary.
     *
     * @response 200 {"content":{"dictionary":{"dictionary":{"id":1,"name":"dictionary","deleted_at":null,"created_at":"2019-11-21 18:13:30","updated_at":"2019-11-21 18:13:30"},"items":[{"id":1,"name":"dictionary","dictionary_id":1,"deleted_at":null,"created_at":"2019-11-21 18:13:30","updated_at":"2019-11-21 18:13:30"}]}},"error_messages":[]}
     * @response 400 {"content":[],"error_messages":{"id":["The selected id is invalid."]}}
     * @response 404 {"content":[],"error_messages":{"message":"","code":0}}
     * @response 500 {"content":[],"error_messages":{"message":"Argument 2 passed to App\\Http\\Controllers\\FindDictionaryByIdController::findById() must be of the type int, string given","code":0}}
     */
    public function findById(Request $request, int $id) : JsonResponse
    {

        $request['id'] = $id;
        return $this->strategy->run($request);
    }
}
