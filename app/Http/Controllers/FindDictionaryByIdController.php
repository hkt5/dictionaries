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

    public function findById(Request $request, int $id) : JsonResponse
    {

        $request['id'] = $id;
        return $this->strategy->run($request);
    }
}
