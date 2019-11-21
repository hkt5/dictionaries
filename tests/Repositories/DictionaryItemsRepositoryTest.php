<?php


use App\Dictionary;
use App\DictionaryItem;
use App\Helpers\MockingRequest;
use App\Repositories\DictionaryItemsRepository;
use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\WithoutEvents;
use Laravel\Lumen\Testing\WithoutMiddleware;

class DictionaryItemsRepositoryTest extends TestCase
{

    use WithoutEvents;
    use WithoutMiddleware;
    use DatabaseMigrations;

    private $dictionary_id = 1;

    public function setUp(): void
    {
        parent::setUp();

        $dictionary = new Dictionary();
        $dictionary->id = $this->dictionary_id;
        $dictionary->name = "dictionary";
        $dictionary->save();
    }

    public function testFindAll() : void
    {

        // given
        $first_dictionary_item = new DictionaryItem();
        $first_dictionary_item->id = 1;
        $first_dictionary_item->name = "dictionary item 1";
        $first_dictionary_item->dictionary_id = $this->dictionary_id;
        $first_dictionary_item->save();

        $second_dictionary_item = new DictionaryItem();
        $second_dictionary_item->id = 2;
        $second_dictionary_item->name = "dictionary item 2";
        $second_dictionary_item->dictionary_id = $this->dictionary_id;
        $second_dictionary_item->save();
        $second_dictionary_item->delete();

        // when
        $result = DictionaryItemsRepository::getInstance()->findAll();
        $result_array = $result->get(['*']);

        // then
        $this->assertEquals(1, count($result_array));
    }

    public function testFindById() : void
    {

        // given
        $dictionary_item = new DictionaryItem();
        $dictionary_item->id = 1;
        $dictionary_item->name = 'dictionary_item';
        $dictionary_item->dictionary_id = 1;
        $dictionary_item->save();

        $request = MockingRequest::createRequest(
            [
                'parameters' => ['id' => 1,], 'method' => '', 'uri' => '', 'content' => '', 'files' => [],
                'cookies' => [], 'server' => [],
            ]
        );

        // when
        $result = DictionaryItemsRepository::getInstance()->findById($request);

        // then
        $this->assertEquals(1, $result->id);
        $this->assertEquals('dictionary_item', $result->name);
        $this->assertEquals(1, $result->dictionary_id);
    }

    public function testFindByName() : void
    {

        // given
        $dictionary_item = new DictionaryItem();
        $dictionary_item->id = 1;
        $dictionary_item->name = 'dictionary_item';
        $dictionary_item->dictionary_id = 1;
        $dictionary_item->save();

        $request = MockingRequest::createRequest(
            [
                'parameters' => ['name' => 'dictionary_item',], 'method' => '', 'uri' => '', 'content' => '', 'files' => [],
                'cookies' => [], 'server' => [],
            ]
        );

        // when
        $result = DictionaryItemsRepository::getInstance()->findByName($request)->first(['*']);

        // then
        $this->assertEquals(1, $result->id);
        $this->assertEquals('dictionary_item', $result->name);
        $this->assertEquals(1, $result->dictionary_id);
    }

    public function testCreate() : void
    {

        // given
        $request = MockingRequest::createRequest(
            [
                'parameters' => [
                    'name' => 'dictionary_item', 'dictionary_id' => 1,
                ], 'method' => '', 'uri' => '', 'content' => '', 'files' => [], 'cookies' => [], 'server' => []
            ],
        );

        // when
        $result = DictionaryItemsRepository::getInstance()->create($request);

        // then
        $this->assertEquals(1, $result->id);
        $this->assertEquals('dictionary_item', $result->name);
        $this->assertEquals(1, $result->dictionary_id);
    }

