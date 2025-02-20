<?php

use Anteris\Autotask\API\TicketRmaCredits\TicketRmaCreditCollection;
use Anteris\Autotask\API\TicketRmaCredits\TicketRmaCreditService;
use Anteris\Autotask\API\TicketRmaCredits\TicketRmaCreditEntity;

use Anteris\Autotask\API\TicketRmaCredits\TicketRmaCreditQueryBuilder;
 
use Tests\AbstractTest;
use Tests\Mocks\ClientMock;
use Faker\Factory as Faker;

/**
 * Runs tests for TicketRmaCreditService.
 */
class TicketRmaCreditServiceTest extends AbstractTest
{
    /**
     * @covers TicketRmaCreditService
     */
    public function test_service_creation()
    {
        $this->assertInstanceOf(
            TicketRmaCreditService::class,
            $this->client->ticketRmaCredits()
        );
    }

    /**
     * @covers TicketRmaCreditService
     */
    public function test_query_returns_collection()
    {
        $result = $this->client->ticketRmaCredits()->query()->where('id', 'exist')->records(1)->get();

        // Make sure its a collection
        $this->assertInstanceOf(
            TicketRmaCreditCollection::class,
            $result
        );
    }

    /**
     * @covers TicketRmaCreditCollection
     */
    public function test_collection_contains_ticket_rma_credit_entities()
    {
        $result = $this->client->ticketRmaCredits()->query()->where('id', 'exist')->records(1)->get();

        // Make sure the collection has entities
        if (count($result) > 0) {
            $this->assertInstanceOf(
                TicketRmaCreditEntity::class,
                $result->offsetGet(0)
            );
        } else {
            $this->assertCount(0, $result);
        }
    }

    /**
     * @covers TicketRmaCreditService
     */
    public function test_query_method_returns_query_builder()
    {
        $this->assertInstanceOf(
            TicketRmaCreditQueryBuilder::class,
            $this->client->ticketRmaCredits()->query()
        );
    }

    public function test_entity_can_be_constructed_from_array()
    {
        $values = ClientMock::mockValues(Faker::create(), TicketRmaCreditEntity::class);

        $entity = new TicketRmaCreditEntity($values);
        foreach($values as $key => $value) {
            $actual = $entity->{$key};
            $this->assertEquals($value, $actual, "Value of {$key} does not equal expected.");
        }
    }
}
