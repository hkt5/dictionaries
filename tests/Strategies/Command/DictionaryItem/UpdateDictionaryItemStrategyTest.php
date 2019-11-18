<?php


use App\Dictionary;
use App\DictionaryItem;
use App\Helpers\MockingRequest;
use App\Strategies\Command\DictionaryItem\UpdateDictionaryItemStrategy;
use Illuminate\Http\Response;
use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\WithoutEvents;
use Laravel\Lumen\Testing\WithoutMiddleware;

class UpdateDictionaryItemStrategyTest extends TestCase
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

    public function testUpdateDictionaryItemWhenDictionaryItemIdIsEmpty() : void
    {

        // given
        $strategy = new UpdateDictionaryItemStrategy();
        $request = MockingRequest::createRequest(
            [
                'parameters' => ['name' => 'item', 'dictionary_id' => 1,],
                'method' => '', 'uri' => '', 'content' => '', 'files' => [], 'server' => [], 'cookies' => [],
            ]
        );
        $response = [
            'content' => [], 'error_messages' => ['id' => ['0' => 'The id field is required.'],],
        ];

        // when
        $result = $strategy->run($request);

        // then
        $this->assertEquals(Response::HTTP_BAD_REQUEST, $result->status());
        $this->assertEquals(json_encode($response), $result->content());
    }

    public function testUpdateDictionaryItemWhenDictionaryItemIdIsNotInteger() : void
    {

        // given
        $strategy = new UpdateDictionaryItemStrategy();
        $request = MockingRequest::createRequest(
            [
                'parameters' => ['id' => 'hello', 'name' => 'item', 'dictionary_id' => 1,],
                'method' => '', 'uri' => '', 'content' => '', 'files' => [], 'server' => [], 'cookies' => [],
            ]
        );
        $response = [
            'content' => [], 'error_messages' => ['id' => ['0' => 'The id must be an integer.'],],
        ];

        // when
        $result = $strategy->run($request);

        // then
        $this->assertEquals(Response::HTTP_BAD_REQUEST, $result->status());
        $this->assertEquals(json_encode($response), $result->content());
    }

    public function testUpdateDictionaryItemWhenDictionaryItemIdNotExisting() : void
    {

        // given
        $strategy = new UpdateDictionaryItemStrategy();
        $request = MockingRequest::createRequest(
            [
                'parameters' => ['id' => 2, 'name' => 'item', 'dictionary_id' => 1,],
                'method' => '', 'uri' => '', 'content' => '', 'files' => [], 'server' => [], 'cookies' => [],
            ]
        );
        $response = [
            'content' => [], 'error_messages' => ['id' => ['0' => 'The selected id is invalid.'],],
        ];

        // when
        $result = $strategy->run($request);

        // then
        $this->assertEquals(Response::HTTP_BAD_REQUEST, $result->status());
        $this->assertEquals(json_encode($response), $result->content());
    }

    public function testUpdateDictionaryItemWhenDictionaryItemNameFieldIsEmpty() : void
    {

        // given
        $strategy = new UpdateDictionaryItemStrategy();
        $request = MockingRequest::createRequest(
            [
                'parameters' => ['id' => 1, 'dictionary_id' => 1,],
                'method' => '', 'uri' => '', 'content' => '', 'files' => [], 'server' => [], 'cookies' => [],
            ]
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

    public function testUpdateDictionaryItemWhenDictionaryItemNameIsNotString() : void
    {

        // given
        $strategy = new UpdateDictionaryItemStrategy();
        $request = MockingRequest::createRequest(
            [
                'parameters' => ['id' => 1, 'name' => 1, 'dictionary_id' => 1,],
                'method' => '', 'uri' => '', 'content' => '', 'files' => [], 'server' => [], 'cookies' => [],
            ]
        );
        $response = [
            'content' => [], 'error_messages' => ['name' => ['0' => 'The name must be a string.',],],
        ];

        // when
        $result = $strategy->run($request);

        // then
        $this->assertEquals(Response::HTTP_BAD_REQUEST, $result->status());
        $this->assertEquals(json_encode($response), $result->content());
    }

    public function testUpdateDictionaryItemWhenDictionaryIdFieldIsEmpty() : void
    {

        // given
        $strategy = new UpdateDictionaryItemStrategy();
        $request = MockingRequest::createRequest(
            [
                'parameters' => ['id' => 1, 'name' => 'item',],
                'method' => '', 'uri' => '', 'content' => '', 'files' => [], 'server' => [], 'cookies' => [],
            ]
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

    public function testUpdateDictionaryItemWhenDictionaryIdIsNotInteger() : void
    {

        // given
        $strategy = new UpdateDictionaryItemStrategy();
        $request = MockingRequest::createRequest(
            [
                'parameters' => ['id' => 1, 'name' => 'item', 'dictionary_id' => 'hello',],
                'method' => '', 'uri' => '', 'content' => '', 'files' => [], 'server' => [], 'cookies' => [],
            ]
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

    public function testUpdateDictionaryItemWhenDictionaryIdNotExisting() : void
    {

        // given
        $strategy = new UpdateDictionaryItemStrategy();
        $request = MockingRequest::createRequest(
            [
                'parameters' => ['id' => 1, 'name' => 'item', 'dictionary_id' => 2],
                'method' => '', 'uri' => '', 'content' => '', 'files' => [], 'server' => [], 'cookies' => [],
            ]
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

    public function testUpdateDictionaryItem() : void
    {

        // given
        $strategy = new UpdateDictionaryItemStrategy();
        $request = MockingRequest::createRequest(
            [
                'parameters' => ['id' => 1, 'name' => 'item', 'dictionary_id' => 1,],
                'method' => '', 'uri' => '', 'content' => '', 'files' => [], 'server' => [], 'cookies' => [],
            ]
        );

        // when
        $result = $strategy->run($request);

        // then
        $this->assertEquals(Response::HTTP_OK, $result->status());
    }
}
