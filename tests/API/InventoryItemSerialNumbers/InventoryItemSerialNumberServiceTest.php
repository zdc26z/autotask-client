<?php

use Anteris\Autotask\API\InventoryItemSerialNumbers\InventoryItemSerialNumberCollection;
use Anteris\Autotask\API\InventoryItemSerialNumbers\InventoryItemSerialNumberService;
use Anteris\Autotask\API\InventoryItemSerialNumbers\InventoryItemSerialNumberEntity;

use Anteris\Autotask\API\InventoryItemSerialNumbers\InventoryItemSerialNumberQueryBuilder;
 
use Tests\AbstractTest;
use Tests\Mocks\ClientMock;
use Faker\Factory as Faker;

/**
 * Runs tests for InventoryItemSerialNumberService.
 */
class InventoryItemSerialNumberServiceTest extends AbstractTest
{
    /**
     * @covers InventoryItemSerialNumberService
     */
    public function test_service_creation()
    {
        $this->assertInstanceOf(
            InventoryItemSerialNumberService::class,
            $this->client->inventoryItemSerialNumbers()
        );
    }

    /**
     * @covers InventoryItemSerialNumberService
     */
    public function test_query_returns_collection()
    {
        $result = $this->client->inventoryItemSerialNumbers()->query()->where('id', 'exist')->records(1)->get();

        // Make sure its a collection
        $this->assertInstanceOf(
            InventoryItemSerialNumberCollection::class,
            $result
        );
    }

    /**
     * @covers InventoryItemSerialNumberCollection
     */
    public function test_collection_contains_inventory_item_serial_number_entities()
    {
        $result = $this->client->inventoryItemSerialNumbers()->query()->where('id', 'exist')->records(1)->get();

        // Make sure the collection has entities
        if (count($result) > 0) {
            $this->assertInstanceOf(
                InventoryItemSerialNumberEntity::class,
                $result->offsetGet(0)
            );
        } else {
            $this->assertCount(0, $result);
        }
    }

    /**
     * @covers InventoryItemSerialNumberService
     */
    public function test_query_method_returns_query_builder()
    {
        $this->assertInstanceOf(
            InventoryItemSerialNumberQueryBuilder::class,
            $this->client->inventoryItemSerialNumbers()->query()
        );
    }

    public function test_entity_can_be_constructed_from_array()
    {
        $values = ClientMock::mockValues(Faker::create(), InventoryItemSerialNumberEntity::class);

        $entity = new InventoryItemSerialNumberEntity($values);
        foreach($values as $key => $value) {
            $actual = $entity->{$key};
            $this->assertEquals($value, $actual, "Value of {$key} does not equal expected.");
        }
    }
}
