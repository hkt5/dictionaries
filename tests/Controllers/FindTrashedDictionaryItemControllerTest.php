<?php


use App\Dictionary;
use App\DictionaryItem;
use Illuminate\Http\Response;
use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\WithoutEvents;
use Laravel\Lumen\Testing\WithoutMiddleware;

class FindTrashedDictionaryItemControllerTest extends TestCase
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

        $dictionaryItem = new DictionaryItem();
        $dictionaryItem->id = 1;
        $dictionaryItem->name = 'hello';
        $dictionaryItem->dictionary_id = 1;
        $dictionaryItem->save();
    }

    public function testFindTrashedDictionaryItemWhenDictionaryItemIsNull() :void
    {

        // given
        $id = null;

        // when
        $result = $this->get('/dictionary-items/find-single-trashed/'.$id);

        // then
        $result->seeStatusCode(Response::HTTP_NOT_FOUND);
    }

    public function testFindTrashedDictionaryItemWhenDictionaryItemIsNotInteger() :void
    {

        // given
        $id = 'hello';

        // when
        $result = $this->get('/dictionary-items/find-single-trashed/'.$id);

        // then
        $result->seeStatusCode(Response::HTTP_INTERNAL_SERVER_ERROR);
    }

    public function testFindTrashedDictionaryItemWhenDictionaryItemIsNotExisting() :void
    {

        // given
        $id = 3;
//        $response = [
//            'content' => [], 'error_messages' => ['id' => ['0' => 'The selected id is invalid.',],],
//        ];

        // when
        $result = $this->get('/dictionary-items/find-single-trashed/'.$id);

        // then
        $result->seeStatusCode(Response::HTTP_OK);
        //$result->seeJson($response);
    }

    public function testFindTrashedDictionaryItemWhenDictionaryItemNotDeleted() :void
    {

        // given
        $id = 1;

        // when
        $result = $this->get('/dictionary-items/find-single-trashed/'.$id);

        // then
        $result->seeStatusCode(Response::HTTP_OK);
    }

    public function testFindTrashedDictionaryItemWhenDictionaryItemDeleted() :void
    {

        // given
        $id = 1;
        $dictionaryItem = DictionaryItem::find(1);
        $dictionaryItem->delete();

        // when
        $result = $this->get('/dictionary-items/find-single-trashed/'.$id);

        // then
        $result->seeStatusCode(Response::HTTP_OK);
    }
}
