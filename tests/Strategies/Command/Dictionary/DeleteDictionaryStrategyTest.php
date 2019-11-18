<?php


use App\Dictionary;
use App\Helpers\MockingRequest;
use App\Strategies\Command\Dictionary\DeleteDictionaryStrategy;
use Illuminate\Http\Response;
use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\WithoutEvents;
use Laravel\Lumen\Testing\WithoutMiddleware;

class DeleteDictionaryStrategyTest extends TestCase
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

    public function testDeleteDictionaryWhenDictionaryIdFieldIsEmpty() : void
    {

        // given
        $strategy = new DeleteDictionaryStrategy();
        $request = MockingRequest::createRequest(
            [
                'parameters' => [], 'method' => '', 'uri' => '', 'content' => '', 'files' => [], 'server' => [],
                'cookies' => [],
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

    public function testDeleteDictionaryWhenDictionaryIdIsNotInteger() : void
    {

        // given
        $strategy = new DeleteDictionaryStrategy();
        $request = MockingRequest::createRequest(
            [
                'parameters' => ['id' => 'hello',], 'method' => '', 'uri' => '', 'content' => '', 'files' => [],
                'server' => [], 'cookies' => [],
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

    public function testDeleteDictionaryWhenDictionaryIdNotExisting() : void
    {

        // given
        $strategy = new DeleteDictionaryStrategy();
        $request = MockingRequest::createRequest(
            [
                'parameters' => ['id' => 2,], 'method' => '', 'uri' => '', 'content' => '', 'files' => [],
                'server' => [], 'cookies' => [],
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

    public function testDeleteDictionaryWhenDictionaryIdExisting() : void
    {

        // given
        $strategy = new DeleteDictionaryStrategy();
        $request = MockingRequest::createRequest(
            [
                'parameters' => ['id' => 1,], 'method' => '', 'uri' => '', 'content' => '', 'files' => [],
                'server' => [], 'cookies' => [],
            ]
        );

        // when
        $result = $strategy->run($request);

        // then
        $this->assertEquals(Response::HTTP_OK, $result->status());
        $this->assertNotEmpty(json_decode($result->content(), true)['content']['dictionary']);
    }
}
