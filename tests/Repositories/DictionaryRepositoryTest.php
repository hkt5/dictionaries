<?php


use App\Dictionary;
use App\Helpers\MockingRequest;
use App\Repositories\DictionaryRepository;
use Carbon\Carbon;
use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\WithoutEvents;
use Laravel\Lumen\Testing\WithoutMiddleware;

class DictionaryRepositoryTest extends TestCase
{

    use WithoutEvents;
    use WithoutMiddleware;
    use DatabaseMigrations;

    public function testFindAll() : void
    {

        // given
        $expected_result = 1;

        $dictionary = new Dictionary();
        $dictionary->id = 1;
        $dictionary->name = 'dictionary';
        $dictionary->save();

        // when
        $result = DictionaryRepository::getInstance()->findAll();
        $result_array = $result->get(['*']);

        $this->assertEquals($expected_result, count($result_array));
        $this->assertEquals(1, $result_array['0']['id']);
        $this->assertEquals('dictionary', $result_array['0']['name']);
    }

    public function testFindById() : void
    {

        // given
        $dictionary = new Dictionary();
        $dictionary->id = 1;
        $dictionary->name = 'dictionary';
        $dictionary->save();
        $parameters = [
            'id' => 1,
        ];
        $request = MockingRequest::createRequest(
            [
                'uri' => '', 'method' => '', 'parameters' => $parameters, 'cookies' => [], 'files' => [],
                'server' => [], 'content' => '',
            ]
        );

        // when
        $result = DictionaryRepository::getInstance()->findById($request);

        // then
        $this->assertEquals(1, $result->id);
        $this->assertEquals('dictionary', $result->name);
    }

    public function testFindByName() : void
    {

        // given
        $dictionary = new Dictionary();
        $dictionary->id = 1;
        $dictionary->name = 'dictionary';
        $dictionary->save();
        $parameters = [
            'name' => 'dictionary',
        ];
        $request = MockingRequest::createRequest(
            [
                'uri' => '', 'method' => '', 'parameters' => $parameters, 'cookies' => [], 'files' => [],
                'server' => [], 'content' => '',
            ]
        );

        // when
        $result = DictionaryRepository::getInstance()->findByName($request);
        $result_array = $result->get(['*']);

        // then
        $this->assertEquals(1, $result_array['0']['id']);
        $this->assertEquals('dictionary', $result_array['0']['name']);
    }

    public function testCreate() : void
    {

        // given
        $parameters = [
            'name' => 'dictionary',
        ];
        $request = MockingRequest::createRequest(
            [
                'uri' => '', 'method' => '', 'parameters' => $parameters, 'cookies' => [], 'files' => [],
                'server' => [], 'content' => '',
            ]
        );

        // when
        $result = DictionaryRepository::getInstance()->create($request);

        // then
        $this->assertEquals('dictionary', $result->name);

    }

    public function testUpdate() : void
    {

        // given
        $dictionary = new Dictionary();
        $dictionary->id = 1;
        $dictionary->name = 'dictionary';
        $dictionary->setCreatedAt(Carbon::now());
        $dictionary->setUpdatedAt(Carbon::now());
        $dictionary->save();

        $request = MockingRequest::createRequest(
            [
                'parameters' => ['id' => 1, 'name' => 'updated_dictionary',], 'method' => '', 'uri' => '',
                'content' => '', 'server' => [], 'files' => [], 'cookies' => [],
            ]
        );

        // when
        $result = DictionaryRepository::getInstance()->update($request);

        // then
        $this->assertEquals('updated_dictionary', $result->name);
    }

    public function testDelete() : void
    {

        // given
        $dictionary = new Dictionary();
        $dictionary->id = 1;
        $dictionary->name = 'dictionary';
        $dictionary->save();

        $request = MockingRequest::createRequest(
            [
                'parameters' => ['id' => 1,], 'method' => '', 'uri' => '',
                'content' => '', 'server' => [], 'files' => [], 'cookies' => [],
            ]
        );

        // when
        $result = DictionaryRepository::getInstance()->delete($request);
        $dictionary = Dictionary::onlyTrashed()->find(1);

        // then
        $this->assertEquals(1, $result->id);
        $this->assertEquals('dictionary', $result->name);
        $this->assertEquals(1, $dictionary->id);
        $this->assertEquals('dictionary', $dictionary->name);
    }

    public function testFindTrashed() : void
    {

        // given
        $dictionary = new Dictionary();
        $dictionary->id = 1;
        $dictionary->name = 'dictionary';
        $dictionary->save();
        $dictionary->delete();

        // when
        $result = DictionaryRepository::getInstance()->findTrashed();
        $result_array = $result->get(['*'])->toArray();

        // then
        $this->assertEquals(1, count($result_array));
        $this->assertEquals(1, $result_array['0']['id']);
        $this->assertEquals('dictionary', $result_array['0']['name']);
    }

    public function testFindTrashedById() : void
    {

        // given
        $dictionary = new Dictionary();
        $dictionary->id = 1;
        $dictionary->name = 'dictionary';
        $dictionary->save();
        $dictionary->delete();
        $parameters = [
            'id' => 1,
        ];
        $request = MockingRequest::createRequest(
            [
                'uri' => '', 'method' => '', 'parameters' => $parameters, 'cookies' => [], 'files' => [],
                'server' => [], 'content' => '',
            ]
        );

        // when
        $result = DictionaryRepository::getInstance()->findTrashedById($request);
        $result_data = $result->toArray();

        // then
        $this->assertEquals(1, $result_data['0']['id']);
        $this->assertEquals('dictionary', $result_data['0']['name']);
    }

    public function testRestore() : void
    {

        // given
        $dictionary = new Dictionary();
        $dictionary->id = 1;
        $dictionary->name = 'dictionary';
        $dictionary->save();
        $dictionary->delete();

        $parameters = [
            'id' => 1,
        ];
        $request = MockingRequest::createRequest(
            [
                'uri' => '', 'method' => '', 'parameters' => $parameters, 'cookies' => [], 'files' => [],
                'server' => [], 'content' => '',
            ]
        );

        // when
        $result = DictionaryRepository::getInstance()->restore($request);
        $result_array = $result->get(['*'])->toArray();

        // then
        $this->assertEquals(1, $result_array['0']['id']);
        $this->assertEquals('dictionary', $result_array['0']['name']);
    }

    public function testForceDelete() : void
    {

        // given
        $dictionary = new Dictionary();
        $dictionary->id = 1;
        $dictionary->name = 'dictionary';
        $dictionary->save();
        $dictionary->delete();

        $parameters = [
            'id' => 1,
        ];
        $request = MockingRequest::createRequest(
            [
                'uri' => '', 'method' => '', 'parameters' => $parameters, 'cookies' => [], 'files' => [],
                'server' => [], 'content' => '',
            ]
        );

        // when
        $result = DictionaryRepository::getInstance()->forceDelete($request);
        $result_array = $result->get(['*'])->toArray();

        // then
        $this->assertEmpty($result_array);
    }
}
