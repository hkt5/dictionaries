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

    public function all(Request $request) : JsonResponse
    {

        return $this->strategy->run($request);
    }
}
