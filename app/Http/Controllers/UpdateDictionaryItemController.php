<?php


namespace App\Http\Controllers;


use App\Strategies\Command\DictionaryItem\UpdateDictionaryItemStrategy;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UpdateDictionaryItemController extends Controller
{

    private $strategy;

    public function __construct(UpdateDictionaryItemStrategy $strategy)
    {

        $this->strategy = $strategy;
    }

    public function update(Request $request) : JsonResponse
    {

        return $this->strategy->run($request);
    }
}
