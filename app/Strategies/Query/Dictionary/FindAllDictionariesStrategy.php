<?php


namespace App\Strategies\Query\Dictionary;


use App\Repositories\DictionaryRepository;
use App\Strategies\StrategyInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;

class FindAllDictionariesStrategy implements StrategyInterface
{

    public function run(Request $request = null): JsonResponse
    {
        try {

            return $this->findAllDictionaries();
        } catch (\Exception $e) {

            Log::error($e->getMessage());
            return response()->json(
                ['content' => [], 'error_messages' => $e->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR
            );
        }
    }

    private function findAllDictionaries() : JsonResponse
    {

        $dictionaries = DictionaryRepository::getInstance()->findAll();
        return response()->json(['content' => $dictionaries->get(['*'])], Response::HTTP_OK);
    }
}
