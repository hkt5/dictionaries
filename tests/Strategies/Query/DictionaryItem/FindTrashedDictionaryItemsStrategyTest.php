<?php


use App\Dictionary;
use App\DictionaryItem;
use App\Strategies\Query\DictionaryItem\FindTrashedDictionaryItemsStrategy;
use Illuminate\Http\Response;
use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\WithoutEvents;
use Laravel\Lumen\Testing\WithoutMiddleware;

class FindTrashedDictionaryItemsStrategyTest extends TestCase
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

        $first_dictionary_item = new DictionaryItem();
        $first_dictionary_item->id = 1;
        $first_dictionary_item->name = 'item 1';
        $first_dictionary_item->dictionary_id = 1;
        $first_dictionary_item->save();

        $second_dictionary_item = new DictionaryItem();
        $second_dictionary_item->id = 2;
        $second_dictionary_item->name = 'item 2';
        $second_dictionary_item->dictionary_id = 1;
        $second_dictionary_item->save();
    }

    public function testFindTrashedDictionaryItemsStrategyWhenNotAreTrashedItems() : void
    {

        // given
        $strategy = new FindTrashedDictionaryItemsStrategy();
        $expected_result = 0;

        // when
        $result = $strategy->run(null);

        // then
        $this->assertEquals(Response::HTTP_OK, $result->status());
        $this->assertEquals($expected_result, count(json_decode($result->content(), true)['content']));
    }

    public function testFindTrashedDictionaryItemsStrategyWhenAreTrashedItems() : void
    {

        // given
        $dictionary_item = DictionaryItem::find(2);
        $dictionary_item->delete();
        $strategy = new FindTrashedDictionaryItemsStrategy();
        $expected_result = 1;

        // when
        $result = $strategy->run(null);

        // then
        $this->assertEquals(Response::HTTP_OK, $result->status());
        $this->assertEquals($expected_result, count(json_decode($result->content(), true)['content']));
    }
}
