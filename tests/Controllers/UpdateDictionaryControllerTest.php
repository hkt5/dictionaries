<?php


use App\Dictionary;
use Illuminate\Http\Response;
use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\WithoutEvents;
use Laravel\Lumen\Testing\WithoutMiddleware;

class UpdateDictionaryControllerTest extends TestCase
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
    }

    public function testUpdateDictionaryWhenDictionaryIdFieldIsEmpty() : void
    {

        // given
        $data = [
            'name' => 'dictionary 1',
        ];
        $response = [
            'content' => [], 'error_messages' => [
                'id' => ['0' => 'The id field is required.',],
            ],
        ];

        // when
        $result = $this->put('/update', $data);

        // then
        $result->seeStatusCode(Response::HTTP_BAD_REQUEST);
        $result->seeJson($response);
    }

    public function testUpdateDictionaryWhenDictionaryIdIsNotInteger() : void
    {

        // given
        $data = [
            'id' => 'hello', 'name' => 'dictionary 1',
        ];
        $response = [
            'content' => [], 'error_messages' => [
                'id' => ['0' => 'The id must be an integer.',],
            ],
        ];

        // when
        $result = $this->put('/update', $data);

        // then
        $result->seeStatusCode(Response::HTTP_BAD_REQUEST);
        $result->seeJson($response);
    }

    public function testUpdateDictionaryWhenDictionaryIdNotExisting() : void
    {

        // given
        $data = [
            'id' => 2, 'name' => 'dictionary 1',
        ];
        $response = [
            'content' => [], 'error_messages' => [
                'id' => ['0' => 'The selected id is invalid.',],
            ],
        ];

        // when
        $result = $this->put('/update', $data);

        // then
        $result->seeStatusCode(Response::HTTP_BAD_REQUEST);
        $result->seeJson($response);
    }

    public function testUpdateDictionaryWhenDictionaryNameIsEmpty() : void
    {

        // given
        $data = [
            'id' => 1,
        ];
        $response = [
            'content' => [], 'error_messages' => [
                'name' => ['0' => 'The name field is required.',],
            ],
        ];

        // when
        $result = $this->put('/update', $data);

        // then
        $result->seeStatusCode(Response::HTTP_BAD_REQUEST);
        $result->seeJson($response);
    }

    public function testUpdateDictionaryWhenDictionaryNameIsNotString() : void
    {

        // given
        $data = [
            'id' => 1, 'name' => 1,
        ];
        $response = [
            'content' => [], 'error_messages' => [
                'name' => ['0' => 'The name must be a string.',],
            ],
        ];

        // when
        $result = $this->put('/update', $data);

        // then
        $result->seeStatusCode(Response::HTTP_BAD_REQUEST);
        $result->seeJson($response);
    }

    public function testUpdateDictionaryWhenDictionaryNameHasAlreadyBeenTaken() : void
    {

        // given
        $data = [
            'id' => 1, 'name' => 'dictionary',
        ];
        $response = [
            'content' => [], 'error_messages' => [
                'name' => ['0' => 'The name has already been taken.',],
            ],
        ];

        // when
        $result = $this->put('/update', $data);

        // then
        $result->seeStatusCode(Response::HTTP_BAD_REQUEST);
        $result->seeJson($response);
    }

    public function testUpdateDictionary() : void
    {

        // given
        $data = [
            'id' => 1, 'name' => 'dictionary 1',
        ];
        $response = ['name' => 'dictionary 1',];

        // when
        $result = $this->put('/update', $data);

        // then
        $result->seeStatusCode(Response::HTTP_OK);
        $result->seeJsonContains($response);
    }
}
