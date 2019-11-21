<?php


namespace App\Http\Controllers;


use App\Strategies\Query\Dictionary\FindTrashedDictionariesStrategy;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class FindTrashedDictionariesController extends Controller
{

    private $strategy;

    public function __construct(FindTrashedDictionariesStrategy $strategy)
    {

        $this->strategy = $strategy;
    }

    /**
     * Find trashed dictionaries.
     *
     * @response 200 {"content":[],"error_messages":[]}
     * @response 200 {"content":[{"id":1,"name":"dictionary","deleted_at":"2019-11-21 18:36:19","created_at":"2019-11-21 18:36:19","updated_at":"2019-11-21 18:36:19"}],"error_messages":[]}
     */
    public function findTrashed(Request $request) : JsonResponse
    {

        return $this->strategy->run($request);
    }
}
