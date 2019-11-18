<?php


namespace App\Http\Controllers;


use App\Strategies\Command\DictionaryItem\CreateDictionaryItemStrategy;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CreateDictionaryItemController extends Controller
{

    private $strategy;

    public function __construct(CreateDictionaryItemStrategy $strategy)
    {

        $this->strategy = $strategy;
    }

    public function create(Request $request) : JsonResponse
    {

        return $this->strategy->run($request);
    }
}
