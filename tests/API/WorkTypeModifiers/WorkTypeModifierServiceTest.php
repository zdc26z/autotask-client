<?php

use Anteris\Autotask\API\WorkTypeModifiers\WorkTypeModifierCollection;
use Anteris\Autotask\API\WorkTypeModifiers\WorkTypeModifierService;
use Anteris\Autotask\API\WorkTypeModifiers\WorkTypeModifierEntity;

use Anteris\Autotask\API\WorkTypeModifiers\WorkTypeModifierQueryBuilder;
 
use Tests\AbstractTest;
use Tests\Mocks\ClientMock;
use Faker\Factory as Faker;

/**
 * Runs tests for WorkTypeModifierService.
 */
class WorkTypeModifierServiceTest extends AbstractTest
{
    /**
     * @covers WorkTypeModifierService
     */
    public function test_service_creation()
    {
        $this->assertInstanceOf(
            WorkTypeModifierService::class,
            $this->client->workTypeModifiers()
        );
    }

    /**
     * @covers WorkTypeModifierService
     */
    public function test_query_returns_collection()
    {
        $result = $this->client->workTypeModifiers()->query()->where('id', 'exist')->records(1)->get();

        // Make sure its a collection
        $this->assertInstanceOf(
            WorkTypeModifierCollection::class,
            $result
        );
    }

    /**
     * @covers WorkTypeModifierCollection
     */
    public function test_collection_contains_work_type_modifier_entities()
    {
        $result = $this->client->workTypeModifiers()->query()->where('id', 'exist')->records(1)->get();

        // Make sure the collection has entities
        if (count($result) > 0) {
            $this->assertInstanceOf(
                WorkTypeModifierEntity::class,
                $result->offsetGet(0)
            );
        } else {
            $this->assertCount(0, $result);
        }
    }

    /**
     * @covers WorkTypeModifierService
     */
    public function test_query_method_returns_query_builder()
    {
        $this->assertInstanceOf(
            WorkTypeModifierQueryBuilder::class,
            $this->client->workTypeModifiers()->query()
        );
    }

    public function test_entity_can_be_constructed_from_array()
    {
        $values = ClientMock::mockValues(Faker::create(), WorkTypeModifierEntity::class);

        $entity = new WorkTypeModifierEntity($values);
        foreach($values as $key => $value) {
            $actual = $entity->{$key};
            $this->assertEquals($value, $actual, "Value of {$key} does not equal expected.");
        }
    }
}
