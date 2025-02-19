<?php

use Anteris\Autotask\API\ConfigurationItemWebhooks\ConfigurationItemWebhookCollection;
use Anteris\Autotask\API\ConfigurationItemWebhooks\ConfigurationItemWebhookService;
use Anteris\Autotask\API\ConfigurationItemWebhooks\ConfigurationItemWebhookEntity;

use Anteris\Autotask\API\ConfigurationItemWebhooks\ConfigurationItemWebhookQueryBuilder;
 
use Tests\AbstractTest;
use Tests\Mocks\ClientMock;
use Faker\Factory as Faker;

/**
 * Runs tests for ConfigurationItemWebhookService.
 */
class ConfigurationItemWebhookServiceTest extends AbstractTest
{
    /**
     * @covers ConfigurationItemWebhookService
     */
    public function test_service_creation()
    {
        $this->assertInstanceOf(
            ConfigurationItemWebhookService::class,
            $this->client->configurationItemWebhooks()
        );
    }

    public function test_entity_can_be_constructed_from_array()
    {
        $values = ClientMock::mockValues(Faker::create(), ConfigurationItemWebhookEntity::class);

        $entity = new ConfigurationItemWebhookEntity($values);
        foreach($values as $key => $value) {
            $actual = $entity->{$key};
            $this->assertEquals($value, $actual, "Value of {$key} does not equal expected.");
        }
    }
}
