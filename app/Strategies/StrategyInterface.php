<?php


namespace App\Strategies;


use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

interface StrategyInterface
{

    public function run(Request $request = null) : JsonResponse;
}
