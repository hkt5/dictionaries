<?php


use App\Dictionary;
use Illuminate\Http\Response;
use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\WithoutEvents;
use Laravel\Lumen\Testing\WithoutMiddleware;

class RestoreDictionaryControllerTest extends TestCase
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

    public function testRestoreDictionaryWhenDictionaryIdFieldIsEmpty() : void
    {

        // given
        $data = [];
        $response = [
            'content' => [], 'error_messages' => ['id' => ['0' => 'The id field is required.'],],
        ];

        // when
        $result = $this->put('/restore', $data);

        // then
        $result->seeStatusCode(Response::HTTP_BAD_REQUEST);
        $result->seeJson($response);
    }

    public function testRestoreDictionaryWhenDictionaryIdIsNotInteger() : void
    {

        // given
        $data = ['id' => 'hello',];
        $response = [
            'content' => [], 'error_messages' => ['id' => ['0' => 'The id must be an integer.'],],
        ];

        // when
        $result = $this->put('/restore', $data);

        // then
        $result->seeStatusCode(Response::HTTP_BAD_REQUEST);
        $result->seeJson($response);
    }

    public function testRestoreDictionaryWhenDictionaryIdNotExisting() : void
    {

        // given
        $data = ['id' => 2,];
        $response = [
            'content' => [], 'error_messages' => ['id' => ['0' => 'The selected id is invalid.'],],
        ];

        // when
        $result = $this->put('/restore', $data);

        // then
        $result->seeStatusCode(Response::HTTP_BAD_REQUEST);
        $result->seeJson($response);
    }

    public function testRestoreDictionaryWhenDictionaryIsNotDeleted() : void
    {

        // given
        $data = ['id' => 1,];

        // when
        $result = $this->put('/restore', $data);

        // then
        $result->seeStatusCode(Response::HTTP_OK);
    }

    public function testRestoreDictionaryWhenDictionaryWasDeleted() : void
    {

        // given
        $dictionary = Dictionary::find(1);
        $dictionary->delete();
        $data = ['id' => 1,];

        // when
        $result = $this->put('/restore', $data);

        // then
        $result->seeStatusCode(Response::HTTP_OK);
    }
}
