<?php


namespace App\Http\Controllers;


use App\Strategies\Query\Dictionary\FindAllDictionariesStrategy;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class FindAllDictionariesController extends Controller
{

    private $strategy;

    public function __construct(FindAllDictionariesStrategy $strategy)
    {

        $this->strategy = $strategy;
    }

    /**
     * Find all dictionaries.
     *
     * @response 200 {"content":[{"id":1,"name":"dictionary","deleted_at":null,"created_at":"2019-11-20 20:38:14","updated_at":"2019-11-20 20:38:14"}]}
     */
    public function all(Request $request) : JsonResponse
    {

        return $this->strategy->run($request);
    }
}
