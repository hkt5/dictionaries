<?php


namespace App\Http\Controllers;


use App\Strategies\Command\Dictionary\DeleteDictionaryStrategy;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class DeleteDictionaryController extends Controller
{

    private $strategy;

    public function __construct(DeleteDictionaryStrategy $strategy)
    {

        $this->strategy = $strategy;
    }

    public function delete(Request $request) : JsonResponse
    {

        return $this->strategy->run($request);
    }
}
