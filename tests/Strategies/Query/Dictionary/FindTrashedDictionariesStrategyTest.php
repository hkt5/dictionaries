<?php


use App\Dictionary;
use App\Strategies\Query\Dictionary\FindTrashedDictionariesStrategy;
use Illuminate\Http\Response;
use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\WithoutEvents;
use Laravel\Lumen\Testing\WithoutMiddleware;

class FindTrashedDictionariesStrategyTest extends TestCase
{

    use WithoutMiddleware;
    use WithoutEvents;
    use DatabaseMigrations;

    public function setUp(): void
    {
        parent::setUp();
        $dictionary = new Dictionary();
        $dictionary->id =1;
        $dictionary->name = 'dictionary';
        $dictionary->save();
    }

    public function testFindTrashedDictionaries() : void
    {

        // given
        $strategy = new FindTrashedDictionariesStrategy();
        $dictionary = Dictionary::find(1);
        $dictionary->delete();

        // when
        $result = $strategy->run();

        // then
        $this->assertEquals(Response::HTTP_OK, $result->status());
        $this->assertNotEmpty(json_decode($result->content(), true)['content']);
    }

    public function testFindTrashedDictionariesWhenAnyDictionariesAreNotTrashed() : void
    {

        // given
        $strategy = new FindTrashedDictionariesStrategy();

        // when
        $result = $strategy->run();

        // then
        $this->assertEquals(Response::HTTP_OK, $result->status());
        $this->assertEmpty(json_decode($result->content(), true)['content']);
    }
}
