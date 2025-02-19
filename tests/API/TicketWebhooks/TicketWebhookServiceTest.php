<?php

use Anteris\Autotask\API\TicketWebhooks\TicketWebhookCollection;
use Anteris\Autotask\API\TicketWebhooks\TicketWebhookService;
use Anteris\Autotask\API\TicketWebhooks\TicketWebhookEntity;

use Anteris\Autotask\API\TicketWebhooks\TicketWebhookQueryBuilder;
 
use Tests\AbstractTest;
use Tests\Mocks\ClientMock;
use Faker\Factory as Faker;

/**
 * Runs tests for TicketWebhookService.
 */
class TicketWebhookServiceTest extends AbstractTest
{
    /**
     * @covers TicketWebhookService
     */
    public function test_service_creation()
    {
        $this->assertInstanceOf(
            TicketWebhookService::class,
            $this->client->ticketWebhooks()
        );
    }

    public function test_entity_can_be_constructed_from_array()
    {
        $values = ClientMock::mockValues(Faker::create(), TicketWebhookEntity::class);

        $entity = new TicketWebhookEntity($values);
        foreach($values as $key => $value) {
            $actual = $entity->{$key};
            $this->assertEquals($value, $actual, "Value of {$key} does not equal expected.");
        }
    }
}
