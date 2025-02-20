<?php

use Anteris\Autotask\API\ArticleNotes\ArticleNoteCollection;
use Anteris\Autotask\API\ArticleNotes\ArticleNoteService;
use Anteris\Autotask\API\ArticleNotes\ArticleNoteEntity;

use Anteris\Autotask\API\ArticleNotes\ArticleNoteQueryBuilder;
 
use Tests\AbstractTest;
use Tests\Mocks\ClientMock;
use Faker\Factory as Faker;

/**
 * Runs tests for ArticleNoteService.
 */
class ArticleNoteServiceTest extends AbstractTest
{
    /**
     * @covers ArticleNoteService
     */
    public function test_service_creation()
    {
        $this->assertInstanceOf(
            ArticleNoteService::class,
            $this->client->articleNotes()
        );
    }

    /**
     * @covers ArticleNoteService
     */
    public function test_query_returns_collection()
    {
        $result = $this->client->articleNotes()->query()->where('id', 'exist')->records(1)->get();

        // Make sure its a collection
        $this->assertInstanceOf(
            ArticleNoteCollection::class,
            $result
        );
    }

    /**
     * @covers ArticleNoteCollection
     */
    public function test_collection_contains_article_note_entities()
    {
        $result = $this->client->articleNotes()->query()->where('id', 'exist')->records(1)->get();

        // Make sure the collection has entities
        if (count($result) > 0) {
            $this->assertInstanceOf(
                ArticleNoteEntity::class,
                $result->offsetGet(0)
            );
        } else {
            $this->assertCount(0, $result);
        }
    }

    /**
     * @covers ArticleNoteService
     */
    public function test_query_method_returns_query_builder()
    {
        $this->assertInstanceOf(
            ArticleNoteQueryBuilder::class,
            $this->client->articleNotes()->query()
        );
    }

    public function test_entity_can_be_constructed_from_array()
    {
        $values = ClientMock::mockValues(Faker::create(), ArticleNoteEntity::class);

        $entity = new ArticleNoteEntity($values);
        foreach($values as $key => $value) {
            $actual = $entity->{$key};
            $this->assertEquals($value, $actual, "Value of {$key} does not equal expected.");
        }
    }
}
