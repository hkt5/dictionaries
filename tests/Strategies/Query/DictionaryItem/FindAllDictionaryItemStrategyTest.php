<?php


use App\Dictionary;
use App\DictionaryItem;
use App\Strategies\Query\DictionaryItem\FindAllDictionaryItemsStrategy;
use Illuminate\Http\Response;
use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\WithoutEvents;
use Laravel\Lumen\Testing\WithoutMiddleware;

class FindAllDictionaryItemStrategyTest extends TestCase
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

    public function testFindAll() : void
    {

        // given
        $strategy = new FindAllDictionaryItemsStrategy();
        $expected_size = 1;

        // when
        $result = $strategy->run(null);

        // then
        $this->assertEquals(Response::HTTP_OK, $result->status());
        $this->assertEquals($expected_size, count(json_decode($result->content(), true)['content']));
    }
}
