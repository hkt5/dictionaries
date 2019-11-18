<?php


use App\Dictionary;
use Illuminate\Http\Response;
use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\WithoutEvents;
use Laravel\Lumen\Testing\WithoutMiddleware;

class FindDictionaryByNameTest extends TestCase
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

    public function testFindByName() : void
    {

        // given
        $name = 'dictionary';

        // when
        $result = $this->get('/find-by-name/'.$name);

        // then
        $result->seeStatusCode(Response::HTTP_OK);
    }

    public function testFindByNameWhenNameIsNull() : void
    {

        // given
        $name = null;

        // when
        $result = $this->get('/find-by-name/'.$name);

        // then
        $result->seeStatusCode(Response::HTTP_NOT_FOUND);
    }

    public function testFindByNameWhenNameIsNotExisting() : void
    {

        // given
        $name = 1;
        $response = [
            'content' => [], 'error_messages' => ['name' => ['0' => 'The selected name is invalid.',],]
        ];

        // when
        $result = $this->get('/find-by-name/'.$name);

        // then
        $result->seeStatusCode(Response::HTTP_BAD_REQUEST);
        $result->seeJson($response);
    }
}
