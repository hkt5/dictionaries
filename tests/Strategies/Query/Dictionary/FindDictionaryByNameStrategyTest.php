<?php


use App\Helpers\MockingRequest;
use App\Strategies\Query\Dictionary\FindDictionaryByNameStrategy;
use Illuminate\Http\Response;
use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\WithoutEvents;
use Laravel\Lumen\Testing\WithoutMiddleware;

class FindDictionaryByNameStrategyTest extends TestCase
{

    use WithoutEvents;
    use WithoutMiddleware;
    use DatabaseMigrations;

    public function setUp(): void
    {
        parent::setUp();
        $dictionary = new App\Dictionary();
        $dictionary->id = 1;
        $dictionary->name = 'dictionary';
        $dictionary->save();
    }

    public function testFindDictionaryByNameWhenDictionaryNameFieldIsEmpty() : void
    {

        // given
        $strategy = new FindDictionaryByNameStrategy();
        $request = MockingRequest::createRequest(
            [
                'parameters' => [], 'method' => '', 'uri' => '', 'content' => '', 'server' => [], 'files' => [],
                'cookies' => [],
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

    public function testFindDictionaryByNameWhenDictionaryNameFieldIsNotString() : void
    {

        // given
        $strategy = new FindDictionaryByNameStrategy();
        $request = MockingRequest::createRequest(
            [
                'parameters' => ['name' => 1,], 'method' => '', 'uri' => '', 'content' => '', 'server' => [],
                'files' => [], 'cookies' => [],
            ]
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

    public function testFindDictionaryByNameWhenDictionaryNameNotExisting() : void
    {

        // given
        $strategy = new FindDictionaryByNameStrategy();
        $request = MockingRequest::createRequest(
            [
                'parameters' => ['name' => 'dictionary 1',], 'method' => '', 'uri' => '', 'content' => '',
                'server' => [], 'files' => [], 'cookies' => [],
            ]
        );
        $response = [
            'content' => [], 'error_messages' => ['name' => ['0' => 'The selected name is invalid.'],],
        ];

        // when
        $result = $strategy->run($request);

        // then
        $this->assertEquals(Response::HTTP_BAD_REQUEST, $result->status());
        $this->assertEquals(json_encode($response), $result->content());
    }

    public function testFindDictionaryByNameWhenDictionaryNameExisting() : void
    {

        // given
        $strategy = new FindDictionaryByNameStrategy();
        $request = MockingRequest::createRequest(
            [
                'parameters' => ['name' => 'dictionary',], 'method' => '', 'uri' => '', 'content' => '', 'server' => [],
                'files' => [], 'cookies' => [],
            ]
        );

        // when
        $result = $strategy->run($request);

        // then
        $this->assertEquals(Response::HTTP_OK, $result->status());
    }
}
