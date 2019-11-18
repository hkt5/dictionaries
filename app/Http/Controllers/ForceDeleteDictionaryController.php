<?php


namespace App\Http\Controllers;


use App\Strategies\Command\Dictionary\ForceDeleteStrategy;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ForceDeleteDictionaryController extends Controller
{

    private $strategy;

    public function __construct(ForceDeleteStrategy $strategy)
    {

        $this->strategy = $strategy;
    }

    public function forceDelete(Request $request) : JsonResponse
    {

        return $this->strategy->run($request);
    }
}
