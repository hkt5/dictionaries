<?php


use App\Dictionary;
use App\Helpers\MockingRequest;
use App\Strategies\Query\Dictionary\FindTrashedDictionaryByIdStrategy;
use Illuminate\Http\Response;
use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\WithoutEvents;
use Laravel\Lumen\Testing\WithoutMiddleware;

class FindTrashedDictionaryByIdStrategyTest extends TestCase
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
    }

    public function testFindTrashedDictionaryByIdWhenIdFieldIsEmpty() : void
    {

        // given
        $strategy = new FindTrashedDictionaryByIdStrategy();
        $request = MockingRequest::createRequest(
            [
                'parameters' => [], 'method' => '', 'uri' => '', 'content' => '', 'server' => [], 'cookies' => [],
                'files' => [],
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

    public function testFindTrashedDictionaryByIdWhenIdIsNotInteger() : void
    {

        // given
        $strategy = new FindTrashedDictionaryByIdStrategy();
        $request = MockingRequest::createRequest(
            [
                'parameters' => ['id' => 'hello',], 'method' => '', 'uri' => '', 'content' => '', 'server' => [],
                'cookies' => [], 'files' => [],
            ],
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

    public function testFindTrashedDictionaryByIdWhenIdNotExisting() : void
    {

        // given
        $strategy = new FindTrashedDictionaryByIdStrategy();
        $request = MockingRequest::createRequest(
            [
                'parameters' => ['id' => 2,], 'method' => '', 'uri' => '', 'content' => '', 'server' => [],
                'cookies' => [], 'files' => [],
            ],
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

    public function testFindTrashedDictionaryByIdWhenIdExistingAndDictionaryIsNotTrashed() : void
    {

        // given
        $strategy = new FindTrashedDictionaryByIdStrategy();
        $request = MockingRequest::createRequest(
            [
                'parameters' => ['id' => 1,], 'method' => '', 'uri' => '', 'content' => '', 'server' => [],
                'cookies' => [], 'files' => [],
            ],
            );

        // when
        $result = $strategy->run($request);

        // then
        $this->assertEquals(Response::HTTP_OK, $result->status());
        $this->assertEmpty(json_decode($result->content(), true)['content']['dictionary']);
    }

    public function testFindTrashedDictionaryByIdWhenIdExistingAndDictionaryIsTrashed() : void
    {

        // given
        $strategy = new FindTrashedDictionaryByIdStrategy();

        $dictionary = Dictionary::find(1);
        $dictionary->delete();

        $request = MockingRequest::createRequest(
            [
                'parameters' => ['id' => 1,], 'method' => '', 'uri' => '', 'content' => '', 'server' => [],
                'cookies' => [], 'files' => [],
            ],
            );

        // when
        $result = $strategy->run($request);

        // then
        $this->assertEquals(Response::HTTP_OK, $result->status());
        $this->assertNotEmpty(json_decode($result->content(), true)['content']['dictionary']);
    }
}
