<?php


use App\Dictionary;
use App\DictionaryItem;
use App\Helpers\MockingRequest;
use App\Strategies\Command\DictionaryItem\CreateDictionaryItemStrategy;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\WithoutEvents;
use Laravel\Lumen\Testing\WithoutMiddleware;

class CreateDictionaryItemStrategyTest extends TestCase
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

        $dictionaryItem = new DictionaryItem();
        $dictionaryItem->id = 1;
        $dictionaryItem->name = 'item';
        $dictionaryItem->dictionary_id = 1;
        $dictionaryItem->save();
    }

    public function testCreateDictionaryItemWhenNameFieldIsEmpty() : void
    {

        // given
        $strategy = new CreateDictionaryItemStrategy();
        $request = MockingRequest::createRequest(
            [
                'parameters' => [
                    'dictionary_id' => 1,
                ], 'uri' => '', 'method' => '', 'content' => '', 'files' => [], 'server' => [], 'cookies' => [],
            ],
        );
        $response = [
            'content' => [], 'error_messages' => ['name' => ['0' => 'The name field is required.'],],
        ];

        // when
        $result = $strategy->run($request);

        // then
        $this->assertEquals(Response::HTTP_BAD_REQUEST, $result->status());
        $this->assertEquals(json_encode($response), $result->content());
    }

    public function testCreateDictionaryItemWhenNameIsNotString() : void
    {

        // given
        $strategy = new CreateDictionaryItemStrategy();
        $request = MockingRequest::createRequest(
            [
                'parameters' => [
                    'name' => 1, 'dictionary_id' => 1,
                ], 'uri' => '', 'method' => '', 'content' => '', 'files' => [], 'server' => [], 'cookies' => [],
            ],
            );
        $response = [
            'content' => [], 'error_messages' => ['name' => ['0' => 'The name must be a string.'],],
        ];

        // when
        $result = $strategy->run($request);

        // then
        $this->assertEquals(Response::HTTP_BAD_REQUEST, $result->status());
        $this->assertEquals(json_encode($response), $result->content());
    }

    public function testCreateDictionaryItemWhenDictionaryIdFieldIsEmpty() : void
    {

        // given
        $strategy = new CreateDictionaryItemStrategy();
        $request = MockingRequest::createRequest(
            [
                'parameters' => [
                    'name' => 'item',
                ], 'uri' => '', 'method' => '', 'content' => '', 'files' => [], 'server' => [], 'cookies' => [],
            ],
            );
        $response = [
            'content' => [], 'error_messages' => ['dictionary_id' => ['0' => 'The dictionary id field is required.',],],
        ];

        // when
        $result = $strategy->run($request);

        // then
        $this->assertEquals(Response::HTTP_BAD_REQUEST, $result->status());
        $this->assertEquals(json_encode($response), $result->content());
    }

    public function testCreateDictionaryItemWhenDictionaryIdIsNotInteger() : void
    {

        // given
        $strategy = new CreateDictionaryItemStrategy();
        $request = MockingRequest::createRequest(
            [
                'parameters' => [
                    'name' => 'item', 'dictionary_id' => 'hello',
                ], 'uri' => '', 'method' => '', 'content' => '', 'files' => [], 'server' => [], 'cookies' => [],
            ],
            );
        $response = [
            'content' => [], 'error_messages' => ['dictionary_id' => ['0' => 'The dictionary id must be an integer.',],],
        ];

        // when
        $result = $strategy->run($request);

        // then
        $this->assertEquals(Response::HTTP_BAD_REQUEST, $result->status());
        $this->assertEquals(json_encode($response), $result->content());
    }

    public function testCreateDictionaryItemWhenDictionaryIdIsNotExisting() : void
    {

        // given
        $strategy = new CreateDictionaryItemStrategy();
        $request = MockingRequest::createRequest(
            [
                'parameters' => [
                    'name' => 'item', 'dictionary_id' => 2,
                ], 'uri' => '', 'method' => '', 'content' => '', 'files' => [], 'server' => [], 'cookies' => [],
            ],
            );
        $response = [
            'content' => [], 'error_messages' => ['dictionary_id' => ['0' => 'The selected dictionary id is invalid.',],],
        ];

        // when
        $result = $strategy->run($request);

        // then
        $this->assertEquals(Response::HTTP_BAD_REQUEST, $result->status());
        $this->assertEquals(json_encode($response), $result->content());
    }

    public function testCreateDictionaryItemWhenNameExistingIntoDatabase() : void
    {

        // given
        $strategy = new CreateDictionaryItemStrategy();
        $request = MockingRequest::createRequest(
            [
                'parameters' => [
                    'name' => 'item', 'dictionary_id' => 1,
                ], 'uri' => '', 'method' => '', 'content' => '', 'files' => [], 'server' => [], 'cookies' => [],
            ],
            );

        // when
        $result = $strategy->run($request);

        // then
        $this->assertEquals(Response::HTTP_OK, $result->status());
    }

    public function testCreateDictionaryItemWhenNameNotExistingIntoDatabase() : void
    {

        // given
        $strategy = new CreateDictionaryItemStrategy();
        $request = MockingRequest::createRequest(
            [
                'parameters' => [
                    'name' => 'item 2', 'dictionary_id' => 1,
                ], 'uri' => '', 'method' => '', 'content' => '', 'files' => [], 'server' => [], 'cookies' => [],
            ],
            );

        // when
        $result = $strategy->run($request);

        // then
        $this->assertEquals(Response::HTTP_OK, $result->status());
    }
}
