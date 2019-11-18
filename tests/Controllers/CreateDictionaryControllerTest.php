<?php


use App\Dictionary;
use Illuminate\Http\Response;
use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\WithoutEvents;
use Laravel\Lumen\Testing\WithoutMiddleware;

class CreateDictionaryControllerTest extends TestCase
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

    public function testCreateDictionaryWhenDictionaryNameIsEmpty() : void
    {

        // given
        $data = [];
        $response = [
            'content' => [], 'error_messages' => [
                'name' => ['0' => 'The name field is required.',],
            ],
        ];

        // when
        $result = $this->post('/create', $data);

        // then
        $result->seeStatusCode(Response::HTTP_BAD_REQUEST);
        $result->seeJson($response);
    }

    public function testCreateDictionaryWhenDictionaryNameIsNotString() : void
    {

        // given
        $data = [
            'name' => 1,
        ];
        $response = [
            'content' => [], 'error_messages' => [
                'name' => ['0' => 'The name must be a string.',],
            ],
        ];

        // when
        $result = $this->post('/create', $data);

        // then
        $result->seeStatusCode(Response::HTTP_BAD_REQUEST);
        $result->seeJson($response);
    }

    public function testCreateDictionaryWhenDictionaryNameHasAlreadyBeenTaken() : void
    {

        // given
        $data = [
            'name' => 'dictionary',
        ];
        $response = [
            'content' => [], 'error_messages' => [
                'name' => ['0' => 'The name has already been taken.',],
            ],
        ];

        // when
        $result = $this->post('/create', $data);

        // then
        $result->seeStatusCode(Response::HTTP_BAD_REQUEST);
        $result->seeJson($response);
    }

    public function testCreateDictionary() : void
    {

        // given
        $data = [
            'name' => 'dictionary 1',
        ];
        $response = ['name' => 'dictionary 1',];

        // when
        $result = $this->post('/create', $data);

        // then
        $result->seeStatusCode(Response::HTTP_OK);
        $result->seeJsonContains($response);
    }
}
