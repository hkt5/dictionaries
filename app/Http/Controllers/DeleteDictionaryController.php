<?php


namespace App\Http\Controllers;


use App\Strategies\Command\Dictionary\DeleteDictionaryStrategy;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class DeleteDictionaryController extends Controller
{

    private $strategy;

    public function __construct(DeleteDictionaryStrategy $strategy)
    {

        $this->strategy = $strategy;
    }

    /**
     * Delete dictionary.
     *
     * @response 200 {"content":{"dictionary":{"id":1,"name":"dictionary","deleted_at":"2019-11-20 20:24:18","created_at":"2019-11-20 20:24:17","updated_at":"2019-11-20 20:24:18"}},"error_messages":[]}
     *
     * @response 400 {"content":[],"error_messages":{"id":["The id field is required."]}}
     * @response 400 {"content":[],"error_messages":{"id":["The id must be an integer."]}}
     * @response {"content":[],"error_messages":{"id":["The selected id is invalid."]}}
     */
    public function delete(Request $request) : JsonResponse
    {

        return $this->strategy->run($request);
    }
}
