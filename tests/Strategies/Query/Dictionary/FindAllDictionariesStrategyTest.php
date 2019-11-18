<?php


use App\Dictionary;
use App\Strategies\Query\Dictionary\FindAllDictionariesStrategy;
use Illuminate\Http\Response;
use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\WithoutEvents;
use Laravel\Lumen\Testing\WithoutMiddleware;

class FindAllDictionariesStrategyTest extends TestCase
{

    use WithoutMiddleware;
    use WithoutEvents;
    use DatabaseMigrations;

    public function setUp(): void
    {
        parent::setUp();

        $dictionary = new Dictionary();
        $dictionary->id = 1;
        $dictionary->name = 'sample dictionary';
        $dictionary->save();
    }

    public function testFindAll() : void
    {

        // given
        $strategy = new FindAllDictionariesStrategy();

        // when
        $result = $strategy->run(null);

        // then
        $this->assertEquals(Response::HTTP_OK, $result->status());
        $this->assertEquals(1, count(json_decode($result->content(), true)['content']));
    }
}
