<?php


use App\Dictionary;
use Illuminate\Http\Response;
use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\WithoutEvents;
use Laravel\Lumen\Testing\WithoutMiddleware;

class FindTrashedDictionariesControllerTest extends TestCase
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

    public function testFindTrashedDictionariesWhenAnyDictionariesAreNotTrashed() : void
    {

        // given
        $uri = '/find-trashed';

        // when
        $result = $this->get($uri);

        // then
        $result->seeStatusCode(Response::HTTP_OK);
    }

    public function testFindTrashed() : void
    {

        // given
        $uri = '/find-trashed';
        $dictionary = Dictionary::find(1);
        $dictionary->delete();

        // when
        $result = $this->get($uri);

        // then
        $result->seeStatusCode(Response::HTTP_OK);
    }
}
