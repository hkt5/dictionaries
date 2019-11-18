<?php


namespace App\Strategies\Query\DictionaryItem;


use App\Repositories\DictionaryItemsRepository;
use App\Strategies\StrategyInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

class FindDictionaryItemByNameStrategy implements StrategyInterface
{

    private $rules = [
        'name' => 'required|string|exists:dictionary_items,name',
    ];

    public function run(Request $request = null): JsonResponse
    {
        // TODO: Implement run() method.
    }

    public function findByName(Request $request) : JsonResponse
    {

        $validator = Validator::make($request->all(), $this->rules);
        if($validator->fails()){

            return response()->json(
                ['content' => [], 'error_messages' => $validator->errors(),], Response::HTTP_BAD_REQUEST
            );
        } else {

            return response()->json(
                [
                    'content' => ['dictionary_item' => DictionaryItemsRepository::getInstance()->findByName($request),],
                    'error_messages' => [],
                ], Response::HTTP_OK
            );
        }
    }
}
