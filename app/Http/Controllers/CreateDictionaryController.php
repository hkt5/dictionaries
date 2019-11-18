<?php


namespace App\Http\Controllers;


use App\Strategies\Command\Dictionary\CreateDictionaryStrategy;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CreateDictionaryController extends Controller
{

    private $strategy;

    public function __construct(CreateDictionaryStrategy $createDictionaryStrategy)
    {

        $this->strategy = $createDictionaryStrategy;
    }

    public function create(Request $request) : JsonResponse
    {

        return $this->strategy->run($request);
    }
}
