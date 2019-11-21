<?php


namespace App\Http\Controllers;


use App\Strategies\Query\DictionaryItem\FindAllDictionaryItemsStrategy;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class FindAllDictionaryItemsController extends Controller
{

    private $strategy;

    public function __construct(FindAllDictionaryItemsStrategy $strategy)
    {

        $this->strategy = $strategy;
    }

    /**
     * Find all dctionary items.
     *
     * @response 200 {"content":[{"id":1,"name":"hello","dictionary_id":1,"deleted_at":null,"created_at":"2019-11-20 20:42:23","updated_at":"2019-11-20 20:42:23"}],"error_messages":[]}
     */
    public function all(Request $request) : JsonResponse
    {

        return $this->strategy->run($request);
    }
}
