<?php


use App\Dictionary;
use App\Helpers\MockingRequest;
use App\Strategies\Command\Dictionary\UpdateDictionaryStrategy;
use Illuminate\Http\Response;
use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\WithoutEvents;
use Laravel\Lumen\Testing\WithoutMiddleware;

class UpdateDictionaryStrategyTest extends TestCase
{

    use WithoutEvents;
    use WithoutMiddleware;
    use DatabaseMigrations;

    public function setUp(): void
    {
        parent::setUp();

        $first_dictionary = new Dictionary();
        $first_dictionary->id = 1;
        $first_dictionary->name = 'first dictionary';
        $first_dictionary->save();

        $second_dictionary = new Dictionary();
        $second_dictionary->id = 2;
        $second_dictionary->name = 'second_dictionary';
        $second_dictionary->save();
    }

    public function testUpdateDictionaryWhenDictionaryIdFieldIsEmpty() : void
    {

        // given
        $strategy = new UpdateDictionaryStrategy();
        $request = MockingRequest::createRequest(
            [
                'parameters' => ['name' => 'updated dictionary',],
                'uri' => '', 'method' => '', 'content' => '', 'files' => [], 'server' => [], 'cookies' => [],
            ],
        );
        $response = [
            'content' => [], 'error_messages' => [
                'id' => ['0' => 'The id field is required.'],
            ],
        ];

        // when
        $result = $strategy->run($request);

        // then
        $this->assertEquals(Response::HTTP_BAD_REQUEST, $result->status());
        $this->assertEquals(json_encode($response), $result->content());
    }

    public function testUpdateDictionaryWhenDictionaryIdIsNotInteger() : void
    {

        // given
        $strategy = new UpdateDictionaryStrategy();
        $request = MockingRequest::createRequest(
            [
                'parameters' => ['id' => 'hello', 'name' => 'updated dictionary',],
                'uri' => '', 'method' => '', 'content' => '', 'files' => [], 'server' => [], 'cookies' => [],
            ],
            );
        $response = [
            'content' => [], 'error_messages' => [
                'id' => ['0' => 'The id must be an integer.'],
            ],
        ];

        // when
        $result = $strategy->run($request);

        // then
        $this->assertEquals(Response::HTTP_BAD_REQUEST, $result->status());
        $this->assertEquals(json_encode($response), $result->content());
    }

    public function testUpdateDictionaryWhenDictionaryIdNotExisting() : void
    {

        // given
        $strategy = new UpdateDictionaryStrategy();
        $request = MockingRequest::createRequest(
            [
                'parameters' => ['id' => 3, 'name' => 'updated dictionary',],
                'uri' => '', 'method' => '', 'content' => '', 'files' => [], 'server' => [], 'cookies' => [],
            ],
            );
        $response = [
            'content' => [], 'error_messages' => [
                'id' => ['0' => 'The selected id is invalid.'],
            ],
        ];

        // when
        $result = $strategy->run($request);

        // then
        $this->assertEquals(Response::HTTP_BAD_REQUEST, $result->status());
        $this->assertEquals(json_encode($response), $result->content());
    }

    public function testUpdateDictionaryWhenDictionaryNameFieldIsEmpty() : void
    {

        // given
        $strategy = new UpdateDictionaryStrategy();
        $request = MockingRequest::createRequest(
            [
                'parameters' => ['id' => 1,],
                'uri' => '', 'method' => '', 'content' => '', 'files' => [], 'server' => [], 'cookies' => [],
            ],
            );
        $response = [
            'content' => [], 'error_messages' => [
                'name' => ['0' => 'The name field is required.'],
            ],
        ];

        // when
        $result = $strategy->run($request);

        // then
        $this->assertEquals(Response::HTTP_BAD_REQUEST, $result->status());
        $this->assertEquals(json_encode($response), $result->content());
    }

    public function testUpdateDictionaryWhenDictionaryNameIsNotString() : void
    {

        // given
        $strategy = new UpdateDictionaryStrategy();
        $request = MockingRequest::createRequest(
            [
                'parameters' => ['id' => 1, 'name' => 1,],
                'uri' => '', 'method' => '', 'content' => '', 'files' => [], 'server' => [], 'cookies' => [],
            ],
            );
        $response = [
            'content' => [], 'error_messages' => [
                'name' => ['0' => 'The name must be a string.'],
            ],
        ];

        // when
        $result = $strategy->run($request);

        // then
        $this->assertEquals(Response::HTTP_BAD_REQUEST, $result->status());
        $this->assertEquals(json_encode($response), $result->content());
    }

    public function testUpdateDictionaryWhenDictionaryNameExisting() : void
    {

        // given
        $strategy = new UpdateDictionaryStrategy();
        $request = MockingRequest::createRequest(
            [
                'parameters' => ['id' => 1, 'name' => 'first dictionary',],
                'uri' => '', 'method' => '', 'content' => '', 'files' => [], 'server' => [], 'cookies' => [],
            ],
            );
        $response = [
            'content' => [], 'error_messages' => [
                'name' => ['0' => 'The name has already been taken.'],
            ],
        ];

        // when
        $result = $strategy->run($request);

        // then
        $this->assertEquals(Response::HTTP_BAD_REQUEST, $result->status());
        $this->assertEquals(json_encode($response), $result->content());
    }

    public function testUpdateDictionary() : void
    {

        // given
        $strategy = new UpdateDictionaryStrategy();
        $request = MockingRequest::createRequest(
            [
                'parameters' => ['id' => 1, 'name' => 'updated dictionary',],
                'uri' => '', 'method' => '', 'content' => '', 'files' => [], 'server' => [], 'cookies' => [],
            ],
            );

        // when
        $result = $strategy->run($request);

        // then
        $this->assertEquals(Response::HTTP_OK, $result->status());
        $this->assertNotEmpty(json_decode($result->content(), true)['content']['dictionary']);
        $this->assertEquals(
            'updated dictionary', json_decode($result->content(), true)['content']['dictionary']['name']
        );
    }
}
