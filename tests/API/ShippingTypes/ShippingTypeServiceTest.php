<?php

use Anteris\Autotask\API\ShippingTypes\ShippingTypeCollection;
use Anteris\Autotask\API\ShippingTypes\ShippingTypeService;
use Anteris\Autotask\API\ShippingTypes\ShippingTypeEntity;

use Anteris\Autotask\API\ShippingTypes\ShippingTypeQueryBuilder;
 
use Tests\AbstractTest;
use Tests\Mocks\ClientMock;
use Faker\Factory as Faker;

/**
 * Runs tests for ShippingTypeService.
 */
class ShippingTypeServiceTest extends AbstractTest
{
    /**
     * @covers ShippingTypeService
     */
    public function test_service_creation()
    {
        $this->assertInstanceOf(
            ShippingTypeService::class,
            $this->client->shippingTypes()
        );
    }

    /**
     * @covers ShippingTypeService
     */
    public function test_query_returns_collection()
    {
        $result = $this->client->shippingTypes()->query()->where('id', 'exist')->records(1)->get();

        // Make sure its a collection
        $this->assertInstanceOf(
            ShippingTypeCollection::class,
            $result
        );
    }

    /**
     * @covers ShippingTypeCollection
     */
    public function test_collection_contains_shipping_type_entities()
    {
        $result = $this->client->shippingTypes()->query()->where('id', 'exist')->records(1)->get();

        // Make sure the collection has entities
        if (count($result) > 0) {
            $this->assertInstanceOf(
                ShippingTypeEntity::class,
                $result->offsetGet(0)
            );
        } else {
            $this->assertCount(0, $result);
        }
    }

    /**
     * @covers ShippingTypeService
     */
    public function test_query_method_returns_query_builder()
    {
        $this->assertInstanceOf(
            ShippingTypeQueryBuilder::class,
            $this->client->shippingTypes()->query()
        );
    }

    public function test_entity_can_be_constructed_from_array()
    {
        $values = ClientMock::mockValues(Faker::create(), ShippingTypeEntity::class);

        $entity = new ShippingTypeEntity($values);
        foreach($values as $key => $value) {
            $actual = $entity->{$key};
            $this->assertEquals($value, $actual, "Value of {$key} does not equal expected.");
        }
    }
}
