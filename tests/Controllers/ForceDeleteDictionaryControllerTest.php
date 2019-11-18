<?php


use App\Dictionary;
use Illuminate\Http\Response;
use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\WithoutEvents;
use Laravel\Lumen\Testing\WithoutMiddleware;

class ForceDeleteDictionaryControllerTest extends TestCase
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

    public function testForceDeleteDictionaryWhenIdFieldIsEmpty() : void
    {

        // given
        $data = [];
        $response = [
            'content' => [], 'error_messages' => ['id' => ['0' => 'The id field is required.'],],
        ];

        // when
        $result = $this->delete('/force-delete', $data);

        // then
        $result->seeStatusCode(Response::HTTP_BAD_REQUEST);
        $result->seeJson($response);
    }

    public function testForceDeleteDictionaryWhenIdIsNotInteger() : void
    {

        // given
        $data = ['id' => 'hello',];
        $response = [
            'content' => [], 'error_messages' => ['id' => ['0' => 'The id must be an integer.'],],
        ];

        // when
        $result = $this->delete('/force-delete', $data);

        // then
        $result->seeStatusCode(Response::HTTP_BAD_REQUEST);
        $result->seeJson($response);
    }

    public function testForceDeleteDictionaryWhenIdNotExisting() : void
    {

        // given
        $data = ['id' => 2,];
        $response = [
            'content' => [], 'error_messages' => ['id' => ['0' => 'The selected id is invalid.'],],
        ];

        // when
        $result = $this->delete('/force-delete', $data);

        // then
        $result->seeStatusCode(Response::HTTP_BAD_REQUEST);
        $result->seeJson($response);
    }

    public function testForceDeleteDictionaryWhenDictionaryIsNotDelete() : void
    {

        // given
        $data = ['id' => 1,];

        // when
        $result = $this->delete('/force-delete', $data);

        // then
        $result->seeStatusCode(Response::HTTP_OK);
    }

    public function testForceDeleteDictionaryWhenDictionaryIsWasDeleted() : void
    {

        // given
        $data = ['id' => 1,];
        $dictionary = Dictionary::find(1);
        $dictionary->delete();

        // when
        $result = $this->delete('/force-delete', $data);

        // then
        $result->seeStatusCode(Response::HTTP_OK);
    }
}
