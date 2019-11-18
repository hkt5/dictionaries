<?php


namespace App\Http\Controllers;


use App\Strategies\Command\Dictionary\RestoreDictionaryStrategy;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class RestoreDictionaryController extends Controller
{

    private $strategy;

    public function __construct(RestoreDictionaryStrategy $strategy)
    {
        $this->strategy = $strategy;
    }

    public function restore(Request $request) : JsonResponse
    {

        return $this->strategy->run($request);
    }
}
