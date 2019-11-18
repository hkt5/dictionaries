<?php


namespace App\Strategies\Command\Dictionary;


use App\Repositories\DictionaryRepository;
use App\Strategies\StrategyInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class DeleteDictionaryStrategy implements StrategyInterface
{

    private $rules = [
        'id' => 'required|integer|exists:dictionaries,id'
    ];

    public function run(Request $request = null): JsonResponse
    {

        try {

            return $this->deleteDictionary($request);
        } catch (\Exception $e) {

            Log::error($e->getMessage());
            return response()->json(
                ['content' => [], 'error_messages' => $e->getMessage(),], Response::HTTP_INTERNAL_SERVER_ERROR
            );
        }
    }

    private function deleteDictionary(Request $request) : JsonResponse
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
                        'dictionary' => DictionaryRepository::getInstance()->delete($request)
                    ], 'error_messages' => [],
                ], Response::HTTP_OK
            );
        }
    }
}
