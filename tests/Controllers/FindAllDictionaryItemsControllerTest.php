<?php


use App\Dictionary;
use App\DictionaryItem;
use Illuminate\Http\Response;
use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\WithoutEvents;
use Laravel\Lumen\Testing\WithoutMiddleware;

class FindAllDictionaryItemsControllerTest extends TestCase
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

    public function testFindAll() : void
    {

        // given

        // when
        $result = $this->get('/dictionary-items');

        // when
        $result->seeStatusCode(Response::HTTP_OK);
    }
}
