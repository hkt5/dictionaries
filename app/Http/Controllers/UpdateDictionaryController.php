<?php


namespace App\Http\Controllers;


use App\Strategies\Command\Dictionary\UpdateDictionaryStrategy;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UpdateDictionaryController extends Controller
{

    private $strategy;

    public function __construct(UpdateDictionaryStrategy $strategy)
    {

        $this->strategy = $strategy;
    }

    public function update(Request $request) : JsonResponse
    {

        return $this->strategy->run($request);
    }
}
