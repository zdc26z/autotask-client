<?php

use Anteris\Autotask\API\ConfigurationItemWebhookExcludedResources\ConfigurationItemWebhookExcludedResourceCollection;
use Anteris\Autotask\API\ConfigurationItemWebhookExcludedResources\ConfigurationItemWebhookExcludedResourceService;
use Anteris\Autotask\API\ConfigurationItemWebhookExcludedResources\ConfigurationItemWebhookExcludedResourceEntity;

use Anteris\Autotask\API\ConfigurationItemWebhookExcludedResources\ConfigurationItemWebhookExcludedResourceQueryBuilder;
 
use Tests\AbstractTest;
use Tests\Mocks\ClientMock;
use Faker\Factory as Faker;

/**
 * Runs tests for ConfigurationItemWebhookExcludedResourceService.
 */
class ConfigurationItemWebhookExcludedResourceServiceTest extends AbstractTest
{
    /**
     * @covers ConfigurationItemWebhookExcludedResourceService
     */
    public function test_service_creation()
    {
        $this->assertInstanceOf(
            ConfigurationItemWebhookExcludedResourceService::class,
            $this->client->configurationItemWebhookExcludedResources()
        );
    }

    public function test_entity_can_be_constructed_from_array()
    {
        $values = ClientMock::mockValues(Faker::create(), ConfigurationItemWebhookExcludedResourceEntity::class);

        $entity = new ConfigurationItemWebhookExcludedResourceEntity($values);
        foreach($values as $key => $value) {
            $actual = $entity->{$key};
            $this->assertEquals($value, $actual, "Value of {$key} does not equal expected.");
        }
    }
}
