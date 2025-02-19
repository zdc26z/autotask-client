<?php

use Anteris\Autotask\API\ActionTypes\ActionTypeCollection;
use Anteris\Autotask\API\ActionTypes\ActionTypeService;
use Anteris\Autotask\API\ActionTypes\ActionTypeEntity;

use Anteris\Autotask\API\ActionTypes\ActionTypeQueryBuilder;
 
use Tests\AbstractTest;
use Tests\Mocks\ClientMock;
use Faker\Factory as Faker;

/**
 * Runs tests for ActionTypeService.
 */
class ActionTypeServiceTest extends AbstractTest
{
    /**
     * @covers ActionTypeService
     */
    public function test_service_creation()
    {
        $this->assertInstanceOf(
            ActionTypeService::class,
            $this->client->actionTypes()
        );
    }

    /**
     * @covers ActionTypeService
     */
    public function test_query_returns_collection()
    {
        $result = $this->client->actionTypes()->query()->where('id', 'exist')->records(1)->get();

        // Make sure its a collection
        $this->assertInstanceOf(
            ActionTypeCollection::class,
            $result
        );
    }

    /**
     * @covers ActionTypeCollection
     */
    public function test_collection_contains_action_type_entities()
    {
        $result = $this->client->actionTypes()->query()->where('id', 'exist')->records(1)->get();

        // Make sure the collection has entities
        if (count($result) > 0) {
            $this->assertInstanceOf(
                ActionTypeEntity::class,
                $result->offsetGet(0)
            );
        } else {
            $this->assertCount(0, $result);
        }
    }

    /**
     * @covers ActionTypeService
     */
    public function test_query_method_returns_query_builder()
    {
        $this->assertInstanceOf(
            ActionTypeQueryBuilder::class,
            $this->client->actionTypes()->query()
        );
    }

    public function test_entity_can_be_constructed_from_array()
    {
        $values = ClientMock::mockValues(Faker::create(), ActionTypeEntity::class);

        $entity = new ActionTypeEntity($values);
        foreach($values as $key => $value) {
            $actual = $entity->{$key};
            $this->assertEquals($value, $actual, "Value of {$key} does not equal expected.");
        }
    }
}
