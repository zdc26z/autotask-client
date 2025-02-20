<?php

use Anteris\Autotask\API\PurchaseOrders\PurchaseOrderCollection;
use Anteris\Autotask\API\PurchaseOrders\PurchaseOrderService;
use Anteris\Autotask\API\PurchaseOrders\PurchaseOrderEntity;

use Anteris\Autotask\API\PurchaseOrders\PurchaseOrderQueryBuilder;
 
use Tests\AbstractTest;
use Tests\Mocks\ClientMock;
use Faker\Factory as Faker;

/**
 * Runs tests for PurchaseOrderService.
 */
class PurchaseOrderServiceTest extends AbstractTest
{
    /**
     * @covers PurchaseOrderService
     */
    public function test_service_creation()
    {
        $this->assertInstanceOf(
            PurchaseOrderService::class,
            $this->client->purchaseOrders()
        );
    }

    /**
     * @covers PurchaseOrderService
     */
    public function test_query_returns_collection()
    {
        $result = $this->client->purchaseOrders()->query()->where('id', 'exist')->records(1)->get();

        // Make sure its a collection
        $this->assertInstanceOf(
            PurchaseOrderCollection::class,
            $result
        );
    }

    /**
     * @covers PurchaseOrderCollection
     */
    public function test_collection_contains_purchase_order_entities()
    {
        $result = $this->client->purchaseOrders()->query()->where('id', 'exist')->records(1)->get();

        // Make sure the collection has entities
        if (count($result) > 0) {
            $this->assertInstanceOf(
                PurchaseOrderEntity::class,
                $result->offsetGet(0)
            );
        } else {
            $this->assertCount(0, $result);
        }
    }

    /**
     * @covers PurchaseOrderService
     */
    public function test_query_method_returns_query_builder()
    {
        $this->assertInstanceOf(
            PurchaseOrderQueryBuilder::class,
            $this->client->purchaseOrders()->query()
        );
    }

    public function test_entity_can_be_constructed_from_array()
    {
        $values = ClientMock::mockValues(Faker::create(), PurchaseOrderEntity::class);

        $entity = new PurchaseOrderEntity($values);
        foreach($values as $key => $value) {
            $actual = $entity->{$key};
            $this->assertEquals($value, $actual, "Value of {$key} does not equal expected.");
        }
    }
}
