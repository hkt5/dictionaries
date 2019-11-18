<?php


use App\Dictionary;
use App\DictionaryItem;
use Illuminate\Http\Response;
use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\WithoutEvents;
use Laravel\Lumen\Testing\WithoutMiddleware;

class ForceDeleteDictionaryItemControllerTest extends TestCase
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
        $dictionaryItem->name = 'dictionary';
        $dictionaryItem->dictionary_id = 1;
        $dictionaryItem->save();
    }

    public function testForceDeleteDictionaryItemWhenIdFieldIsEmpty() : void
    {

        // given
        $data = [];
        $response = [
            'content' => [], 'error_messages' => ['id' => ['0' => 'The id field is required.'],],
        ];

        // when
        $result = $this->delete('/dictionary-item/force-delete', $data);

        // then
        $result->seeStatusCode(Response::HTTP_BAD_REQUEST);
        $result->seeJson($response);
    }

    public function testForceDeleteDictionaryItemWhenIdIsNotInteger() : void
    {

        // given
        $data = ['id' => 'hello',];
        $response = [
            'content' => [], 'error_messages' => ['id' => ['0' => 'The id must be an integer.'],],
        ];

        // when
        $result = $this->delete('/dictionary-item/force-delete', $data);

        // then
        $result->seeStatusCode(Response::HTTP_BAD_REQUEST);
        $result->seeJson($response);
    }

    public function testForceDeleteDictionaryIdWhenIdNotExisting() : void
    {

        // given
        $data = ['id' => 2,];
        $response = [
            'content' => [], 'error_messages' => ['id' => ['0' => 'The selected id is invalid.'],],
        ];

        // when
        $result = $this->delete('/dictionary-item/force-delete', $data);

        // then
        $result->seeStatusCode(Response::HTTP_BAD_REQUEST);
        $result->seeJson($response);
    }

    public function testForceDeleteDictionaryItemWhenDictionaryItemIsNotDelete() : void
    {

        // given
        $data = ['id' => 1,];

        // when
        $result = $this->delete('/dictionary-item/force-delete', $data);

        // then
        $result->seeStatusCode(Response::HTTP_OK);
    }

    public function testForceDeleteDictionaryWhenDictionaryDeleted() : void
    {

        // given
        $data = ['id' => 1,];
        $dictionaryItem = DictionaryItem::find(1);
        $dictionaryItem->delete();

        // when
        $result = $this->delete('/dictionary-item/force-delete', $data);

        // then
        $result->seeStatusCode(Response::HTTP_OK);
    }
}
