<?php

use Anteris\Autotask\API\TicketWebhookUdfFields\TicketWebhookUdfFieldCollection;
use Anteris\Autotask\API\TicketWebhookUdfFields\TicketWebhookUdfFieldService;
use Anteris\Autotask\API\TicketWebhookUdfFields\TicketWebhookUdfFieldEntity;

use Anteris\Autotask\API\TicketWebhookUdfFields\TicketWebhookUdfFieldQueryBuilder;
 
use Tests\AbstractTest;
use Tests\Mocks\ClientMock;
use Faker\Factory as Faker;

/**
 * Runs tests for TicketWebhookUdfFieldService.
 */
class TicketWebhookUdfFieldServiceTest extends AbstractTest
{
    /**
     * @covers TicketWebhookUdfFieldService
     */
    public function test_service_creation()
    {
        $this->assertInstanceOf(
            TicketWebhookUdfFieldService::class,
            $this->client->ticketWebhookUdfFields()
        );
    }

    public function test_entity_can_be_constructed_from_array()
    {
        $values = ClientMock::mockValues(Faker::create(), TicketWebhookUdfFieldEntity::class);

        $entity = new TicketWebhookUdfFieldEntity($values);
        foreach($values as $key => $value) {
            $actual = $entity->{$key};
            $this->assertEquals($value, $actual, "Value of {$key} does not equal expected.");
        }
    }
}
