<?php

use Anteris\Autotask\API\TicketCharges\TicketChargeCollection;
use Anteris\Autotask\API\TicketCharges\TicketChargeService;
use Anteris\Autotask\API\TicketCharges\TicketChargeEntity;

use Anteris\Autotask\API\TicketCharges\TicketChargeQueryBuilder;
 
use Tests\AbstractTest;
use Tests\Mocks\ClientMock;
use Faker\Factory as Faker;

/**
 * Runs tests for TicketChargeService.
 */
class TicketChargeServiceTest extends AbstractTest
{
    /**
     * @covers TicketChargeService
     */
    public function test_service_creation()
    {
        $this->assertInstanceOf(
            TicketChargeService::class,
            $this->client->ticketCharges()
        );
    }

    /**
     * @covers TicketChargeService
     */
    public function test_query_returns_collection()
    {
        $result = $this->client->ticketCharges()->query()->where('id', 'exist')->records(1)->get();

        // Make sure its a collection
        $this->assertInstanceOf(
            TicketChargeCollection::class,
            $result
        );
    }

    /**
     * @covers TicketChargeCollection
     */
    public function test_collection_contains_ticket_charge_entities()
    {
        $result = $this->client->ticketCharges()->query()->where('id', 'exist')->records(1)->get();

        // Make sure the collection has entities
        if (count($result) > 0) {
            $this->assertInstanceOf(
                TicketChargeEntity::class,
                $result->offsetGet(0)
            );
        } else {
            $this->assertCount(0, $result);
        }
    }

    /**
     * @covers TicketChargeService
     */
    public function test_query_method_returns_query_builder()
    {
        $this->assertInstanceOf(
            TicketChargeQueryBuilder::class,
            $this->client->ticketCharges()->query()
        );
    }

    public function test_entity_can_be_constructed_from_array()
    {
        $values = ClientMock::mockValues(Faker::create(), TicketChargeEntity::class);

        $entity = new TicketChargeEntity($values);
        foreach($values as $key => $value) {
            $actual = $entity->{$key};
            $this->assertEquals($value, $actual, "Value of {$key} does not equal expected.");
        }
    }
}
