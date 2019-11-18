<?php


use App\Dictionary;
use App\DictionaryItem;
use Illuminate\Http\Response;
use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\WithoutEvents;
use Laravel\Lumen\Testing\WithoutMiddleware;

class UpdateDictionaryItemControllerTest extends TestCase
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

    public function testUpdateDictionaryItemWhenDictionaryItemIdFieldIsEmpty() : void
    {

        // given
        $data = [
            'name' => 'item', 'dictionary_id' => 1,
        ];
        $response = [
            'content' => [], 'error_messages' => ['id' => ['0' => 'The id field is required.'],],
        ];

        // when
        $result = $this->put('/dictionary-item/update', $data);

        // then
        $result->seeStatusCode(Response::HTTP_BAD_REQUEST);
        $result->seeJson($response);
    }

    public function testUpdateDictionaryItemWhenDictionaryItemIdIsNotInteger() : void
    {

        // given
        $data = [
            'id' => 'hello', 'name' => 'item', 'dictionary_id' => 1,
        ];
        $response = [
            'content' => [], 'error_messages' => ['id' => ['0' => 'The id must be an integer.'],],
        ];

        // when
        $result = $this->put('/dictionary-item/update', $data);

        // then
        $result->seeStatusCode(Response::HTTP_BAD_REQUEST);
        $result->seeJson($response);
    }

    public function testUpdateDictionaryItemWhenDictionaryItemIdIsNotExisting() : void
    {

        // given
        $data = [
            'id' => 2, 'name' => 'item', 'dictionary_id' => 1,
        ];
        $response = [
            'content' => [], 'error_messages' => ['id' => ['0' => 'The selected id is invalid.'],],
        ];

        // when
        $result = $this->put('/dictionary-item/update', $data);

        // then
        $result->seeStatusCode(Response::HTTP_BAD_REQUEST);
        $result->seeJson($response);
    }

    public function testUpdateDictionaryItemWhenNameFieldIsEmpty() : void
    {

        // given
        $data = [
            'id' => 1, 'dictionary_id' => 1,
        ];
        $response = [
            'content' => [], 'error_messages' => ['name' => ['0' => 'The name field is required.'],],
        ];

        // when
        $result = $this->put('/dictionary-item/update', $data);

        // then
        $result->seeStatusCode(Response::HTTP_BAD_REQUEST);
        $result->seeJson($response);
    }

    public function testUpdateDictionaryItemWhenNameIsNotString() : void
    {

        // given
        $data = [
            'id' => 1, 'name' => 1, 'dictionary_id' => 1,
        ];
        $response = [
            'content' => [], 'error_messages' => ['name' => ['0' => 'The name must be a string.'],],
        ];

        // when
        $result = $this->put('/dictionary-item/update', $data);

        // then
        $result->seeStatusCode(Response::HTTP_BAD_REQUEST);
        $result->seeJson($response);
    }

    public function testUpdateDictionaryItemWhenDictionaryIdFieldIsEmpty() : void
    {

        // given
        $data = [
            'id' => 1, 'name'  => 'item',
        ];
        $response = [
            'content' => [], 'error_messages' => ['dictionary_id' => ['0' => 'The dictionary id field is required.'],],
        ];

        // when
        $result = $this->put('/dictionary-item/update', $data);

        // then
        $result->seeStatusCode(Response::HTTP_BAD_REQUEST);
        $result->seeJson($response);
    }

    public function testUpdateDictionaryItemWhenDictionaryIdIsNotInteger() : void
    {

        // given
        $data = [
            'id' => 1, 'name' => 'hello', 'dictionary_id' => 'hello',
        ];
        $response = [
            'content' => [], 'error_messages' => ['dictionary_id' => ['0' => 'The dictionary id must be an integer.'],],
        ];

        // when
        $result = $this->put('/dictionary-item/update', $data);

        // then
        $result->seeStatusCode(Response::HTTP_BAD_REQUEST);
        $result->seeJson($response);
    }

    public function testUpdateDictionaryItemWhenDictionaryIdIsNotExisting() : void
    {

        // given
        $data = [
            'id' => 1, 'name' => 'hello', 'dictionary_id' => 2,
        ];
        $response = [
            'content' => [], 'error_messages' => ['dictionary_id' => ['0' => 'The selected dictionary id is invalid.'],],
        ];

        // when
        $result = $this->put('/dictionary-item/update', $data);

        // then
        $result->seeStatusCode(Response::HTTP_BAD_REQUEST);
        $result->seeJson($response);
    }

    public function testUpdateDictionaryItemWhenNameIsExisting() : void
    {

        // given
        $data = [
            'id' => 1, 'name' => 'item', 'dictionary_id' => 1,
        ];

        // when
        $result = $this->put('/dictionary-item/update', $data);

        // then
        $result->seeStatusCode(Response::HTTP_OK);
    }

    public function testUpdateDictionaryItemWhenNameIsNotExisting() : void
    {

        // given
        $data = [
            'id' => 1, 'name' => 'item', 'dictionary_id' => 1,
        ];

        // when
        $result = $this->put('/dictionary-item/update', $data);

        // then
        $result->seeStatusCode(Response::HTTP_OK);
    }
}
