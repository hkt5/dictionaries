<?php


use App\Dictionary;
use App\DictionaryItem;
use Illuminate\Http\Response;
use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\WithoutEvents;
use Laravel\Lumen\Testing\WithoutMiddleware;

class FindDictionaryItemByIdControllerTest extends TestCase
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

    public function testFindDictionaryById() : void
    {

        // given
        $id = 1;

        // when
        $result = $this->get('/dictionary-items/find-by-id/'.$id);

        // then
        $result->seeStatusCode(Response::HTTP_OK);
    }

    public function testFindDictionaryByIdWhenIdIsEmpty() : void
    {

        // given
        $id = null;

        // when
        $result = $this->get('/dictionary-items/find-by-id/'.$id);

        // then
        $result->seeStatusCode(Response::HTTP_NOT_FOUND);
    }

    public function testFindDictionaryByIdWhenIdIsNotInteger() : void
    {

        // given
        $id = 'hello';

        // when
        $result = $this->get('/dictionary-items/find-by-id/'.$id);

        // then
        $result->seeStatusCode(Response::HTTP_INTERNAL_SERVER_ERROR);
    }

    public function testFindDictionaryItemWhenIdIsNotExisting() : void
    {

        // given
        $id = 2;
        $response = [
            'content' => [], 'error_messages' => ['id' => ['0' => 'The selected id is invalid.'],],
        ];

        // when
        $result = $this->get('/dictionary-items/find-by-id/'.$id);

        // then
        $result->seeStatusCode(Response::HTTP_BAD_REQUEST);
        $result->seeJson($response);
    }
}
