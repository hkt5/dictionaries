<?php


namespace App\Http\Controllers;


use App\Strategies\Command\DictionaryItem\DeleteDictionaryItemStrategy;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class DeleteDictionaryItemController extends Controller
{

    private $strategy;

    public function __construct(DeleteDictionaryItemStrategy $strategy)
    {

        $this->strategy = $strategy;
    }

    /**
     * Delete dictionary item.
     *
     * @response 200 {"content":{"dictionary_item":{"id":1,"name":"item","dictionary_id":1,"deleted_at":"2019-11-20 20:36:22","created_at":"2019-11-20 20:36:20","updated_at":"2019-11-20 20:36:22"}},"error_messages":[]}
     *
     * @response 400 {"content":[],"error_messages":{"id":["The id field is required."]}}
     * @response 400 {"content":[],"error_messages":{"id":["The id must be an integer."]}}
     * @response 400 {"content":[],"error_messages":{"id":["The selected id is invalid."]}}
     */
    public function delete(Request $request) : JsonResponse
    {

        return $this->strategy->run($request);
    }
}
