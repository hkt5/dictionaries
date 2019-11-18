<?php


namespace App\Strategies\Query\Dictionary;


use App\Repositories\DictionaryRepository;
use App\Strategies\StrategyInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class FindDictionaryByNameStrategy implements StrategyInterface
{

    private $rules = [
        'name' => 'string|required|exists:dictionaries,name',
    ];

    public function run(Request $request = null): JsonResponse
    {

        try {

            return $this->findByName($request);
        } catch (\Exception $e) {

            Log::error($e->getMessage());
            return response()->json(
                ['content' => [], 'error_messages' => $e->getMessage(),], Response::HTTP_INTERNAL_SERVER_ERROR
            );
        }
    }

    public function findByName(Request $request) : JsonResponse
    {

        $validator = Validator::make($request->all(), $this->rules);
        if($validator->fails()){

            return response()->json(
                ['content' => [], 'error_messages' => $validator->errors()], Response::HTTP_BAD_REQUEST
            );
        } else {

            return response()->json(
                [
                    'content' => ['dictionary' => DictionaryRepository::getInstance()->findByName($request)],
                    'error_messages' => []
                ], Response::HTTP_OK
            );
        }
    }
}
