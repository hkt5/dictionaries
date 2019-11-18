<?php


namespace App\Http\Controllers;


use App\Strategies\Command\DictionaryItem\RestoreDictionaryItemStrategy;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class RestoreDictionaryItemController extends Controller
{

    private $strategy;

    public function __construct(RestoreDictionaryItemStrategy $strategy)
    {

        $this->strategy = $strategy;
    }

    public function restore(Request $request) : JsonResponse
    {

        return $this->strategy->run($request);
    }
}
