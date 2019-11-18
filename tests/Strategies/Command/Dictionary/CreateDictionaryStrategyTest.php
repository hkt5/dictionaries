<?php


use App\Dictionary;
use App\Helpers\MockingRequest;
use App\Strategies\Command\Dictionary\CreateDictionaryStrategy;
use Illuminate\Http\Response;
use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\WithoutEvents;
use Laravel\Lumen\Testing\WithoutMiddleware;

class CreateDictionaryStrategyTest extends TestCase
{

    use WithoutMiddleware;
    use WithoutEvents;
    use DatabaseMigrations;

    public function setUp(): void
    {
        parent::setUp();
        $dictionary = new Dictionary();
        $dictionary->id = 1;
        $dictionary->name = 'dictionary';
        $dictionary->save();
    }

    public function testCreateDictionaryWhenNameFieldIsEmpty() : void
    {

        // given
        $strategy = new CreateDictionaryStrategy();
        $request = MockingRequest::createRequest(
            [
                'parameters' => [], 'method' => '', 'uri' => '', 'content' => '', 'files' => [], 'cookies' => [],
                'server' => [],
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

    public function testCreateDictionaryWhenNameIsNotString() : void
    {

        // given
        $strategy = new CreateDictionaryStrategy();
        $request = MockingRequest::createRequest(
            [
                'parameters' => ['name' => 1,], 'method' => '', 'uri' => '', 'content' => '', 'files' => [],
                'cookies' => [], 'server' => [],
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

    public function testCreateDictionaryWhenNameExisting() : void
    {

        // given
        $strategy = new CreateDictionaryStrategy();
        $request = MockingRequest::createRequest(
            [
                'parameters' => ['name' => 'dictionary',], 'method' => '', 'uri' => '', 'content' => '', 'files' => [],
                'cookies' => [], 'server' => [],
            ],
            );
        $response = [
            'content' => [], 'error_messages' => ['name' => ['0' => 'The name has already been taken.'],],
        ];

        // when
        $result = $strategy->run($request);

        // then
        $this->assertEquals(Response::HTTP_BAD_REQUEST, $result->status());
        $this->assertEquals(json_encode($response), $result->content());
    }

    public function testCreateDictionaryWhenNameNotExisting() : void
    {

        // given
        $strategy = new CreateDictionaryStrategy();
        $request = MockingRequest::createRequest(
            [
                'parameters' => ['name' => 'dictionary 1',], 'method' => '', 'uri' => '', 'content' => '',
                'files' => [], 'cookies' => [], 'server' => [],
            ],
            );

        // when
        $result = $strategy->run($request);

        // then
        $this->assertEquals(Response::HTTP_OK, $result->status());
        $this->assertNotEmpty(json_decode($result->content(), true)['content']['dictionary']);
    }
}
