<?php


namespace App\Http\Controllers;


use App\Strategies\Query\DictionaryItem\FindTrashedDictionaryItemsStrategy;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class FindTrashedDictionaryItemsController extends Controller
{

    private $strategy;

    public function __construct(FindTrashedDictionaryItemsStrategy $strategy)
    {

        $this->strategy = $strategy;
    }

    /**
     * Find trashed dictionary items.
     *
     * @response 200 {"content":[{"id":1,"name":"item","dictionary_id":1,"deleted_at":"2019-11-21 19:25:27","created_at":"2019-11-21 19:25:27","updated_at":"2019-11-21 19:25:27"}],"error_messages":[]}
     */
    public function findTrashed(Request $request) : JsonResponse
    {

        return $this->strategy->run($request);
    }
}
