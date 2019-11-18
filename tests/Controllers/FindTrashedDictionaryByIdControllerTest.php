<?php


use App\Dictionary;
use Illuminate\Http\Response;
use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\WithoutEvents;
use Laravel\Lumen\Testing\WithoutMiddleware;

class FindTrashedDictionaryByIdControllerTest extends TestCase
{

    use WithoutMiddleware;
    use WithoutEvents;
    use DatabaseMigrations;

    public function setUp(): void
    {
        parent::setUp();

        $firstDictionary = new Dictionary();
        $firstDictionary->id = 1;
        $firstDictionary->name = 'dictionary';
        $firstDictionary->save();

        $secondDictionary = new Dictionary();
        $secondDictionary->id = 2;
        $secondDictionary->name = 'dictionary 2';
        $secondDictionary->save();
        $secondDictionary->delete();
    }

    public function testFindTrashedDictionary() : void
    {

        // given
        $id = 2;

        // when
        $result = $this->get('/find-trashed/'.$id);

        // then
        $result->seeStatusCode(Response::HTTP_OK);
    }

    public function testFindTrashedDictionaryWhenDictionaryNotTrashed() : void
    {

        // given
        $id = 1;

        // when
        $result = $this->get('/find-trashed/'.$id);

        // then
        $result->seeStatusCode(Response::HTTP_OK);
    }

    public function testFindTrashedDictionaryWhenIdIsNotInteger() : void
    {

        // given
        $id = 'hello';

        // when
        $result = $this->get('/find-trashed/'.$id);

        // then
        $result->seeStatusCode(Response::HTTP_INTERNAL_SERVER_ERROR);
    }

    public function testFindTrashedDictionaryWhenIdIsNotExisting() : void
    {

        // given
        $id = 3;
        $response = [
            'content' => [], 'error_messages' => ['id' => ['0' => 'The selected id is invalid.'],],
        ];

        // when
        $result = $this->get('/find-trashed/'.$id);

        // then
        $result->seeStatusCode(Response::HTTP_BAD_REQUEST);
        $result->seeJson($response);
    }
}
