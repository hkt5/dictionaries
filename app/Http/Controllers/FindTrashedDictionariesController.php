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

    public function findTrashed(Request $request) : JsonResponse
    {

        return $this->strategy->run($request);
    }
}
