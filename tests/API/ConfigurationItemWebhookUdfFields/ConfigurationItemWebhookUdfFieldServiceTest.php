<?php

use Anteris\Autotask\API\ConfigurationItemWebhookUdfFields\ConfigurationItemWebhookUdfFieldCollection;
use Anteris\Autotask\API\ConfigurationItemWebhookUdfFields\ConfigurationItemWebhookUdfFieldService;
use Anteris\Autotask\API\ConfigurationItemWebhookUdfFields\ConfigurationItemWebhookUdfFieldEntity;

use Anteris\Autotask\API\ConfigurationItemWebhookUdfFields\ConfigurationItemWebhookUdfFieldQueryBuilder;
 
use Tests\AbstractTest;
use Tests\Mocks\ClientMock;
use Faker\Factory as Faker;

/**
 * Runs tests for ConfigurationItemWebhookUdfFieldService.
 */
class ConfigurationItemWebhookUdfFieldServiceTest extends AbstractTest
{
    /**
     * @covers ConfigurationItemWebhookUdfFieldService
     */
    public function test_service_creation()
    {
        $this->assertInstanceOf(
            ConfigurationItemWebhookUdfFieldService::class,
            $this->client->configurationItemWebhookUdfFields()
        );
    }

    public function test_entity_can_be_constructed_from_array()
    {
        $values = ClientMock::mockValues(Faker::create(), ConfigurationItemWebhookUdfFieldEntity::class);

        $entity = new ConfigurationItemWebhookUdfFieldEntity($values);
        foreach($values as $key => $value) {
            $actual = $entity->{$key};
            $this->assertEquals($value, $actual, "Value of {$key} does not equal expected.");
        }
    }
}
