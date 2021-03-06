<?php


use App\Dictionary;
use App\DictionaryItem;
use App\Helpers\MockingRequest;
use App\Strategies\Command\DictionaryItem\DeleteDictionaryItemStrategy;
use Illuminate\Http\Response;
use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\WithoutEvents;
use Laravel\Lumen\Testing\WithoutMiddleware;

class DeleteDictionaryItemStrategyTest extends TestCase
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

    public function testDeleteDictionaryItemWhenDictionaryItemIdFieldIsEmpty() : void
    {

        // given
        $strategy = new DeleteDictionaryItemStrategy();
        $request = MockingRequest::createRequest(
            [
                'parameters' => [

                ], 'method' => '', 'uri' => '', 'content' => '', 'server' => [], 'files' => [],
                'cookies' => [],
            ]
        );
        $response = [
            'content' => [], 'error_messages' => [
                'id' => [
                    '0' => 'The id field is required.'
                ],
            ],
        ];

        // when
        $result = $strategy->run($request);

        // then
        $this->assertEquals(Response::HTTP_BAD_REQUEST, $result->status());
        $this->assertEquals(json_encode($response), $result->content());
    }

    public function testDeleteDictionaryItemWhenDictionaryItemIdIsNotInteger() : void
    {

        // given
        $strategy = new DeleteDictionaryItemStrategy();
        $request = MockingRequest::createRequest(
            [
                'parameters' => [
                    'id' => 'hello',
                ], 'method' => '', 'uri' => '', 'content' => '', 'server' => [], 'files' => [],
                'cookies' => [],
            ]
        );
        $response = [
            'content' => [], 'error_messages' => [
                'id' => [
                    '0' => 'The id must be an integer.'
                ],
            ],
        ];

        // when
        $result = $strategy->run($request);

        // then
        $this->assertEquals(Response::HTTP_BAD_REQUEST, $result->status());
        $this->assertEquals(json_encode($response), $result->content());
    }

    public function testDeleteDictionaryItemWhenDictionaryItemIdIsNotExisting() : void
    {

        // given
        $strategy = new DeleteDictionaryItemStrategy();
        $request = MockingRequest::createRequest(
            [
                'parameters' => [
                    'id' => 2,
                ], 'method' => '', 'uri' => '', 'content' => '', 'server' => [], 'files' => [],
                'cookies' => [],
            ]
        );
        $response = [
            'content' => [], 'error_messages' => [
                'id' => [
                    '0' => 'The selected id is invalid.'
                ],
            ],
        ];

        // when
        $result = $strategy->run($request);

        // then
        $this->assertEquals(Response::HTTP_BAD_REQUEST, $result->status());
        $this->assertEquals(json_encode($response), $result->content());
    }

    public function testDeleteDictionaryItem() : void
    {

        // given
        $strategy = new DeleteDictionaryItemStrategy();
        $request = MockingRequest::createRequest(
            [
                'parameters' => [
                    'id' => 1,
                ], 'method' => '', 'uri' => '', 'content' => '', 'server' => [], 'files' => [],
                'cookies' => [],
            ]
        );

        // when
        $result = $strategy->run($request);

        // then
        $this->assertEquals(Response::HTTP_OK, $result->status());
    }
}
