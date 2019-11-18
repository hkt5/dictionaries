<?php


namespace App\Http\Controllers;


use App\Strategies\Command\DictionaryItem\ForceDeleteItemStrategy;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ForceDeleteDictionaryItemController extends Controller
{

    private $strategy;

    public function __construct(ForceDeleteItemStrategy $strategy)
    {

        $this->strategy = $strategy;
    }

    public function forceDelete(Request $request) : JsonResponse
    {

        return $this->strategy->run($request);
    }
}
