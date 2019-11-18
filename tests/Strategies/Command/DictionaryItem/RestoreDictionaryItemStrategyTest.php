<?php


use App\Dictionary;
use App\DictionaryItem;
use App\Helpers\MockingRequest;
use App\Strategies\Command\DictionaryItem\RestoreDictionaryItemStrategy;
use Illuminate\Http\Response;
use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\WithoutEvents;
use Laravel\Lumen\Testing\WithoutMiddleware;

class RestoreDictionaryItemStrategyTest extends TestCase
{

    use WithoutEvents;
    use WithoutMiddleware;
    use DatabaseMigrations;

    public function setUp(): void
    {
        parent::setUp();

        $dictionary = new Dictionary();
        $dictionary->id = 1;
        $dictionary->name = 'dictionary';
        $dictionary->save();

        $firstDictionaryItem = new DictionaryItem();
        $firstDictionaryItem->id = 1;
        $firstDictionaryItem->name = 'item';
        $firstDictionaryItem->dictionary_id = 1;
        $firstDictionaryItem->save();

        $secondDictionaryItem = new DictionaryItem();
        $secondDictionaryItem->id = 2;
        $secondDictionaryItem->name = 'item 2';
        $secondDictionaryItem->dictionary_id = 1;
        $secondDictionaryItem->save();
        $secondDictionaryItem->delete();
    }

    public function testRestoreDictionaryItemWhenDictionaryItemIdFieldIsEmpty() : void
    {

        // given
        $strategy = new RestoreDictionaryItemStrategy();
        $request = MockingRequest::createRequest(
            [
                'parameters' => [

                ], 'method' => '', 'uri' => '', 'content' => '', 'files' => [], 'server' => [], 'cookies' => [],
            ]
        );
        $response = [
            'content' => [], 'error_messages' => [
                'id' => ['0' => 'The id field is required.',],
            ],
        ];

        // when
        $result = $strategy->run($request);

        // then
        $this->assertEquals(Response::HTTP_BAD_REQUEST, $result->status());
        $this->assertEquals(json_encode($response), $result->content());
    }

    public function testRestoreDictionaryItemWhenDictionaryItemIdIsNotInteger() : void
    {

        // given
        $strategy = new RestoreDictionaryItemStrategy();
        $request = MockingRequest::createRequest(
            [
                'parameters' => [
                    'id' => 'hello',
                ], 'method' => '', 'uri' => '', 'content' => '', 'files' => [], 'server' => [], 'cookies' => [],
            ]
        );
        $response = [
            'content' => [], 'error_messages' => [
                'id' => ['0' => 'The id must be an integer.',],
            ],
        ];

        // when
        $result = $strategy->run($request);

        // then
        $this->assertEquals(Response::HTTP_BAD_REQUEST, $result->status());
        $this->assertEquals(json_encode($response), $result->content());
    }

    public function testRestoreDictionaryItemWhenDictionaryItemIdNotExists() : void
    {

        // given
        $strategy = new RestoreDictionaryItemStrategy();
        $request = MockingRequest::createRequest(
            [
                'parameters' => [
                    'id' => 3,
                ], 'method' => '', 'uri' => '', 'content' => '', 'files' => [], 'server' => [], 'cookies' => [],
            ]
        );
        $response = [
            'content' => [], 'error_messages' => [
                'id' => ['0' => 'The selected id is invalid.',],
            ],
        ];

        // when
        $result = $strategy->run($request);

        // then
        $this->assertEquals(Response::HTTP_BAD_REQUEST, $result->status());
        $this->assertEquals(json_encode($response), $result->content());
    }

    public function testRestoreDictionaryItemWhenDictionaryItemIsNotDeleted() : void
    {

        // given
        $strategy = new RestoreDictionaryItemStrategy();
        $request = MockingRequest::createRequest(
            [
                'parameters' => [
                    'id' => 1,
                ], 'method' => '', 'uri' => '', 'content' => '', 'files' => [], 'server' => [], 'cookies' => [],
            ]
        );

        // when
        $result = $strategy->run($request);

        // then
        $this->assertEquals(Response::HTTP_OK, $result->status());
    }

    public function testRestoreDictionaryItemWhenDictionaryItemIsDeleted() : void
    {

        // given
        $strategy = new RestoreDictionaryItemStrategy();
        $request = MockingRequest::createRequest(
            [
                'parameters' => [
                    'id' => 2,
                ], 'method' => '', 'uri' => '', 'content' => '', 'files' => [], 'server' => [], 'cookies' => [],
            ]
        );

        // when
        $result = $strategy->run($request);

        // then
        $this->assertEquals(Response::HTTP_OK, $result->status());
    }
}
