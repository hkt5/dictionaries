<?php


namespace App\Strategies\Query\DictionaryItem;


use App\Repositories\DictionaryItemsRepository;
use App\Strategies\StrategyInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class FindDictionaryItemByIdStrategy implements StrategyInterface
{

    private $rules = [
        'id' => 'required|integer|exists:dictionary_items,id',
    ];

    public function run(Request $request = null): JsonResponse
    {

        try {

            return $this->findById($request);
        } catch (\Exception $e) {

            Log::error($e->getMessage());
            return response()->json(['content' => [], 'error_messages' => $e->getMessage(),], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    private function findById(Request $request) : JsonResponse
    {

        $validator = Validator::make($request->all(), $this->rules);
        if($validator->fails()){

            return response()->json(
                ['content' => [], 'error_messages' => $validator->errors(),], Response::HTTP_BAD_REQUEST
            );
        } else {

            return response()->json(
                ['content' => [
                        'dictionary_item' => DictionaryItemsRepository::getInstance()->findById($request),
                        'error_messages' => [],
                    ],
                ], Response::HTTP_OK
            );
        }
    }
}
