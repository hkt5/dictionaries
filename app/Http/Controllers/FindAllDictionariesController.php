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

    public function all(Request $request) : JsonResponse
    {

        return $this->strategy->run($request);
    }
}
