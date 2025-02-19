<?php

use Anteris\Autotask\API\TicketWebhookFields\TicketWebhookFieldCollection;
use Anteris\Autotask\API\TicketWebhookFields\TicketWebhookFieldService;
use Anteris\Autotask\API\TicketWebhookFields\TicketWebhookFieldEntity;

use Anteris\Autotask\API\TicketWebhookFields\TicketWebhookFieldQueryBuilder;
 
use Tests\AbstractTest;
use Tests\Mocks\ClientMock;
use Faker\Factory as Faker;

/**
 * Runs tests for TicketWebhookFieldService.
 */
class TicketWebhookFieldServiceTest extends AbstractTest
{
    /**
     * @covers TicketWebhookFieldService
     */
    public function test_service_creation()
    {
        $this->assertInstanceOf(
            TicketWebhookFieldService::class,
            $this->client->ticketWebhookFields()
        );
    }

    public function test_entity_can_be_constructed_from_array()
    {
        $values = ClientMock::mockValues(Faker::create(), TicketWebhookFieldEntity::class);

        $entity = new TicketWebhookFieldEntity($values);
        foreach($values as $key => $value) {
            $actual = $entity->{$key};
            $this->assertEquals($value, $actual, "Value of {$key} does not equal expected.");
        }
    }
}
