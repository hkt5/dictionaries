<?php


use App\Dictionary;
use App\Helpers\MockingRequest;
use App\Strategies\Command\Dictionary\ForceDeleteStrategy;
use Illuminate\Http\Response;
use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\WithoutEvents;
use Laravel\Lumen\Testing\WithoutMiddleware;

class ForceDeleteStrategyTest extends TestCase
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

    public function testForceDeleteDictionaryWhenDictionaryIdIsEmpty() : void
    {

        // given
        $strategy = new ForceDeleteStrategy();
        $request = MockingRequest::createRequest(
            [
                'parameters' => [], 'method' => '', 'uri' => '', 'content' => '', 'server' => [], 'files' => [],
                'cookies' => [],
            ]
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

    public function testForceDeleteDictionaryWhenDictionaryIdIsNotInteger() : void
    {

        // given
        $strategy = new ForceDeleteStrategy();
        $request = MockingRequest::createRequest(
            [
                'parameters' => ['id' => 'hello',], 'method' => '', 'uri' => '', 'content' => '', 'server' => [],
                'files' => [], 'cookies' => [],
            ]
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

    public function testForceDeleteDictionaryWhenDictionaryIdNotExisting() : void
    {

        // given
        $strategy = new ForceDeleteStrategy();
        $request = MockingRequest::createRequest(
            [
                'parameters' => ['id' => 2,], 'method' => '', 'uri' => '', 'content' => '', 'server' => [],
                'files' => [], 'cookies' => [],
            ]
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

    public function testForceDeleteDictionaryWhenDictionaryIsNotDeleted() : void
    {

        // given
        $strategy = new ForceDeleteStrategy();
        $request = MockingRequest::createRequest(
            [
                'parameters' => ['id' => 1,], 'method' => '', 'uri' => '', 'content' => '', 'server' => [],
                'files' => [],
                'cookies' => [],
            ]
        );

        // when
        $result = $strategy->run($request);

        // then
        $this->assertEquals(Response::HTTP_OK, $result->status());
    }

    public function testForceDeleteDictionaryWhenDictionaryIsDeleted() : void
    {

        // given
        $dictionary = Dictionary::find(1);
        $dictionary->delete();
        $strategy = new ForceDeleteStrategy();
        $request = MockingRequest::createRequest(
            [
                'parameters' => ['id' => 1,], 'method' => '', 'uri' => '', 'content' => '', 'server' => [],
                'files' => [], 'cookies' => [],
            ]
        );

        // when
        $result = $strategy->run($request);

        // then
        $this->assertEquals(Response::HTTP_OK, $result->status());
        $this->assertEmpty(json_decode($result->content(), true)['content']['dictionary']);
    }
}
