<?php


namespace App\Http\Controllers;


use App\Strategies\Command\DictionaryItem\DeleteDictionaryItemStrategy;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class DeleteDictionaryItemController extends Controller
{

    private $strategy;

    public function __construct(DeleteDictionaryItemStrategy $strategy)
    {

        $this->strategy = $strategy;
    }

    public function delete(Request $request) : JsonResponse
    {

        return $this->strategy->run($request);
    }
}
