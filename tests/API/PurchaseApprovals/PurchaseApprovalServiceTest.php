<?php

use Anteris\Autotask\API\PurchaseApprovals\PurchaseApprovalCollection;
use Anteris\Autotask\API\PurchaseApprovals\PurchaseApprovalService;
use Anteris\Autotask\API\PurchaseApprovals\PurchaseApprovalEntity;

use Anteris\Autotask\API\PurchaseApprovals\PurchaseApprovalQueryBuilder;
 
use Tests\AbstractTest;
use Tests\Mocks\ClientMock;
use Faker\Factory as Faker;

/**
 * Runs tests for PurchaseApprovalService.
 */
class PurchaseApprovalServiceTest extends AbstractTest
{
    /**
     * @covers PurchaseApprovalService
     */
    public function test_service_creation()
    {
        $this->assertInstanceOf(
            PurchaseApprovalService::class,
            $this->client->purchaseApprovals()
        );
    }

    /**
     * @covers PurchaseApprovalService
     */
    public function test_query_returns_collection()
    {
        $result = $this->client->purchaseApprovals()->query()->where('id', 'exist')->records(1)->get();

        // Make sure its a collection
        $this->assertInstanceOf(
            PurchaseApprovalCollection::class,
            $result
        );
    }

    /**
     * @covers PurchaseApprovalCollection
     */
    public function test_collection_contains_purchase_approval_entities()
    {
        $result = $this->client->purchaseApprovals()->query()->where('id', 'exist')->records(1)->get();

        // Make sure the collection has entities
        if (count($result) > 0) {
            $this->assertInstanceOf(
                PurchaseApprovalEntity::class,
                $result->offsetGet(0)
            );
        } else {
            $this->assertCount(0, $result);
        }
    }

    /**
     * @covers PurchaseApprovalService
     */
    public function test_query_method_returns_query_builder()
    {
        $this->assertInstanceOf(
            PurchaseApprovalQueryBuilder::class,
            $this->client->purchaseApprovals()->query()
        );
    }

    public function test_entity_can_be_constructed_from_array()
    {
        $values = ClientMock::mockValues(Faker::create(), PurchaseApprovalEntity::class);

        $entity = new PurchaseApprovalEntity($values);
        foreach($values as $key => $value) {
            $actual = $entity->{$key};
            $this->assertEquals($value, $actual, "Value of {$key} does not equal expected.");
        }
    }
}
