<?php


use App\Dictionary;
use App\DictionaryItem;
use App\Helpers\MockingRequest;
use App\Strategies\Query\DictionaryItem\FindDictionaryItemByNameStrategy;
use Illuminate\Http\Response;
use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\WithoutEvents;
use Laravel\Lumen\Testing\WithoutMiddleware;

class FindDictionaryItemByNameStrategyTest extends TestCase
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

    public function testFindDictionaryItemByNameWhenNameFieldIsEmpty() : void
    {

        // given
        $strategy = new FindDictionaryItemByNameStrategy();
        $request = MockingRequest::createRequest(
            [
                'parameters' => [], 'method' => '', 'uri' => '', 'content' => '', 'files' => [], 'server' => [],
                'cookies' => [],
            ],
        );
        $response = [
            'content' => [], 'error_messages' => [
                'name' => ['0' => 'The name field is required.',],
            ],
        ];

        // when
        $result = $strategy->findByName($request);

        // then
        $this->assertEquals(Response::HTTP_BAD_REQUEST, $result->status());
        $this->assertEquals(json_encode($response), $result->content());
    }

    public function testFindDictionaryItemByNameWhenNameIsNotString() : void
    {

        // given
        $strategy = new FindDictionaryItemByNameStrategy();
        $request = MockingRequest::createRequest(
            [
                'parameters' => ['name' => 1,], 'method' => '', 'uri' => '', 'content' => '', 'files' => [],
                'server' => [], 'cookies' => [],
            ],
            );
        $response = [
            'content' => [], 'error_messages' => [
                'name' => ['0' => 'The name must be a string.',],
            ],
        ];

        // when
        $result = $strategy->findByName($request);

        // then
        $this->assertEquals(Response::HTTP_BAD_REQUEST, $result->status());
        $this->assertEquals(json_encode($response), $result->content());
    }

    public function testFindDictionaryItemByNameWhenNameNotExisting() : void
    {

        // given
        $strategy = new FindDictionaryItemByNameStrategy();
        $request = MockingRequest::createRequest(
            [
                'parameters' => ['name' => 'item 2',], 'method' => '', 'uri' => '', 'content' => '', 'files' => [],
                'server' => [], 'cookies' => [],
            ],
            );
        $response = [
            'content' => [], 'error_messages' => [
                'name' => ['0' => 'The selected name is invalid.',],
            ],
        ];

        // when
        $result = $strategy->findByName($request);

        // then
        $this->assertEquals(Response::HTTP_BAD_REQUEST, $result->status());
        $this->assertEquals(json_encode($response), $result->content());
    }

    public function testFindDictionaryItemByNameWhenNameExisting() : void
    {

        // given
        $strategy = new FindDictionaryItemByNameStrategy();
        $request = MockingRequest::createRequest(
            [
                'parameters' => ['name' => 'item',], 'method' => '', 'uri' => '', 'content' => '', 'files' => [],
                'server' => [], 'cookies' => [],
            ],
            );

        // when
        $result = $strategy->findByName($request);

        // then
        $this->assertEquals(Response::HTTP_OK, $result->status());
    }
}
