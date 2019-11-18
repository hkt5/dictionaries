<?php


use App\Dictionary;
use Illuminate\Http\Response;
use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\WithoutEvents;
use Laravel\Lumen\Testing\WithoutMiddleware;

class FindAllDictionariesControllerTest extends TestCase
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
    }

    public function testFindAllDictionaries() : void
    {

        // given
        $expected_result = 1;

        // when
        $result = $this->get('/');

        // then
        $result->seeStatusCode(Response::HTTP_OK);
        $result->seeJson(['name' => 'dictionary']);
    }
}
