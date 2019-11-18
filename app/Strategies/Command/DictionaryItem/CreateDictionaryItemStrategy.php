<?php


namespace App\Strategies\Command\DictionaryItem;


use App\Repositories\DictionaryItemsRepository;
use App\Strategies\StrategyInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class CreateDictionaryItemStrategy implements StrategyInterface
{

    private $rules = [
        'name' => 'required|string|',
        'dictionary_id' => 'required|integer|exists:dictionaries,id',
    ];

    public function run(Request $request = null): JsonResponse
    {

        try {

            return $this->create($request);
        } catch (\Exception $e){

            Log::error($e->getMessage());
        }
    }

    private function create(Request $request) : JsonResponse
    {

        $validator = Validator::make($request->all(), $this->rules);
        if($validator->fails()){

            return response()->json(
                ['content' => [], 'error_messages' => $validator->errors(),], Response::HTTP_BAD_REQUEST
            );
        } else {

            return response()->json(
                [
                    'content' => ['dictionary_item' => DictionaryItemsRepository::getInstance()->create($request)], 'error_messages' => [],
                ], Response::HTTP_OK
            );
        }
    }
}
