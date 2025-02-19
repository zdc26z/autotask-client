<?php

use Anteris\Autotask\API\Tags\TagCollection;
use Anteris\Autotask\API\Tags\TagService;
use Anteris\Autotask\API\Tags\TagEntity;

use Anteris\Autotask\API\Tags\TagQueryBuilder;
 
use Tests\AbstractTest;
use Tests\Mocks\ClientMock;
use Faker\Factory as Faker;

/**
 * Runs tests for TagService.
 */
class TagServiceTest extends AbstractTest
{
    /**
     * @covers TagService
     */
    public function test_service_creation()
    {
        $this->assertInstanceOf(
            TagService::class,
            $this->client->tags()
        );
    }

    /**
     * @covers TagService
     */
    public function test_query_returns_collection()
    {
        $result = $this->client->tags()->query()->where('id', 'exist')->records(1)->get();

        // Make sure its a collection
        $this->assertInstanceOf(
            TagCollection::class,
            $result
        );
    }

    /**
     * @covers TagCollection
     */
    public function test_collection_contains_tag_entities()
    {
        $result = $this->client->tags()->query()->where('id', 'exist')->records(1)->get();

        // Make sure the collection has entities
        if (count($result) > 0) {
            $this->assertInstanceOf(
                TagEntity::class,
                $result->offsetGet(0)
            );
        } else {
            $this->assertCount(0, $result);
        }
    }

    /**
     * @covers TagService
     */
    public function test_query_method_returns_query_builder()
    {
        $this->assertInstanceOf(
            TagQueryBuilder::class,
            $this->client->tags()->query()
        );
    }

    public function test_entity_can_be_constructed_from_array()
    {
        $values = ClientMock::mockValues(Faker::create(), TagEntity::class);

        $entity = new TagEntity($values);
        foreach($values as $key => $value) {
            $actual = $entity->{$key};
            $this->assertEquals($value, $actual, "Value of {$key} does not equal expected.");
        }
    }
}
