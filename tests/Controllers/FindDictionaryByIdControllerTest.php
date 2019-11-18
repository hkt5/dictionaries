<?php


use App\Dictionary;
use Illuminate\Http\Response;
use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\WithoutEvents;
use Laravel\Lumen\Testing\WithoutMiddleware;

class FindDictionaryByIdControllerTest extends TestCase
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

    public function testFindDictionaryById() : void
    {

        // given
        $id = 1;
        $uri = '/find-by-id/'.$id;

        // when
        $result = $this->get($uri);

        // then
        $result->seeStatusCode(Response::HTTP_OK);
    }

    public function testFindDictionaryByIdWhenIdNotExists() : void
    {

        // given
        $id = 2;
        $uri = '/find-by-id/'.$id;
        $response = [
            'content' => [], 'error_messages' => ['id' => ['0' => 'The selected id is invalid.']]
        ];

        // when
        $result = $this->get($uri);

        // then
        $result->seeStatusCode(Response::HTTP_BAD_REQUEST);
        $result->seeJson($response);
    }

    public function testFindDictionaryByIdWhenIdIsNull() : void
    {

        // given
        $id = null;
        $uri = '/find-by-id/'.$id;

        // when
        $result = $this->get($uri);

        // then
        $result->seeStatusCode(Response::HTTP_NOT_FOUND);
    }

    public function testFindDictionaryByIdWhenIdIsNotInt() : void
    {

        // given
        $id = 'hello';
        $uri = '/find-by-id/'.$id;

        // when
        $result = $this->get($uri);

        // then
        $result->seeStatusCode(Response::HTTP_INTERNAL_SERVER_ERROR);
    }
}
