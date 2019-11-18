<?php


namespace App\Strategies\Command\DictionaryItem;


use App\Repositories\DictionaryItemsRepository;
use App\Strategies\StrategyInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

class UpdateDictionaryItemStrategy implements StrategyInterface
{

    private $rules = [
        'id' => 'required|integer|exists:dictionary_items,id',
        'name' => 'required|string',
        'dictionary_id' => 'required|integer|exists:dictionaries,id',
    ];

    public function run(Request $request = null): JsonResponse
    {

        try {

            return $this->update($request);
        } catch (\Exception $e) {

            return response()->json(
                ['content' => [], 'error_messages' => $e->getMessage(),], Response::HTTP_BAD_REQUEST
            );
        }
    }

    private function update(Request $request) : JsonResponse
    {

        $validator = Validator::make($request->all(), $this->rules);
        if($validator->fails()){

            return response()->json(
                ['content' => [], 'error_messages' => $validator->errors(),], Response::HTTP_BAD_REQUEST
            );
        } else {

            return response()->json(
                [
                    'content' => [
                        'dictionary' => DictionaryItemsRepository::getInstance()->update($request),
                    ], 'error_messages' => [],
                ], Response::HTTP_OK
            );
        }
    }
}