    public function testUpdate() : void
    {

        // given

        $dictionary = new Dictionary();
        $dictionary->id = 2;
        $dictionary->name = 'new dictionary';
        $dictionary->save();

        $dictionary_item = new DictionaryItem();
        $dictionary_item->id = 1;
        $dictionary_item->name = 'dictionary_item';
        $dictionary_item->dictionary_id = 1;
        $dictionary_item->save();

        $request = MockingRequest::createRequest(
            [
                'parameters' => [
                    'id' => 1, 'name' => 'new dictionary item', 'dictionary_id' => 2,
                ], 'uri' => '', 'method' => '', 'content' => '', 'files' => [], 'server' => [], 'cookies' => [],
            ],
        );

        // when
        $result = DictionaryItemsRepository::getInstance()->update($request);

        // then
        $this->assertEquals(1, $result->id);
        $this->assertEquals('new dictionary item', $result->name);
        $this->assertEquals(2, $result->dictionary_id);
    }

    public function testDelete() : void
    {

        // given
        $dictionary_item = new DictionaryItem();
        $dictionary_item->id = 1;
        $dictionary_item->name = 'dictionary item';
        $dictionary_item->dictionary_id = 1;
        $dictionary_item->save();

        $request = MockingRequest::createRequest(
            [
                'parameters' => ['id' => 1], 'uri' => '', 'method' => '', 'content' => '', 'files' => [],
                'server' => [], 'cookies' => [],
            ],
        );

        // when
        $result = DictionaryItemsRepository::getInstance()->delete($request);

        // then
        $this->assertEquals(1, $result->id);
        $this->assertEquals('dictionary item', $dictionary_item->name);
        $this->assertEquals(1, $dictionary_item->dictionary_id);
    }

    public function testFindTrashed() : void
    {

        // given
        $dictionary_item = new DictionaryItem();
        $dictionary_item->id = 1;
        $dictionary_item->name = 'dictionary_item';
        $dictionary_item->dictionary_id = 1;
        $dictionary_item->save();
        $dictionary_item->delete();

        // when
        $result = DictionaryItemsRepository::getInstance()->findTrashed()->get(['*']);

        // then
        $this->assertEquals(1, count($result));
        $this->assertEquals(1, $result['0']['id']);
        $this->assertEquals('dictionary_item', $result['0']['name']);
        $this->assertEquals(1, $result['0']['dictionary_id']);
    }

    public function testFindTrashedById() : void
    {

        // given
        $dictionary_item = new DictionaryItem();
        $dictionary_item->id = 1;
        $dictionary_item->name = 'dictionary item';
        $dictionary_item->dictionary_id = 1;
        $dictionary_item->save();
        $dictionary_item->delete();

        $request = MockingRequest::createRequest(
            [
                'parameters' => ['id' => 1], 'uri' => '', 'method' => '', 'content' => '', 'files' => [],
                'server' => [], 'cookies' => [],
            ],
        );

        // when
        $result = DictionaryItemsRepository::getInstance()->findTrashedById($request)->first(['*']);

        // then
        $this->assertEquals(1, $result->id);
        $this->assertEquals('dictionary item', $result->name);
        $this->assertEquals(1, $result->dictionary_id);
    }

    public function testRestore() : void
    {

        // given
        $dictionary_item = new DictionaryItem();
        $dictionary_item->id = 1;
        $dictionary_item->name = 'dictionary item';
        $dictionary_item->dictionary_id = 1;
        $dictionary_item->save();
        $dictionary_item->delete();

        $request = MockingRequest::createRequest(
            [
                'parameters' => ['id' => 1], 'uri' => '', 'method' => '', 'content' => '', 'files' => [],
                'server' => [], 'cookies' => [],
            ],
        );

        // when
        $result = DictionaryItemsRepository::getInstance()->restore($request);

        // then
        $this->assertEquals(1, $result->id);
        $this->assertEquals('dictionary item', $result->name);
        $this->assertEquals(1, $result->dictionary_id);
    }

    public function testForceDelete() : void
    {

        // given
        $dictionary_item = new DictionaryItem();
        $dictionary_item->id = 1;
        $dictionary_item->name = 'dictionary item';
        $dictionary_item->dictionary_id = 1;
        $dictionary_item->save();
        $dictionary_item->delete();

        $request = MockingRequest::createRequest(
            [
                'parameters' => ['id' => 1], 'uri' => '', 'method' => '', 'content' => '', 'files' => [],
                'server' => [], 'cookies' => [],
            ],
        );

        // when
        $result = DictionaryItemsRepository::getInstance()->forceDelete($request)->first(['*']);

        // then
        $this->assertEmpty($result);
    }
}
