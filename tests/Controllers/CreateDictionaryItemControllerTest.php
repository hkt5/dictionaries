<?php


use App\Dictionary;
use App\DictionaryItem;
use Illuminate\Http\Response;
use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\WithoutEvents;
use Laravel\Lumen\Testing\WithoutMiddleware;

class CreateDictionaryItemControllerTest extends TestCase
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

        $dictionaryItem = new DictionaryItem();
        $dictionaryItem->id = 1;
        $dictionaryItem->name = 'item';
        $dictionaryItem->dictionary_id = 1;
        $dictionaryItem->save();
    }

    public function testCreateDictionaryItemWhenDictionaryNameFieldIsEmpty() : void
    {

        // given
        $data = ['dictionary_id' => 1,];
        $response = [
            'content' => [], 'error_messages' => ['name' => ['0' => 'The name field is required.',],],
        ];

        // when
        $result = $this->post('/dictionary-item/create', $data);

        // then
        $result->seeStatusCode(Response::HTTP_BAD_REQUEST);
        $result->seeJson($response);
    }

    public function testCreateDictionaryItemWhenDictionaryNameIsNotString() : void
    {

        // given
        $data = ['name' => 1, 'dictionary_id' => 1,];
        $response = [
            'content' => [], 'error_messages' => ['name' => ['0' => 'The name must be a string.',],],
        ];

        // when
        $result = $this->post('/dictionary-item/create', $data);

        // then
        $result->seeStatusCode(Response::HTTP_BAD_REQUEST);
        $result->seeJson($response);
    }

    public function testCreateDictionaryItemWhenDictionaryIdFieldIsEmpty() : void
    {

        // given
        $data = ['name' => 'item',];
        $response = [
            'content' => [], 'error_messages' => ['dictionary_id' => ['0' => 'The dictionary id field is required.',],],
        ];

        // when
        $result = $this->post('/dictionary-item/create', $data);

        // then
        $result->seeStatusCode(Response::HTTP_BAD_REQUEST);
        $result->seeJson($response);
    }

    public function testCreateDictionaryItemWhenDictionaryIdIsNotInteger() : void
    {

        // given
        $data = ['name' => 'item', 'dictionary_id' => 'hello',];
        $response = [
            'content' => [], 'error_messages' => ['dictionary_id' => ['0' => 'The dictionary id must be an integer.',],],
        ];

        // when
        $result = $this->post('/dictionary-item/create', $data);

        // then
        $result->seeStatusCode(Response::HTTP_BAD_REQUEST);
        $result->seeJson($response);
    }

    public function testCreateDictionaryItemWhenDictionaryIdIsNotExisting() : void
    {

        // given
        $data = ['name' => 'item', 'dictionary_id' => 2,];
        $response = [
            'content' => [], 'error_messages' => ['dictionary_id' => ['0' => 'The selected dictionary id is invalid.',],],
        ];

        // when
        $result = $this->post('/dictionary-item/create', $data);

        // then
        $result->seeStatusCode(Response::HTTP_BAD_REQUEST);
        $result->seeJson($response);
    }

    public function testCreateDictionaryItemWhenDictionaryNameHasAlreadyBeenTaken() : void
    {

        // given
        $data = ['name' => 'item', 'dictionary_id' => 1,];

        // when
        $result = $this->post('/dictionary-item/create', $data);

        // then
        $result->seeStatusCode(Response::HTTP_OK);
    }

    public function testCreateDictionaryItemWhenDictionaryNameHasNotAlreadyBeenTaken() : void
    {

        // given
        $data = ['name' => 'item 2', 'dictionary_id' => 1,];

        // when
        $result = $this->post('/dictionary-item/create', $data);

        // then
        $result->seeStatusCode(Response::HTTP_OK);
    }
}
