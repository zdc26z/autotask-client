<?php

use Anteris\Autotask\API\TicketWebhookExcludedResources\TicketWebhookExcludedResourceCollection;
use Anteris\Autotask\API\TicketWebhookExcludedResources\TicketWebhookExcludedResourceService;
use Anteris\Autotask\API\TicketWebhookExcludedResources\TicketWebhookExcludedResourceEntity;

use Anteris\Autotask\API\TicketWebhookExcludedResources\TicketWebhookExcludedResourceQueryBuilder;
 
use Tests\AbstractTest;
use Tests\Mocks\ClientMock;
use Faker\Factory as Faker;

/**
 * Runs tests for TicketWebhookExcludedResourceService.
 */
class TicketWebhookExcludedResourceServiceTest extends AbstractTest
{
    /**
     * @covers TicketWebhookExcludedResourceService
     */
    public function test_service_creation()
    {
        $this->assertInstanceOf(
            TicketWebhookExcludedResourceService::class,
            $this->client->ticketWebhookExcludedResources()
        );
    }

    public function test_entity_can_be_constructed_from_array()
    {
        $values = ClientMock::mockValues(Faker::create(), TicketWebhookExcludedResourceEntity::class);

        $entity = new TicketWebhookExcludedResourceEntity($values);
        foreach($values as $key => $value) {
            $actual = $entity->{$key};
            $this->assertEquals($value, $actual, "Value of {$key} does not equal expected.");
        }
    }
}
