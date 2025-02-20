<?php

use Anteris\Autotask\API\ChangeOrderCharges\ChangeOrderChargeCollection;
use Anteris\Autotask\API\ChangeOrderCharges\ChangeOrderChargeService;
use Anteris\Autotask\API\ChangeOrderCharges\ChangeOrderChargeEntity;

use Anteris\Autotask\API\ChangeOrderCharges\ChangeOrderChargeQueryBuilder;
 
use Tests\AbstractTest;
use Tests\Mocks\ClientMock;
use Faker\Factory as Faker;

/**
 * Runs tests for ChangeOrderChargeService.
 */
class ChangeOrderChargeServiceTest extends AbstractTest
{
    /**
     * @covers ChangeOrderChargeService
     */
    public function test_service_creation()
    {
        $this->assertInstanceOf(
            ChangeOrderChargeService::class,
            $this->client->changeOrderCharges()
        );
    }

    /**
     * @covers ChangeOrderChargeService
     */
    public function test_query_returns_collection()
    {
        $result = $this->client->changeOrderCharges()->query()->where('id', 'exist')->records(1)->get();

        // Make sure its a collection
        $this->assertInstanceOf(
            ChangeOrderChargeCollection::class,
            $result
        );
    }

    /**
     * @covers ChangeOrderChargeCollection
     */
    public function test_collection_contains_change_order_charge_entities()
    {
        $result = $this->client->changeOrderCharges()->query()->where('id', 'exist')->records(1)->get();

        // Make sure the collection has entities
        if (count($result) > 0) {
            $this->assertInstanceOf(
                ChangeOrderChargeEntity::class,
                $result->offsetGet(0)
            );
        } else {
            $this->assertCount(0, $result);
        }
    }

    /**
     * @covers ChangeOrderChargeService
     */
    public function test_query_method_returns_query_builder()
    {
        $this->assertInstanceOf(
            ChangeOrderChargeQueryBuilder::class,
            $this->client->changeOrderCharges()->query()
        );
    }

    public function test_entity_can_be_constructed_from_array()
    {
        $values = ClientMock::mockValues(Faker::create(), ChangeOrderChargeEntity::class);

        $entity = new ChangeOrderChargeEntity($values);
        foreach($values as $key => $value) {
            $actual = $entity->{$key};
            $this->assertEquals($value, $actual, "Value of {$key} does not equal expected.");
        }
    }
}
