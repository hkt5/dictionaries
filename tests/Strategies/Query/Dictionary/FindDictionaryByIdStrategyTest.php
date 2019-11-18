<?php


use App\Dictionary;
use App\Helpers\MockingRequest;
use App\Strategies\Query\Dictionary\FindDictionaryByIdStrategy;
use Illuminate\Http\Response;
use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\WithoutEvents;
use Laravel\Lumen\Testing\WithoutMiddleware;

class FindDictionaryByIdStrategyTest extends TestCase
{

    private $dictionary_id = 1;
    private $not_existing_dictionary_id = 2;

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
    }

    public function testFindDictionaryByIdWhenIdFieldIsEmpty() : void
    {

        // given
        $strategy = new FindDictionaryByIdStrategy();
        $request = MockingRequest::createRequest(
            [
                'parameters' => [], 'method' => '', 'uri' => '', 'content' => '', 'server' => [], 'files' => [],
                'cookies' => [],
            ],
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

    public function testFindDictionaryByIdWhenIdIsNotInteger() : void
    {

        // given
        $strategy = new FindDictionaryByIdStrategy();
        $request = MockingRequest::createRequest(
            [
                'parameters' => ['id' => 'hello',], 'method' => '', 'uri' => '', 'content' => '', 'server' => [],
                'files' => [], 'cookies' => [],
            ],
        );
        $response = [
            'content' => [], 'error_messages' => [
                'id' => [
                    '0' => 'The id must be an integer.',
                ],
            ],
        ];

        // when
        $result = $strategy->run($request);

        // then
        $this->assertEquals(Response::HTTP_BAD_REQUEST, $result->status());
        $this->assertEquals(json_encode($response), $result->content());
    }

    public function testFindDictionaryByIdWhenIdNotExisting() : void
    {

        // given
        $strategy = new FindDictionaryByIdStrategy();
        $request = MockingRequest::createRequest(
            [
                'parameters' => ['id' => 2,], 'method' => '', 'uri' => '', 'content' => '', 'server' => [],
                'files' => [], 'cookies' => [],
            ],
            );
        $response = [
            'content' => [], 'error_messages' => [
                'id' => [
                    '0' => 'The selected id is invalid.',
                ],
            ],
        ];

        // when
        $result = $strategy->run($request);

        // then
        $this->assertEquals(Response::HTTP_BAD_REQUEST, $result->status());
        $this->assertEquals(json_encode($response), $result->content());
    }

    public function testFindDictionaryByIdWhenIdExisting() : void
    {

        // given
        $strategy = new FindDictionaryByIdStrategy();
        $request = MockingRequest::createRequest(
            [
                'parameters' => ['id' => 1,], 'method' => '', 'uri' => '', 'content' => '', 'server' => [],
                'files' => [], 'cookies' => [],
            ],
        );

        // when
        $result = $strategy->run($request);

        // then
        $this->assertEquals(Response::HTTP_OK, $result->status());
    }
}
