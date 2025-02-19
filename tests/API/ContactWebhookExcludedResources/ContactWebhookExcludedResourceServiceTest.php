<?php

use Anteris\Autotask\API\ContactWebhookExcludedResources\ContactWebhookExcludedResourceCollection;
use Anteris\Autotask\API\ContactWebhookExcludedResources\ContactWebhookExcludedResourceService;
use Anteris\Autotask\API\ContactWebhookExcludedResources\ContactWebhookExcludedResourceEntity;

use Anteris\Autotask\API\ContactWebhookExcludedResources\ContactWebhookExcludedResourceQueryBuilder;
 
use Tests\AbstractTest;
use Tests\Mocks\ClientMock;
use Faker\Factory as Faker;

/**
 * Runs tests for ContactWebhookExcludedResourceService.
 */
class ContactWebhookExcludedResourceServiceTest extends AbstractTest
{
    /**
     * @covers ContactWebhookExcludedResourceService
     */
    public function test_service_creation()
    {
        $this->assertInstanceOf(
            ContactWebhookExcludedResourceService::class,
            $this->client->contactWebhookExcludedResources()
        );
    }

    public function test_entity_can_be_constructed_from_array()
    {
        $values = ClientMock::mockValues(Faker::create(), ContactWebhookExcludedResourceEntity::class);

        $entity = new ContactWebhookExcludedResourceEntity($values);
        foreach($values as $key => $value) {
            $actual = $entity->{$key};
            $this->assertEquals($value, $actual, "Value of {$key} does not equal expected.");
        }
    }
}
