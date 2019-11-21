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

    /**
     * Find trashed dictionary by id.
     *
     * @requestParam id integer required The id of dictionary.
     *
     * @response 200 {"content":{"dictionary_item":[{"id":2,"name":"dictionary 2","deleted_at":"2019-11-21 19:02:46","created_at":"2019-11-21 19:02:45","updated_at":"2019-11-21 19:02:46"}]},"error_messages":[]}
     * @response 200 {"content":{"dictionary_item":[]},"error_messages":[]}
     * @response 500 {"content":[],"error_messages":{"message":"Argument 2 passed to App\\Http\\Controllers\\FindTrashedDictionaryByIdController::findTrashed() must be of the type int, string given","code":0}}
     * @response 400 {"content":[],"error_messages":{"id":["The selected id is invalid."]}}
     *
     */
   public function findTrashed(Request $request, int $id) : JsonResponse
   {

       $request['id'] = $id;
       return $this->strategy->run($request);
   }
}
