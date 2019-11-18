<?php


use App\Dictionary;
use Illuminate\Http\Response;
use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\WithoutEvents;
use Laravel\Lumen\Testing\WithoutMiddleware;

class DeleteDictionaryControllerTest extends TestCase
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

    public function testDeleteDictionaryWhenIdFieldIsEmpty() : void
    {

        // given
        $data = [];
        $response = [
            'content' => [], 'error_messages' => [
                'id' => ['0' => 'The id field is required.',],
            ],
        ];

        // when
        $result = $this->delete('/delete', $data);

        // then
        $result->seeStatusCode(Response::HTTP_BAD_REQUEST);
        $result->seeJson($response);
    }

    public function testDeleteDictionaryWhenIdIsNotInteger() : void
    {

        // given
        $data = ['id' => 'hello',];
        $response = [
            'content' => [], 'error_messages' => [
                'id' => ['0' => 'The id must be an integer.',],
            ],
        ];

        // when
        $result = $this->delete('/delete', $data);

        // then
        $result->seeStatusCode(Response::HTTP_BAD_REQUEST);
        $result->seeJson($response);
    }

    public function testDeleteDictionaryWhenIdIsNotExisting() : void
    {

        // given
        $data = ['id' => 2,];
        $response = [
            'content' => [], 'error_messages' => [
                'id' => ['0' => 'The selected id is invalid.',],
            ],
        ];

        // when
        $result = $this->delete('/delete', $data);

        // then
        $result->seeStatusCode(Response::HTTP_BAD_REQUEST);
        $result->seeJson($response);
    }

    public function testDeleteDictionaryWhenIdIsExisting() : void
    {

        // given
        $data = ['id' => 1,];
        $response = [
            'name' => 'dictionary',
        ];

        // when
        $result = $this->delete('/delete', $data);

        // then
        $result->seeStatusCode(Response::HTTP_OK);
        $result->seeJsonContains($response);
    }
}
