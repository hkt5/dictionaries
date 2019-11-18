<?php


namespace App\Http\Controllers;


use App\Strategies\Query\Dictionary\FindDictionaryByNameStrategy;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class FindDictionaryByNameController extends Controller
{

    private $strategy;

    public function __construct(FindDictionaryByNameStrategy $strategy)
    {

        $this->strategy = $strategy;
    }

    public function findByName(Request $request, string $name) : JsonResponse
    {

        $request['name'] = $name;
        return $this->strategy->run($request);
    }
}
