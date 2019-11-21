<?php


namespace App\Http\Controllers;


use App\Strategies\Command\Dictionary\UpdateDictionaryStrategy;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UpdateDictionaryController extends Controller
{

    private $strategy;

    public function __construct(UpdateDictionaryStrategy $strategy)
    {

        $this->strategy = $strategy;
    }

    /**
     * Update dictionary controller.
     *
     * @bodyParam id integer required Id of dictionary.
     * @bodyParam name string required Name of dictionary.
     *
     * @response 400 {"content":[],"error_messages":{"id":["The id field is required."]}}
     * @response 400 {"content":[],"error_messages":{"id":["The id must be an integer."]}}
     * @response 400 {"content":[],"error_messages":{"id":["The selected id is invalid."]}}
     * @response 400 {"content":[],"error_messages":{"name":["The name field is required."]}}
     * @response 400 {"content":[],"error_messages":{"name":["The name must be a string."]}}
     * @response 400 {"content":[],"error_messages":{"name":["The name has already been taken."]}}
     * @response 200 {"content":{"dictionary":{"id":1,"name":"dictionary 1","deleted_at":null,"created_at":"2019-11-21 20:31:50","updated_at":"2019-11-21 20:31:50"}},"error_messages":[]}
     */
    public function update(Request $request) : JsonResponse
    {

        return $this->strategy->run($request);
    }
}
