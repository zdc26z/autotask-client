<?php

use Anteris\Autotask\API\TagAliases\TagAliasCollection;
use Anteris\Autotask\API\TagAliases\TagAliasService;
use Anteris\Autotask\API\TagAliases\TagAliasEntity;

use Anteris\Autotask\API\TagAliases\TagAliasQueryBuilder;
 
use Tests\AbstractTest;
use Tests\Mocks\ClientMock;
use Faker\Factory as Faker;

/**
 * Runs tests for TagAliasService.
 */
class TagAliasServiceTest extends AbstractTest
{
    /**
     * @covers TagAliasService
     */
    public function test_service_creation()
    {
        $this->assertInstanceOf(
            TagAliasService::class,
            $this->client->tagAliases()
        );
    }

    /**
     * @covers TagAliasService
     */
    public function test_query_returns_collection()
    {
        $result = $this->client->tagAliases()->query()->where('id', 'exist')->records(1)->get();

        // Make sure its a collection
        $this->assertInstanceOf(
            TagAliasCollection::class,
            $result
        );
    }

    /**
     * @covers TagAliasCollection
     */
    public function test_collection_contains_tag_alias_entities()
    {
        $result = $this->client->tagAliases()->query()->where('id', 'exist')->records(1)->get();

        // Make sure the collection has entities
        if (count($result) > 0) {
            $this->assertInstanceOf(
                TagAliasEntity::class,
                $result->offsetGet(0)
            );
        } else {
            $this->assertCount(0, $result);
        }
    }

    /**
     * @covers TagAliasService
     */
    public function test_query_method_returns_query_builder()
    {
        $this->assertInstanceOf(
            TagAliasQueryBuilder::class,
            $this->client->tagAliases()->query()
        );
    }

    public function test_entity_can_be_constructed_from_array()
    {
        $values = ClientMock::mockValues(Faker::create(), TagAliasEntity::class);

        $entity = new TagAliasEntity($values);
        foreach($values as $key => $value) {
            $actual = $entity->{$key};
            $this->assertEquals($value, $actual, "Value of {$key} does not equal expected.");
        }
    }
}
