<?php


namespace App\Strategies\Query\Dictionary;


use App\Repositories\DictionaryRepository;
use App\Strategies\StrategyInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;

class FindTrashedDictionariesStrategy implements StrategyInterface
{

    public function run(Request $request = null): JsonResponse
    {

        try {

            return response()->json(
                ['content' => DictionaryRepository::getInstance()->findTrashed()->get(['*']), 'error_messages' => [],],
                Response::HTTP_OK
            );
        } catch (\Exception $e) {

            Log::error($e->getMessage());
            return response()->json(
                ['content' => [], 'error_messages' => [],], Response::HTTP_INTERNAL_SERVER_ERROR
            );
        }
    }
}
