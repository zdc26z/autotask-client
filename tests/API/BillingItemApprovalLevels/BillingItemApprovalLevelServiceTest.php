<?php

use Anteris\Autotask\API\BillingItemApprovalLevels\BillingItemApprovalLevelCollection;
use Anteris\Autotask\API\BillingItemApprovalLevels\BillingItemApprovalLevelService;
use Anteris\Autotask\API\BillingItemApprovalLevels\BillingItemApprovalLevelEntity;

use Anteris\Autotask\API\BillingItemApprovalLevels\BillingItemApprovalLevelQueryBuilder;
 
use Tests\AbstractTest;
use Tests\Mocks\ClientMock;
use Faker\Factory as Faker;

/**
 * Runs tests for BillingItemApprovalLevelService.
 */
class BillingItemApprovalLevelServiceTest extends AbstractTest
{
    /**
     * @covers BillingItemApprovalLevelService
     */
    public function test_service_creation()
    {
        $this->assertInstanceOf(
            BillingItemApprovalLevelService::class,
            $this->client->billingItemApprovalLevels()
        );
    }

    /**
     * @covers BillingItemApprovalLevelService
     */
    public function test_query_returns_collection()
    {
        $result = $this->client->billingItemApprovalLevels()->query()->where('id', 'exist')->records(1)->get();

        // Make sure its a collection
        $this->assertInstanceOf(
            BillingItemApprovalLevelCollection::class,
            $result
        );
    }

    /**
     * @covers BillingItemApprovalLevelCollection
     */
    public function test_collection_contains_billing_item_approval_level_entities()
    {
        $result = $this->client->billingItemApprovalLevels()->query()->where('id', 'exist')->records(1)->get();

        // Make sure the collection has entities
        if (count($result) > 0) {
            $this->assertInstanceOf(
                BillingItemApprovalLevelEntity::class,
                $result->offsetGet(0)
            );
        } else {
            $this->assertCount(0, $result);
        }
    }

    /**
     * @covers BillingItemApprovalLevelService
     */
    public function test_query_method_returns_query_builder()
    {
        $this->assertInstanceOf(
            BillingItemApprovalLevelQueryBuilder::class,
            $this->client->billingItemApprovalLevels()->query()
        );
    }

    public function test_entity_can_be_constructed_from_array()
    {
        $values = ClientMock::mockValues(Faker::create(), BillingItemApprovalLevelEntity::class);

        $entity = new BillingItemApprovalLevelEntity($values);
        foreach($values as $key => $value) {
            $actual = $entity->{$key};
            $this->assertEquals($value, $actual, "Value of {$key} does not equal expected.");
        }
    }
}
