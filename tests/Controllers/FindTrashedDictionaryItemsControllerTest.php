<?php


use App\Dictionary;
use App\DictionaryItem;
use Illuminate\Http\Response;
use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\WithoutEvents;
use Laravel\Lumen\Testing\WithoutMiddleware;

class FindTrashedDictionaryItemsControllerTest extends TestCase
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

    public function testFindTrashedDictionaryItems() : void
    {

        // given
        $dictionaryItem = DictionaryItem::find(1);
        $dictionaryItem->delete();

        // when
        $result = $this->get('/dictionary-items/find-trashed');

        // then
        $result->seeStatusCode(Response::HTTP_OK);
    }

    public function testFindTrashedDictionaryItemsWhenItemsNotTrashed() : void
    {

        // given

        // when
        $result = $this->get('/dictionary-items/find-trashed');

        // then
        $result->seeStatusCode(Response::HTTP_OK);
    }
}
