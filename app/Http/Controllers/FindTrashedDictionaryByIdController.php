<?php


namespace App\Http\Controllers;


use App\Strategies\Query\Dictionary\FindTrashedDictionaryByIdStrategy;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class FindTrashedDictionaryByIdController extends Controller
{

   private $strategy;

   public function __construct(FindTrashedDictionaryByIdStrategy $strategy)
   {

       $this->strategy = $strategy;
   }

   public function findTrashed(Request $request, int $id) : JsonResponse
   {

       $request['id'] = $id;
       return $this->strategy->run($request);
   }
}
